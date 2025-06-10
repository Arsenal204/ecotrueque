<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Models\Galeria;
use App\Models\Categoria;
use App\Models\Intercambio;
use App\Models\Reclamacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetoController extends Controller
{
    public function index()
    {
        $objetos = Objeto::where('usuario', Auth::id())->get();
        $categorias = Categoria::all()->keyBy('id'); // Mapeamos por ID

        return view('objetos.index', compact('objetos', 'categorias'));
    }


    public function create()
    {
        $categorias = Categoria::all();
        return view('objetos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'tipo_oferta' => 'required|in:donación,trueque',
            'categoria' => 'nullable|exists:categorias,id',
            'nueva_categoria' => 'nullable|string|max:255',
            'imagenes.*' => 'nullable|image|max:5120',
        ]);

        // Prioridad a la nueva categoría si está definida
        if ($request->filled('nueva_categoria')) {
            $categoria = Categoria::firstOrCreate(
                ['nombre_categoria' => $request->nueva_categoria],
                ['descripcion_categoria' => null]
            );
            $categoriaId = $categoria->id;
        } else {
            $categoriaId = $request->categoria;
        }

        $objeto = Objeto::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'tipo_oferta' => $request->tipo_oferta,
            'usuario' => Auth::id(),
            'categoria' => $categoriaId,
            'fecha_publicacion' => now(),
        ]);

        // Guardar imágenes si se subieron
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $ruta = $img->store('galerias', 'public');

                Galeria::create([
                    'nombre_imagen' => $img->getClientOriginalName(),
                    'ruta_imagen' => $ruta,
                    'fecha_subida' => now(),
                    'id_objeto' => $objeto->id,
                ]);
            }
        }

        return redirect()->route('objetos.index')->with('success', 'Objeto publicado correctamente.');
    }


    public function show(Objeto $objeto)
    {
        // Guardar categorías vistas en sesión
        $categoriasVistas = session()->get('categorias_vistas', []);
        if (!in_array($objeto->categoria, $categoriasVistas)) {
            $categoriasVistas[] = $objeto->categoria;
            session()->put('categorias_vistas', $categoriasVistas);
        }

        return view('objetos.show', compact('objeto'));
    }

    public function edit(Objeto $objeto)
    {
        if ($objeto->usuario !== Auth::id()) {
            abort(403);
        }

        $categorias = Categoria::all();
        return view('objetos.edit', compact('objeto', 'categorias'));
    }

    public function update(Request $request, Objeto $objeto)
    {
        if ($objeto->usuario !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'tipo_oferta' => 'required|in:donación,trueque',
            'categoria' => 'required|exists:categorias,id',
        ]);

        $objeto->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'tipo_oferta' => $request->tipo_oferta,
            'categoria' => $request->categoria,
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $ruta = $img->store('galerias', 'public');

                Galeria::create([
                    'nombre_imagen' => $img->getClientOriginalName(),
                    'ruta_imagen' => $ruta,
                    'fecha_subida' => now(),
                    'id_objeto' => $objeto->id,
                ]);
            }
        }



        return redirect()->route('objetos.index')->with('success', 'Objeto actualizado correctamente.');
    }

    public function destroy(Objeto $objeto)
    {
        if ($objeto->usuario !== Auth::id()) {
            abort(403);
        }

        // Eliminar imágenes asociadas primero
        $objeto->imagenes()->delete();

        $objeto->delete();

        return redirect()->route('objetos.index')->with('success', 'Objeto eliminado.');
    }



    public function explorar(Request $request)
    {
        $categoriaId = $request->input('categoria');

        $query = Objeto::with('categoria', 'imagenes')
            ->where('usuario', '!=', Auth::id());

        // Filtrar por categoría
        if ($categoriaId) {
            $query->where('categoria', $categoriaId);
        }

        // Filtrar por ciudad (usuario relacionado)
        if ($request->filled('ciudad')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('ciudad', $request->ciudad);
            });
        }

        // Obtener objetos sin intercambio confirmado,
        // o que tengan intercambio confirmado pero con reclamación resuelta
        $objetos = $query->get()->filter(function ($objeto) {
            // Buscar si este objeto está involucrado en un intercambio confirmado
            $intercambioConfirmado = Intercambio::where(function ($q) use ($objeto) {
                $q->where('id_objeto_emisor', $objeto->id)
                    ->orWhere('id_objeto_receptor', $objeto->id);
            })->where('estado', 'confirmado')->first();

            if (!$intercambioConfirmado) {
                return true; // No tiene intercambio confirmado, mostrarlo
            }

            // Tiene intercambio confirmado, ¿tiene reclamación confirmada o resuelta?
            $reclamacionAceptada = Reclamacion::where('id_intercambio', $intercambioConfirmado->id)
                ->whereIn('estado_reclamacion', ['resuelta', 'confirmada'])
                ->exists();

            return $reclamacionAceptada;
        });

        $categorias = Categoria::all();

        return view('objetos.explorar', compact('objetos', 'categorias', 'categoriaId'));
    }
}

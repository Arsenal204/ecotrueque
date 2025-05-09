<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Models\Galeria;
use App\Models\Categoria;
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
            'categoria' => 'required|exists:categorias,id',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $objeto = Objeto::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'tipo_oferta' => $request->tipo_oferta,
            'usuario' => Auth::id(),
            'categoria' => $request->categoria,
            'fecha_publicacion' => now(),
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

        return redirect()->route('objetos.index')->with('success', 'Objeto publicado correctamente.');
    }

    public function show(Objeto $objeto)
    {
        $categorias = Categoria::all();
        return view('objetos.show', compact('objeto', 'categorias'));
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
}

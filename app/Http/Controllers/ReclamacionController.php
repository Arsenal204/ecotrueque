<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamacion;
use App\Models\Intercambio;
use Illuminate\Support\Facades\Auth;

class ReclamacionController extends Controller
{
    public function create($intercambioId)
    {
        $intercambio = Intercambio::findOrFail($intercambioId);
        return view('reclamaciones.create', compact('intercambio'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motivo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'id_intercambio' => 'required|exists:intercambios,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $intercambio = Intercambio::findOrFail($request->id_intercambio);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('reclamaciones', 'public');
        }

        Reclamacion::create([
            'motivo' => $request->motivo,
            'descripcion' => $request->descripcion,
            'estado_reclamacion' => 'pendiente',
            'fecha_reclamacion' => now(),
            'id_usuario_emisor' => Auth::id(),
            'id_usuario_reclamado' => $intercambio->id_usuario_emisor == Auth::id()
                ? $intercambio->id_usuario_receptor
                : $intercambio->id_usuario_emisor,
            'id_intercambio' => $intercambio->id,
            'ruta_imagen' => $rutaImagen,
        ]);

        return redirect()->route('intercambios.index')->with('success', 'Reclamación enviada correctamente.');
    }

    public function index()
    {
        $reclamaciones = Reclamacion::with(['emisor', 'reclamado', 'intercambio.objetoEmisor.imagenes', 'intercambio.objetoReceptor.imagenes'])
            ->latest()
            ->get();

        return view('admin.reclamaciones.index', compact('reclamaciones'));
    }


    public function show(Reclamacion $reclamacion)
    {
        $reclamacion->load(['usuarioEmisor', 'usuarioReclamado', 'intercambio.objetoEmisor.imagenes', 'intercambio.objetoReceptor.imagenes']);

        return view('admin.reclamaciones.show', compact('reclamacion'));
    }

    public function resolver(Request $request, $id)
    {
        $request->validate([
            'resolucion_admin' => 'required|string',
            'estado_reclamacion' => 'required|in:pendiente,en revisión,resuelta,rechazada',
            'archivos_admin' => 'nullable|file|max:10240', // máximo 10MB
        ]);

        $reclamacion = Reclamacion::findOrFail($id);

        $reclamacion->resolucion_admin = $request->resolucion_admin;
        $reclamacion->estado_reclamacion = $request->estado_reclamacion;

        // Guardar archivo si se adjunta
        if ($request->hasFile('archivos_admin')) {
            $ruta = $request->file('archivos_admin')->store('reclamaciones_admin', 'public');
            $reclamacion->archivos_admin = $ruta;
        }

        $reclamacion->save();

        return redirect()->route('admin.reclamaciones.index')->with('success', 'Reclamación actualizada correctamente.');
    }
    public function misReclamaciones()
    {
        $reclamaciones = \App\Models\Reclamacion::where('id_usuario_emisor', Auth::id())
            ->with(['intercambio.objetoEmisor', 'intercambio.objetoReceptor'])
            ->latest()
            ->get();

        return view('reclamaciones.index', compact('reclamaciones'));
    }
    public function showUser($id)
    {
        $reclamacion = Reclamacion::where('id', $id)
            ->where('id_usuario_emisor', Auth::id())
            ->firstOrFail();

        return view('reclamaciones.show', compact('reclamacion'));
    }
}

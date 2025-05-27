<?php

namespace App\Http\Controllers;

use App\Models\Intercambio;
use App\Models\Objeto;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntercambioController extends Controller
{
    // Ver intercambios en los que participa el usuario
    public function index()
    {
        $userId = Auth::id();

        $intercambios = Intercambio::with(['objetoEmisor.imagenes', 'objetoReceptor.imagenes', 'objetoEmisor.usuario', 'objetoReceptor.usuario'])


            ->where(function ($query) use ($userId) {
                $query->where('id_usuario_emisor', $userId)
                    ->orWhere('id_usuario_receptor', $userId);
            })
            ->latest()
            ->get();

        return view('intercambios.index', compact('intercambios'));
    }

    // Mostrar formulario para solicitar un intercambio
    public function create($id_objeto)
    {
        $objetoReceptor = Objeto::findOrFail($id_objeto);

        // Objetos del usuario logueado
        $misObjetos = Objeto::where('usuario', Auth::id())->get();

        return view('intercambios.create', compact('objetoReceptor', 'misObjetos'));
    }

    // Guardar una solicitud de intercambio
    public function store(Request $request)
    {
        $request->validate([
            'id_objeto_emisor' => 'required|exists:objetos,id',
            'id_objeto_receptor' => 'required|exists:objetos,id',
        ]);

        $objetoReceptor = Objeto::findOrFail($request->id_objeto_receptor);

        $intercambio = Intercambio::create([
            'fecha' => now(),
            'estado' => 'pendiente',
            'id_usuario_emisor' => Auth::id(),
            'id_usuario_receptor' => (int) $objetoReceptor->usuario,
            'id_objeto_emisor' => $request->id_objeto_emisor,
            'id_objeto_receptor' => $request->id_objeto_receptor,
        ]);

        Mensaje::create([
            'id_emisor' => Auth::id(),
            'id_receptor' => $objetoReceptor->usuario,
            'contenido' => '¡Hola! Quiero intercambiar mi producto "' .
                $intercambio->objetoEmisor->titulo . '" por el tuyo "' .
                $intercambio->objetoReceptor->titulo . '".',
            'intercambio' => $intercambio->id, // si tienes esta relación
        ]);

        return redirect()->route('intercambios.index')->with('success', 'Solicitud de intercambio enviada.');
    }

    // Confirmar un intercambio
    public function confirmar($id)
    {
        $intercambio = Intercambio::findOrFail($id);

        if ($intercambio->id_usuario_receptor !== Auth::id()) {
            abort(403);
        }

        $intercambio->estado = 'confirmado';
        $intercambio->save();

        return back()->with('success', 'Intercambio confirmado.');
    }

    // Cancelar un intercambio
    public function cancelar($id)
    {
        $intercambio = Intercambio::findOrFail($id);

        if ($intercambio->id_usuario_emisor !== Auth::id() && $intercambio->id_usuario_receptor !== Auth::id()) {
            abort(403);
        }

        $intercambio->estado = 'cancelado';
        $intercambio->save();

        return back()->with('success', 'Intercambio cancelado.');
    }
}

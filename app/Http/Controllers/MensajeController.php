<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensajeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $mensajes = Mensaje::where('id_emisor', $user->id)
            ->orWhere('id_receptor', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mensajes.index', compact('mensajes'));
    }

    public function create(User $receptor)
    {
        return view('mensajes.create', compact('receptor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string',
            'id_receptor' => 'required|exists:users,id',
        ]);

        Mensaje::create([
            'contenido' => $request->contenido,
            'id_emisor' => Auth::id(), // ✅
            'id_receptor' => $request->id_receptor,
        ]);

        return redirect()->route('mensajes.conversacion', ['usuario' => $request->id_receptor])
            ->with('success', 'Mensaje enviado correctamente.');
    }
    public function conversaciones()
    {
        $userId = Auth::id();

        $usuariosConConversacion = Mensaje::where('id_emisor', $userId)
            ->orWhere('id_receptor', $userId)
            ->with(['emisor', 'receptor'])
            ->get()
            ->flatMap(function ($mensaje) use ($userId) {
                return [
                    $mensaje->id_emisor === $userId ? $mensaje->receptor : $mensaje->emisor
                ];
            })
            ->unique('id')
            ->values();

        return view('mensajes.index', compact('usuariosConConversacion'));
    }

    public function conversacion(User $usuario)
    {
        $userId = Auth::id();

        $mensajes = Mensaje::where(function ($query) use ($userId, $usuario) {
            $query->where('id_emisor', $userId)->where('id_receptor', $usuario->id);
        })->orWhere(function ($query) use ($userId, $usuario) {
            $query->where('id_emisor', $usuario->id)->where('id_receptor', $userId);
        })->orderBy('created_at')->get();

        return view('mensajes.conversacion', compact('usuario', 'mensajes'));
    }

    public function mensajeDesdeBaneado(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|max:1000',
        ]);

        $user = Auth::id();

        // Buscar todos los admins
        $admins = \App\Models\User::where('tipo_usuario', 'admin')->get();

        foreach ($admins as $admin) {
            Mensaje::create([
                'contenido' => $request->contenido,
                'id_emisor' => Auth::id(),
                'id_receptor' => $admin->id,
            ]);
        }

        return redirect()->back()->with('success', 'Mensaje enviado a los administradores.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Intercambio;
use App\Models\Valoracion;
use App\Models\Objeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::where('id', '!=',  Auth::id())->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function show(User $usuario)
    {
        $mediaPuntuacion = $usuario->valoraciones()->avg('puntuacion') ?? 0;
        $valoraciones = $usuario->valoraciones()->with('valorador')->latest()->get();

        // Verificar si el usuario autenticado puede valorar
        $puedeValorar = Intercambio::where('estado', 'confirmado')
            ->where(function ($q) use ($usuario) {
                $q->where('id_usuario_emisor', Auth::id())->where('id_usuario_receptor', $usuario->id)
                    ->orWhere('id_usuario_emisor', $usuario->id)->where('id_usuario_receptor', Auth::id());
            })
            ->exists();

        // Comprobar si ya lo ha valorado
        $yaValorado = Valoracion::where('id_usuario_valorado', $usuario->id)
            ->where('id_valorador', Auth::id())
            ->exists();

        // Obtener el intercambio confirmado (si existe)
        $intercambio = Intercambio::where('estado', 'confirmado')
            ->where(function ($q) use ($usuario) {
                $q->where('id_usuario_emisor', Auth::id())->where('id_usuario_receptor', $usuario->id)
                    ->orWhere('id_usuario_emisor', $usuario->id)->where('id_usuario_receptor', Auth::id());
            })
            ->latest()
            ->first();

        return view('usuarios.show', compact('usuario', 'mediaPuntuacion', 'valoraciones', 'puedeValorar', 'yaValorado', 'intercambio'));
    }
}

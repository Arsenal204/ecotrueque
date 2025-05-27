<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValoracionController extends Controller
{
    public function store(Request $request, User $usuario)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:255',
            'id_intercambio' => 'required|exists:intercambios,id',
        ]);

        Valoracion::create([
            'puntuacion' => $request->puntuacion,
            'comentario' => $request->comentario,
            'id_valorador' => Auth::id(),
            'id_usuario_valorado' => $usuario->id,
            'id_intercambio' => $request->id_intercambio,
        ]);


        return redirect()->route('usuarios.show', $usuario)->with('success', 'Valoración enviada.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.dashboard', compact('usuarios'));
    }
    public function destroy(User $user)
    {
        // No permitir eliminar al usuario autenticado
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('admin')->with('success', 'Usuario eliminado correctamente.');
    }


    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'tipo_usuario' => 'required|in:admin,donante,receptor',
        ]);

        $user->tipo_usuario = $request->tipo_usuario;
        $user->baneado = $request->has('baneado');
        $user->save();

        return redirect()->route('admin')->with('success', 'Usuario actualizado correctamente.');
    }
}

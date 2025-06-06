<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function mostrarFormulario()
    {
        $datos = ['titulo' => 'Formulario de contacto'];
        return view('contacto');
    }

    public function enviarFormulario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string|max:2000',
        ]);

        $datos = $request->only(['nombre', 'email', 'mensaje']);

        // Enviar email
        Mail::send('emails.contacto', ['datos' => $datos], function ($message) use ($datos) {
            $message->to('diegorobles031204@gmail.com') // o cualquier correo que quieras recibir
                ->subject('Nuevo mensaje de contacto desde EcoTrueque');
        });

        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string|max:1000',
        ]);

        $datos = $request->only('nombre', 'email', 'mensaje');

        // Enviar email al admin
        Mail::send('emails.contacto', $datos, function ($message) use ($datos) {
            $message->to('info@ecotrueque.com', 'EcoTrueque Admin')
                ->subject('Nuevo mensaje de contacto de ' . $datos['nombre']);
        });

        return back()->with('success', 'Tu mensaje se ha enviado correctamente. Te responderemos pronto.');
    }
}

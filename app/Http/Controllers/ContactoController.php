<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    // Mostrar formulario de contacto (público)
    public function show()
    {
        return view('contacto');
    }

    // Procesar envío del formulario
    public function enviar(Request $request)
    {
        // Validar datos
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string',
        ]);

        // Enviar email (podés configurar según tu mail)
        Mail::raw(
            "Nombre: {$data['nombre']}\nEmail: {$data['email']}\nMensaje:\n{$data['mensaje']}",
            function ($message) use ($data) {
                $message->to('contacto@lubricentro.com.ar') // Cambiá por tu email
                        ->subject('Nuevo mensaje desde formulario de contacto');
                $message->from($data['email'], $data['nombre']);
            }
        );

        return back()->with('success', 'Gracias por contactarnos. Te responderemos pronto.');
    }
}
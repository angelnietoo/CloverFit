<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Aquí puedes usar Mail para enviar un correo, por ejemplo:
        // Mail::to('admin@cloverfit.com')->send(new ContactMail($request));

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', '¡Mensaje enviado correctamente!');
    }
}

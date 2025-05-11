<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\CustomResetPassword; // Asegúrate de que esta ruta sea correcta

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',  // Asegurarnos de que el correo existe en la base de datos
        ]);

        // Obtener el usuario por su correo
        $user = User::where('email', $request->email)->first();

        // Verificar si el usuario existe
        if ($user) {
            // Generar un token de restablecimiento
            $token = app('auth.password.broker')->createToken($user);

            // Enviar la notificación personalizada de restablecimiento de contraseña
            $user->notify(new CustomResetPassword($token));

            // Retornar respuesta exitosa
            return back()->with('success', 'Te hemos enviado un enlace para restablecer tu contraseña.');
        }

        // Si no encontramos al usuario, mostrar un error
        return back()->with('error', 'No pudimos encontrar un usuario con ese correo electrónico.');
    }
}

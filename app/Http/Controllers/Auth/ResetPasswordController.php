<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function reset(Request $request)
    {
        // Validar los datos del formulario
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        // Restablecer la contraseña
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                ])->save();
            }
        );

        // Comprobar si la operación fue exitosa
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Tu contraseña ha sido restablecida exitosamente.');
        }

        return back()->with('error', 'Hubo un problema al restablecer tu contraseña. Intenta nuevamente.');
    }
}

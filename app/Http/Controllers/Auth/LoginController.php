<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Estas credenciales no coinciden con nuestros registros.');
        }

        //Verifica si el email ya está verificado
        if (is_null($user->email_verified_at)) {
            return back()->with('info', 'Debes verificar tu correo electrónico antes de iniciar sesión.');
        }

        //Verificar si la cuenta está bloqueada
        if ($user->bloqueado) {
            return back()->with('error', 'Su cuenta ha sido bloqueada. Si desea desbloquearla, haga clic en el botón "Desbloquear".');
        }

        // Verificar si el estatus es 0 (baja)
        if ($user->estatus == 0) {
            return back()->with('error', 'Este usuario ha sido dado de baja. No puede iniciar sesión.');
        }

        // Verificar si el password es correcto
        if (!Hash::check($request->password, $user->password)) {
            $user->intentos = $user->intentos + 1;

            // Bloquear si supera los 3 intentos
            if ($user->intentos >= 3) {
                $user->bloqueado = 1;
            }

            $user->save();

            return back()->with('error', 'Corrreo o contraseña incorrectos.');
        }

        $user->intentos = 0;
        $user->save();

        Auth::login($user, $request->filled('remember'));

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

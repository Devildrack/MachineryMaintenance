<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UnlockAccountController extends Controller
{
    public function index()
    {
        return view('auth.unlock-account');
    }

    public function sendUnlockLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        // Crear URL firmada
        $url = URL::temporarySignedRoute(
            'unlock.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // Enviar correo
        Mail::send('emails.unlock-account', [
            'user' => $user,
            'unlockUrl' => $url
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Desbloqueo de Cuenta');
        });

        return back()->with('success', 'Te hemos enviado un enlace para desbloquear tu cuenta.');
    }

    public function verifyUnlock(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! $request->hasValidSignature() || sha1($user->email) !== $hash) {
            return redirect()->route('login')->with('error', 'El enlace no es válido o ha expirado.');
        }

        $user->bloqueado = 0;
        $user->intentos = 0;
        $user->save();

        return redirect()->route('login')->with('success', 'Su cuenta ha sido desbloqueada. Puede iniciar sesión.');
    }
}

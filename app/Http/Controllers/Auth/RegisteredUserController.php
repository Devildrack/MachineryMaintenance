<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use App\Notifications\EmailVerify;

class RegisteredUserController extends Controller
{
    public function create()
    {
        // Muestra la vista del registro
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estatus' => 1,
        ]);
        $user->notify(new EmailVerify($user));
        return redirect()->route('login')->with('success', 'Registro exitoso, por favor verifica tu correo.');
    }
}

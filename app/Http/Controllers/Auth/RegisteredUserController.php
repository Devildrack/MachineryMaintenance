<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use App\Notifications\EmailVerify;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    public function create()
    {
        // Muestra la vista del registro
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
        ], [
            'email.unique' => 'Este correo ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        if ($validator->fails()) {
            // Obtener el primer mensaje de error
            $firstError = $validator->errors()->first();
            return redirect()->route('register')
                ->with('error', $firstError)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estatus' => 1,
        ]);

        if (User::count() === 1) {
            $user->assignRole('admin');
        }

        $user->notify(new EmailVerify($user));
        return redirect()->route('login')->with('success', 'Registro exitoso, por favor verifica tu correo.');
    }
}

<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Log;
use Laravel\Jetstream\Jetstream;
use App\Notifications\EmailVerify;
use Illuminate\Auth\Notifications\VerifyEmail;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'estatus' => 1,
        ]);

        Log::info('Usuario creado correctamente: ' . $user->email);

        try {
            $user->notify(new EmailVerify($user));
            Log::info('Notificación de verificación enviada a: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Error enviando la notificación: ' . $e->getMessage());
        }

        return $user;
    }
}

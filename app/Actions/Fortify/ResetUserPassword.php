<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Valida e redefine a password esquecida do utilizador.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function reset(User $user, array $input): void
    {
        //validar a nova password
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        //guardar a nova password encriptada
        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}

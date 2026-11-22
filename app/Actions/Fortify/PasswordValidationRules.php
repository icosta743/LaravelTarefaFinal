<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

//regras da password (criado pelo Fortify)
trait PasswordValidationRules
{
    //devolve as regras de validação da password
    protected function passwordRules(): array
    {
        //obrigatória, mínimo 8 caracteres e igual à confirmação
        return ['required', 'string', Password::default(), 'confirmed'];
    }
}

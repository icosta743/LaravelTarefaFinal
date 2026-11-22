<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;


class CreateNewUser implements CreatesNewUsers
{
    //vai buscar as regras da password ao ficheiro PasswordValidationRules
    use PasswordValidationRules;

    /**
     * Valida os dados e cria um novo utilizador registado.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */

    public function create(array $input): User
    {
        //validar os dados que vêm do formulário de registo
        Validator::make($input, [
            //o nome e o email são obrigatórios, texto, com no máximo 255 caracteres
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        //depois de validados, inserir o utilizador na base de dados
        //o user_type não é enviado, por isso fica com o valor por defeito (8 = utilizador normal)
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            //a password é encriptada antes de ser guardada
            'password' => Hash::make($input['password']),
        ]);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//campos que podem ser preenchidos no registo
#[Fillable(['name', 'email', 'password'])]
//campos que nunca são mostrados (a password e o token de sessão)
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    //tipos de utilizador (coluna user_type)
    //usados no blade com \App\Models\User::TYPE_ADMIN
    const TYPE_ADMIN = 1;
    const TYPE_GENERIC_USER = 8;

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Define como alguns campos são convertidos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            //a data de verificação do email é tratada como data
            'email_verified_at' => 'datetime',
            //a password é sempre guardada encriptada
            'password' => 'hashed',
        ];
    }
}

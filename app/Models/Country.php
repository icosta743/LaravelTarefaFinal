<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//model criado com: php artisan make:model Country
//representa a tabela countries (singular no model, plural na tabela)
class Country extends Model
{
    //extra: ao apagar, não apaga a linha, vai para a lixeira (preenche o deleted_at)
    //as consultas passam a esconder sozinhas os países que estão na lixeira
    use SoftDeletes;
}

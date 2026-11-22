<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//model da tabela cities
class City extends Model
{
    //ao apagar, vai para a lixeira (preenche o deleted_at)
    use SoftDeletes;
}

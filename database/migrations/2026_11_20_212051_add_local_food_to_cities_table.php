<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//migração criada com: php artisan make:migration add_local_food_to_cities_table
//serve para acrescentar uma coluna a uma tabela que já existe
return new class extends Migration
{
    /**
     * Corre a migração (acrescenta a coluna local_food).
     */
    public function up(): void
    {
        //Schema::table altera uma tabela que já existe (não cria uma nova)
        Schema::table('cities', function (Blueprint $table) {
            //comida típica da cidade, pode ficar vazia, fica a seguir a coluna name
            $table->string('local_food')->nullable()->after('name');
        });
    }

    /**
     * Reverte a migração (apaga a coluna).
     */
    public function down(): void
    {
        //desfaz o up(): apaga a coluna se for feito php artisan migrate:rollback
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('local_food');
        });
    }
};

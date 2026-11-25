<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//migração criada com: php artisan make:migration create_cities_table
return new class extends Migration
{
    /**
     * Corre a migração (cria a tabela cities).
     */
    public function up(): void
    {
        //Schema::create cria uma tabela nova
        Schema::create('cities', function (Blueprint $table) {
            //chave primária, com número automático
            $table->id();
            //nome da cidade
            $table->string('name');
            //caminho da foto (pode ficar vazio)
            $table->string('photo')->nullable();
            //data da visita, formato AAAA-MM-DD (pode ficar vazia)
            $table->date('visited_at')->nullable();
            //cria as colunas created_at e updated_at
            $table->timestamps();
            //chave estrangeira: cada cidade pertence a um país
            //tem de ser do mesmo tipo do id dos países (unsignedBigInteger)
            $table->unsignedBigInteger('country_id');
            //liga o country_id ao id da tabela countries
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverte a migração (apaga a tabela).
     */
    public function down(): void
    {
        //apaga a tabela se for feito php artisan migrate:rollback
        Schema::dropIfExists('cities');
    }
};

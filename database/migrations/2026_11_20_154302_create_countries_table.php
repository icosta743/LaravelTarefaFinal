<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//migração criada com: php artisan make:migration create_countries_table
return new class extends Migration
{
    /**
     * Corre a migração (cria a tabela countries).
     */
    public function up(): void
    {
        //Schema::create cria uma tabela nova
        Schema::create('countries', function (Blueprint $table) {
            //chave primária, com número automático
            $table->id();
            //nome do país
            $table->string('name');
            //caminho da foto (pode ficar vazio)
            $table->string('photo')->nullable();
            //cria as colunas created_at e updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverte a migração (apaga a tabela).
     */
    public function down(): void
    {
        //apaga a tabela se for feito php artisan migrate:rollback
        Schema::dropIfExists('countries');
    }
};

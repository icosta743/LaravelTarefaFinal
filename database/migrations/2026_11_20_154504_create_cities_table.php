<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corre a migração (cria a tabela cities).
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //caminho da foto (pode ficar vazio)
            $table->string('photo')->nullable();
            //data da visita (pode ficar vazia)
            $table->date('visited_at')->nullable();
            $table->timestamps();
            //chave estrangeira: cada cidade pertence a um país
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverte a migração (apaga a tabela).
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};

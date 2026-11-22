<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corre a migração (cria a tabela countries).
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //caminho da foto (pode ficar vazio)
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverte a migração (apaga a tabela).
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

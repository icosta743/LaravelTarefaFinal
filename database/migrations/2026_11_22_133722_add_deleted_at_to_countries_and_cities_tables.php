<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corre a migração (acrescenta a coluna deleted_at para a lixeira).
     */
    public function up(): void
    {
        //softDeletes cria a coluna deleted_at
        Schema::table('countries', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverte a migração (apaga a coluna deleted_at).
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

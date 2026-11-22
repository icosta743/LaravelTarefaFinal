<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corre a migração (acrescenta a coluna local_food).
     */
    public function up(): void
    {
        //comida típica, a seguir à coluna name
        Schema::table('cities', function (Blueprint $table) {
            $table->string('local_food')->nullable()->after('name');
        });
    }

    /**
     * Reverte a migração (apaga a coluna).
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('local_food');
        });
    }
};

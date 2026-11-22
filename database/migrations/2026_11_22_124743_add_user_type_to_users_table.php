<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corre a migração (acrescenta a coluna user_type).
     */
    public function up(): void
    {
        //tipo de utilizador: 1 = admin, 8 = utilizador normal (por defeito)
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_type')->default(8)->after('email');
        });
    }

    /**
     * Reverte a migração (apaga a coluna).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_type');
        });
    }
    
};

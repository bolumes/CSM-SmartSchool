<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('matieres', function (Blueprint $table) {
            // Remover a restrição de unicidade das colunas name e code
            $table->dropUnique(['name']);  // Remove a restrição UNIQUE na coluna 'name'
            $table->dropUnique(['code']);  // Remove a restrição UNIQUE na coluna 'code'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matieres', function (Blueprint $table) {
            //
        });
    }
};

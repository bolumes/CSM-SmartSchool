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
        Schema::table('events', function (Blueprint $table) {
            // Adicionar a coluna matiere_id para fazer referência à tabela matieres
            if (!Schema::hasColumn('events', 'matiere_id')) {
                $table->unsignedBigInteger('matiere_id')->nullable();
            }

            // Adicionar a coluna professor_id para fazer referência à tabela professors
            if (!Schema::hasColumn('events', 'professor_id')) {
                $table->unsignedBigInteger('professor_id')->nullable();
            }

            // Adicionar as chaves estrangeiras para as colunas matiere_id e professor_id
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('set null')->onUpdate('cascade');

            // Remover a coluna name, caso não seja mais necessária
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Remover as chaves estrangeiras
            $table->dropForeign(['matiere_id']);
            $table->dropForeign(['professor_id']);
            
            // Remover as colunas
            $table->dropColumn('matiere_id');
            $table->dropColumn('professor_id');
            
            // Se necessário, adicionar de volta a coluna 'name'
            $table->string('name');
        });
    }
};

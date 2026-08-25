<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Criar tabela de inscrições.
     */
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Aluno
            |--------------------------------------------------------------------------
            */
            $table->foreignId('eleve_id')
                ->constrained('eleves')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Classe
            |--------------------------------------------------------------------------
            |
            | O nível NÃO é guardado aqui.
            | O nível vem de classes.level.
            |
            */
            $table->foreignId('classe_id')
                ->constrained('classes')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Ano letivo
            |--------------------------------------------------------------------------
            */
            $table->foreignId('annee_scolaire_id')
                ->constrained('annees_scolaires')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Data da inscrição
            |--------------------------------------------------------------------------
            */
            $table->date('data_inscricao');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Evitar inscrições duplicadas
            |--------------------------------------------------------------------------
            |
            | O mesmo aluno não pode estar duas vezes na mesma
            | classe durante o mesmo ano letivo.
            |
            */
            $table->unique([
                'eleve_id',
                'classe_id',
                'annee_scolaire_id',
            ], 'inscriptions_unique');
        });
    }

    /**
     * Reverter migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
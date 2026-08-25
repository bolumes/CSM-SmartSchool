<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {

            $table->foreignId('eleve_id')
                ->nullable()
                ->after('id')
                ->constrained('eleves')
                ->onDelete('cascade');

            $table->foreignId('classe_id')
                ->nullable()
                ->after('eleve_id')
                ->constrained('classes')
                ->onDelete('restrict');

            $table->foreignId('annee_scolaire_id')
                ->nullable()
                ->after('classe_id')
                ->constrained('annees_scolaires')
                ->onDelete('restrict');

            $table->date('data_inscricao')
                ->nullable()
                ->after('annee_scolaire_id');
        });
    }

    public function down(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {

            $table->dropForeign(['eleve_id']);
            $table->dropForeign(['classe_id']);
            $table->dropForeign(['annee_scolaire_id']);

            $table->dropColumn([
                'eleve_id',
                'classe_id',
                'annee_scolaire_id',
                'data_inscricao',
            ]);
        });
    }
};
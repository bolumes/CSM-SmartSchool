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
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            // Relações
            $table->foreignId('eleve_id')
                  ->constrained('eleves')
                  ->cascadeOnDelete();

            $table->foreignId('classe_id')
                  ->constrained('classes')
                  ->cascadeOnDelete();

            $table->foreignId('matiere_id')
                  ->constrained('matieres')
                  ->cascadeOnDelete();

            $table->foreignId('professor_id')
                  ->constrained('professors')
                  ->cascadeOnDelete();

            // Data da aula
            $table->date('attendance_date');

            // Número da aula (1ª, 2ª, 3ª...)
            $table->unsignedTinyInteger('lesson_number');

            // Estado
            $table->enum('status', [
                'present',
                'absent',
                'late',
                'justified'
            ])->default('present');

            // Observações
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Evita duplicações
            $table->unique([
                'eleve_id',
                'attendance_date',
                'lesson_number',
                'matiere_id'
            ], 'attendance_unique');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

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
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da sala
            $table->string('reservar'); // Se a sala pode ser reservada
            $table->string('categoria'); // Categoria da sala
            $table->integer('capacidade'); // Capacidade da sala (agora é integer, não string)
            $table->foreignId('edificio_id')->constrained('edificios')->onDelete('cascade'); // chave estrangeira para a tabela edificios
            $table->string('caracteristicas')->nullable(); // Características da sala (opcional)
            $table->string('localizacao')->nullable(); // Localização da sala (opcional)
            $table->string('imagem')->nullable(); // Imagem da sala (opcional)
            $table->timestamps(); // Campos de created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salas');
    }
};

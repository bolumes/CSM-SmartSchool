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
        Schema::create('progevents', function (Blueprint $table) {
            $table->id();

            $table->date('date');             // Data do evento
            $table->time('start');            // Hora de início
            $table->time('end');              // Hora de término

            $table->unsignedBigInteger('sala_id');    // ID da sala
            $table->unsignedBigInteger('event_id');   // ID do evento

            $table->timestamps();

            // Chaves estrangeiras (caso tenha as tabelas `salas` e `events`)
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progevents');
    }
};

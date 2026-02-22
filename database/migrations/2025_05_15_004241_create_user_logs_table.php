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
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // FK para usuário
            $table->string('fonction');            // Ex: Admin, Direction, etc.
            $table->dateTime('logged_in_at');      // Data e hora do login
            $table->string('ip_address')->nullable(); // IP do login
            $table->timestamps();

            // Definindo chave estrangeira com integridade referencial
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};

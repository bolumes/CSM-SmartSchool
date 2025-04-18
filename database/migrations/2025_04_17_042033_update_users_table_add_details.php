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
        Schema::table('users', function (Blueprint $table) {
            // Remover o campo antigo
            $table->dropColumn('name');

            // Adicionar os novos campos
            $table->string('firstname');
            $table->string('lastname');
            $table->string('telephone');
            $table->string('address');
            $table->string('function');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverter a remoção de 'name'
            $table->string('name');

            // Remover os campos adicionados
            $table->dropColumn(['firstname', 'lastname', 'telephone', 'address', 'function']);
        });
    }
};

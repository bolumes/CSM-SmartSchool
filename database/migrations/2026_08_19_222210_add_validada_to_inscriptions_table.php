<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {

            $table->boolean('validada')
                ->default(false)
                ->after('data_inscricao');

            $table->timestamp('data_validacao')
                ->nullable()
                ->after('validada');
        });
    }

    public function down(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {

            $table->dropColumn([
                'validada',
                'data_validacao'
            ]);
        });
    }
};
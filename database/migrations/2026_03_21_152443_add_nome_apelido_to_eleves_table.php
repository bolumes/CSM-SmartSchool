<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->string('nome')->nullable()->after('matricula');
            $table->string('apelido')->nullable()->after('nome');
        });
    }

    public function down()
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->dropColumn(['nome', 'apelido']);
        });
    }
};

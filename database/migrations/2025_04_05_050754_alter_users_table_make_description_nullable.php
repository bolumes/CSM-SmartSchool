<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableMakeDescriptionNullable extends Migration
{
    /**
     * Rodar a migration para alterar o campo 'description' para ser nullable.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Altera o campo 'description' para ser nullable
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverter a alteração, tornando o campo 'description' obrigatório novamente.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverte a alteração, tornando 'description' não nullable
            $table->text('description')->nullable(false)->change();
        });
    }
}

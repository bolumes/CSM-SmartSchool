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
            $table->boolean('chat_direction')->default(false);
            $table->boolean('chat_professor')->default(false);
            $table->boolean('chat_parent')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'chat_direction',
                'chat_professor',
                'chat_parent'
            ]);
        });
    }
};

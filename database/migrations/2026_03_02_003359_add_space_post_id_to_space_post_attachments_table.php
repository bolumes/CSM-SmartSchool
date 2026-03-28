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
        Schema::table('space_post_attachments', function (Blueprint $table) {
            $table->foreignId('space_post_id')
                  ->after('id')
                  ->constrained('space_posts')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('space_post_attachments', function (Blueprint $table) {
            $table->dropForeign(['space_post_id']);
            $table->dropColumn('space_post_id');
        });
    }
};

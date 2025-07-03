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
        Schema::table('mentors', function (Blueprint $table) {
            // Tambahkan kolom user_id sebagai foreign key, bisa nullable jika mentor admin tidak selalu punya user_id
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            // Tambahkan unique constraint jika setiap user hanya bisa jadi satu mentor
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn('user_id');
        });
    }
};
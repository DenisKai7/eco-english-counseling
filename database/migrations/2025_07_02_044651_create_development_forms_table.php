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
        Schema::create('development_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Untuk user anak/orang tua
            $table->foreignId('mentor_id')->nullable()->constrained('mentors')->onDelete('cascade'); // Untuk guru/mentor
            $table->enum('form_type', ['child_abk', 'parent', 'teacher_mentor']); // Tipe form
            $table->text('data'); // Menyimpan data form dalam format JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_forms');
    }
};
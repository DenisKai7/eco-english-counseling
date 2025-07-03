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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content'); // Konten materi (teks, bisa dilengkapi dengan embed)
            $table->enum('level', ['basic', 'intermediate', 'advanced'])->default('basic'); // Tingkat materi
            $table->foreignId('mentor_id')->constrained('mentors')->onDelete('cascade'); // Mentor yang membuat materi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
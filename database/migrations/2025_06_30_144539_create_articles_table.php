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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL yang rapi
            $table->text('content');
            $table->string('image')->nullable(); // Path gambar artikel
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Admin yang membuat
            $table->enum('category', ['counseling', 'english_special_needs']); // Kategori artikel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
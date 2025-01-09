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
        Schema::create('lesson_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('Lessons')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_tags');
    }
};
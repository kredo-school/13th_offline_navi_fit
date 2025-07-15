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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->text('description')->nullable();
            $table->json('muscle_groups'); // ["chest", "arms", "shoulders"]
            $table->enum('equipment_category', ['barbell', 'dumbbell', 'machine', 'bodyweight', 'timer']);
            $table->string('equipment_needed', 255)->nullable();
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->text('instructions')->nullable();
            $table->string('image_url', 500)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes for performance
            $table->index('equipment_category');
            $table->index('difficulty');
            $table->index('is_active');
            $table->index(['equipment_category', 'difficulty'], 'exercises_category_difficulty_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};

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
        Schema::create('template_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
            $table->unsignedSmallInteger('order_index');
            $table->unsignedTinyInteger('sets');
            $table->unsignedSmallInteger('reps');
            $table->unsignedSmallInteger('rest_seconds')->nullable();
            $table->unsignedInteger('duration_seconds')->nullable(); // For time-based exercises
            $table->timestamps();

            // Indexes for performance
            $table->index(['template_id', 'order_index'], 'template_exercises_template_order_idx');
            $table->index('exercise_id');

            // Ensure unique order within template
            $table->unique(['template_id', 'order_index'], 'template_exercises_template_order_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_exercises');
    }
};

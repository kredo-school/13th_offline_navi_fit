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
        if (! Schema::hasTable('menu_exercises')) {
            Schema::create('menu_exercises', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('menu_id');
                $table->unsignedBigInteger('exercise_id');
                $table->integer('order_index')->default(0);
                $table->integer('sets')->nullable();
                $table->integer('reps')->nullable();
                $table->integer('rest_seconds')->nullable();
                $table->integer('duration_seconds')->nullable();
                $table->timestamps();

                $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
                $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');

                $table->unique(['menu_id', 'exercise_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_exercises');
    }
};

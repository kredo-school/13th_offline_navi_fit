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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('target_weight', 5, 2)->unsigned();
            $table->date('target_date');
            $table->decimal('target_body_fat_percentage', 4, 2)->nullable();
            $table->unsignedTinyInteger('weekly_workout_frequency')->default(3);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // index
            $table->index(['user_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};

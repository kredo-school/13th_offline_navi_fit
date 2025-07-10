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
        Schema::create('training_record_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_record_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('exercise_id')->nullable(); // NULL until exercises table created
            $table->unsignedSmallInteger('order_index');
            $table->unsignedTinyInteger('sets');
            $table->unsignedSmallInteger('reps');
            $table->decimal('weight', 5, 2)->nullable();  // kg
            $table->string('notes', 500)->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index(['training_record_id', 'order_index'], 'training_record_details_training_record_id_order_index_index');

            // Index for future exercise_id foreign key
            $table->index('exercise_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_record_details');
    }
};

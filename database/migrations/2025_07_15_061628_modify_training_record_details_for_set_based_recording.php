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
        Schema::table('training_record_details', function (Blueprint $table) {
            // Remove the old sets column
            $table->dropColumn('sets');

            // Add set_number column for individual set tracking
            $table->unsignedSmallInteger('set_number')->after('order_index');

            // Add composite index for efficient queries (simplified name)
            $table->index(['training_record_id', 'exercise_id', 'set_number'], 'trd_composite_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_record_details', function (Blueprint $table) {
            // Remove the composite index
            $table->dropIndex('trd_composite_idx');

            // Remove set_number column
            $table->dropColumn('set_number');

            // Add back the sets column
            $table->unsignedTinyInteger('sets')->after('order_index');
        });
    }
};

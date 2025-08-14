<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightToTemplateExercises extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('template_exercises', function (Blueprint $table) {
            $table->decimal('weight', 5, 2)->nullable()->after('reps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_exercises', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu_exercises', function (Blueprint $table) {
            $table->decimal('weight', 8, 2)->nullable()->after('reps');
        });
    }

    public function down(): void
    {
        Schema::table('menu_exercises', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
};

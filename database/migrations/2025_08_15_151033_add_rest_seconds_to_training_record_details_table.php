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
            $table->unsignedInteger('rest_seconds')->nullable()->after('duration_seconds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_record_details', function (Blueprint $table) {
            $table->dropColumn('rest_seconds');
        });
    }
};

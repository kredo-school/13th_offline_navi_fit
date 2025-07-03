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
        Schema::create('body_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('recorded_date');
            $table->decimal('weight', 5, 2);
            $table->decimal('body_fat_percentage', 4, 2)->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();

            // index
            $table->index(['user_id', 'recorded_date'], 'body_records_user_id_recorded_date_index');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body_records');
    }
};

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
        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            // $table->foreignId('based_on_template_id')->nullable()->constrained('templates')->onDelete('set null');
            $table->boolean('is_active')->default(true);

            $table->index(['user_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['based_on_template_id']);
            $table->dropIndex(['user_id', 'is_active']);
            $table->boolean('is_active')->default(true);
            $table->index(['user_id', 'is_active']);
            $table->dropColumn([
                'user_id',
                'name',
                'based_on_template_id',
                'is_active',
            ]);
        });
    }
};

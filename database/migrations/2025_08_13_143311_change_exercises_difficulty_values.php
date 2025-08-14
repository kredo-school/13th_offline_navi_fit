<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeExercisesDifficultyValues extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // まず一時的なカラムを追加
        Schema::table('exercises', function (Blueprint $table) {
            $table->string('difficulty_new', 20)->nullable()->after('difficulty');
        });

        // データをマッピング
        DB::table('exercises')->where('difficulty', 'beginner')->update(['difficulty_new' => 'easy']);
        DB::table('exercises')->where('difficulty', 'intermediate')->update(['difficulty_new' => 'normal']);
        DB::table('exercises')->where('difficulty', 'advanced')->update(['difficulty_new' => 'hard']);

        // インデックスを削除
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropIndex('exercises_difficulty_index');
            $table->dropIndex('exercises_category_difficulty_idx');
        });

        // 元のカラムを削除して新しく作成
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });

        Schema::table('exercises', function (Blueprint $table) {
            $table->enum('difficulty', ['easy', 'normal', 'hard'])->default('normal')->after('equipment_needed');
        });

        // データを戻す
        DB::table('exercises')->update(['difficulty' => DB::raw('difficulty_new')]);

        // 一時カラムを削除
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn('difficulty_new');
            $table->index('difficulty');
            $table->index(['equipment_category', 'difficulty'], 'exercises_category_difficulty_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 同様の手順で元に戻す
        Schema::table('exercises', function (Blueprint $table) {
            $table->string('difficulty_old', 20)->nullable()->after('difficulty');
        });

        // データをマッピング
        DB::table('exercises')->where('difficulty', 'easy')->update(['difficulty_old' => 'beginner']);
        DB::table('exercises')->where('difficulty', 'normal')->update(['difficulty_old' => 'intermediate']);
        DB::table('exercises')->where('difficulty', 'hard')->update(['difficulty_old' => 'advanced']);

        // インデックスを削除
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropIndex('exercises_difficulty_index');
            $table->dropIndex('exercises_category_difficulty_idx');
        });

        // 元のカラムを削除して新しく作成
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });

        Schema::table('exercises', function (Blueprint $table) {
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced'])->default('beginner')->after('equipment_needed');
        });

        // データを戻す
        DB::table('exercises')->update(['difficulty' => DB::raw('difficulty_old')]);

        // 一時カラムを削除
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn('difficulty_old');
            $table->index('difficulty');
            $table->index(['equipment_category', 'difficulty'], 'exercises_category_difficulty_idx');
        });
    }
}

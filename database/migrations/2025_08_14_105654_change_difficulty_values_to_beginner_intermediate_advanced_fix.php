<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // templatesテーブルのdifficultyカラムのENUM値変更
        Schema::table('templates', function (Blueprint $table) {
            // 一時カラムを追加
            $table->enum('difficulty_new', ['beginner', 'intermediate', 'advanced'])->nullable()->after('difficulty');
        });

        // データ変換
        DB::statement("UPDATE templates SET difficulty_new = CASE 
            WHEN difficulty = 'easy' THEN 'beginner'
            WHEN difficulty = 'normal' THEN 'intermediate'
            WHEN difficulty = 'hard' THEN 'advanced'
            ELSE NULL END");

        // 旧カラム削除と新カラムリネーム
        Schema::table('templates', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });

        Schema::table('templates', function (Blueprint $table) {
            $table->renameColumn('difficulty_new', 'difficulty');
        });

        // default値の設定
        DB::statement("ALTER TABLE templates MODIFY difficulty ENUM('beginner', 'intermediate', 'advanced') NOT NULL DEFAULT 'intermediate'");

        // exercisesテーブルも同様に変更
        Schema::table('exercises', function (Blueprint $table) {
            $table->enum('difficulty_new', ['beginner', 'intermediate', 'advanced'])->nullable()->after('difficulty');
        });

        DB::statement("UPDATE exercises SET difficulty_new = CASE 
            WHEN difficulty = 'easy' THEN 'beginner'
            WHEN difficulty = 'normal' THEN 'intermediate'
            WHEN difficulty = 'hard' THEN 'advanced'
            ELSE NULL END");

        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });

        Schema::table('exercises', function (Blueprint $table) {
            $table->renameColumn('difficulty_new', 'difficulty');
        });

        DB::statement("ALTER TABLE exercises MODIFY difficulty ENUM('beginner', 'intermediate', 'advanced') NOT NULL DEFAULT 'intermediate'");

        // template_exercisesテーブルも同様に変更（存在する場合）
        if (Schema::hasTable('template_exercises') && Schema::hasColumn('template_exercises', 'difficulty')) {
            Schema::table('template_exercises', function (Blueprint $table) {
                $table->enum('difficulty_new', ['beginner', 'intermediate', 'advanced'])->nullable()->after('difficulty');
            });

            DB::statement("UPDATE template_exercises SET difficulty_new = CASE 
                WHEN difficulty = 'easy' THEN 'beginner'
                WHEN difficulty = 'normal' THEN 'intermediate'
                WHEN difficulty = 'hard' THEN 'advanced'
                ELSE NULL END");

            Schema::table('template_exercises', function (Blueprint $table) {
                $table->dropColumn('difficulty');
            });

            Schema::table('template_exercises', function (Blueprint $table) {
                $table->renameColumn('difficulty_new', 'difficulty');
            });

            DB::statement("ALTER TABLE template_exercises MODIFY difficulty ENUM('beginner', 'intermediate', 'advanced') NOT NULL DEFAULT 'intermediate'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 元に戻す処理（easy, normal, hardに戻す）
        // templatesテーブル
        Schema::table('templates', function (Blueprint $table) {
            $table->enum('difficulty_old', ['easy', 'normal', 'hard'])->nullable()->after('difficulty');
        });

        DB::statement("UPDATE templates SET difficulty_old = CASE 
            WHEN difficulty = 'beginner' THEN 'easy'
            WHEN difficulty = 'intermediate' THEN 'normal'
            WHEN difficulty = 'advanced' THEN 'hard'
            ELSE NULL END");

        Schema::table('templates', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });

        Schema::table('templates', function (Blueprint $table) {
            $table->renameColumn('difficulty_old', 'difficulty');
        });

        DB::statement("ALTER TABLE templates MODIFY difficulty ENUM('easy', 'normal', 'hard') NOT NULL DEFAULT 'normal'");

        // exercisesテーブル
        Schema::table('exercises', function (Blueprint $table) {
            $table->enum('difficulty_old', ['easy', 'normal', 'hard'])->nullable()->after('difficulty');
        });

        DB::statement("UPDATE exercises SET difficulty_old = CASE 
            WHEN difficulty = 'beginner' THEN 'easy'
            WHEN difficulty = 'intermediate' THEN 'normal'
            WHEN difficulty = 'advanced' THEN 'hard'
            ELSE NULL END");

        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn('difficulty');
        });

        Schema::table('exercises', function (Blueprint $table) {
            $table->renameColumn('difficulty_old', 'difficulty');
        });

        DB::statement("ALTER TABLE exercises MODIFY difficulty ENUM('easy', 'normal', 'hard') NOT NULL DEFAULT 'normal'");

        // template_exercisesテーブル
        if (Schema::hasTable('template_exercises') && Schema::hasColumn('template_exercises', 'difficulty')) {
            Schema::table('template_exercises', function (Blueprint $table) {
                $table->enum('difficulty_old', ['easy', 'normal', 'hard'])->nullable()->after('difficulty');
            });

            DB::statement("UPDATE template_exercises SET difficulty_old = CASE 
                WHEN difficulty = 'beginner' THEN 'easy'
                WHEN difficulty = 'intermediate' THEN 'normal'
                WHEN difficulty = 'advanced' THEN 'hard'
                ELSE NULL END");

            Schema::table('template_exercises', function (Blueprint $table) {
                $table->dropColumn('difficulty');
            });

            Schema::table('template_exercises', function (Blueprint $table) {
                $table->renameColumn('difficulty_old', 'difficulty');
            });

            DB::statement("ALTER TABLE template_exercises MODIFY difficulty ENUM('easy', 'normal', 'hard') NOT NULL DEFAULT 'normal'");
        }
    }
};

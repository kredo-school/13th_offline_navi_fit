<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 重量精度の統一 (menu_exercises.weight の精度を decimal(6,2) に変更)
        Schema::table('menu_exercises', function (Blueprint $table) {
            // カラム型の変更
            DB::statement('ALTER TABLE menu_exercises MODIFY weight decimal(6,2) NULL');
        });

        // exercise_id 制約強化 (NULL値を許可しない)
        // まず、既存のNULL値を確認
        $nullRecords = DB::table('training_record_details')
            ->whereNull('exercise_id')
            ->count();

        if ($nullRecords > 0) {
            // NULL値がある場合、ログにエラーを記録
            Log::error("Migration error: {$nullRecords} records have NULL exercise_id. Please fix these records first.");

            // マイグレーションを停止
            throw new \Exception("Migration aborted: {$nullRecords} NULL values found in training_record_details.exercise_id");
        } else {
            // NULL値がない場合、制約を追加
            Schema::table('training_record_details', function (Blueprint $table) {
                $table->bigInteger('exercise_id')->unsigned()->nullable(false)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 重量精度を元に戻す
        Schema::table('menu_exercises', function (Blueprint $table) {
            DB::statement('ALTER TABLE menu_exercises MODIFY weight decimal(8,2) NULL');
        });

        // DB::select("SHOW COLUMNS FROM menu_exercises LIKE 'weight'");exercise_id 制約を元に戻す
        Schema::table('training_record_details', function (Blueprint $table) {
            $table->bigInteger('exercise_id')->unsigned()->nullable()->change();
        });
    }
};

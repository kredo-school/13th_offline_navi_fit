<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * - Unify duration_seconds to be unsigned int across tables
     * - Add duration_seconds to training_record_details if missing
     * - Remove template_id from training_record_details if exists
     */
    public function up(): void
    {
        // menu_exercisesテーブルのduration_seconds型を統一
        Schema::table('menu_exercises', function (Blueprint $table) {
            // 既存のカラムを一旦変更 (intからunsigned intへ)
            $table->unsignedInteger('duration_seconds')->nullable()->change();
        });

        // training_record_detailsテーブルにduration_secondsが無ければ追加
        if (! Schema::hasColumn('training_record_details', 'duration_seconds')) {
            Schema::table('training_record_details', function (Blueprint $table) {
                $table->unsignedInteger('duration_seconds')->nullable()->after('weight');
            });
        }

        // training_record_detailsテーブルからtemplate_idを削除（存在する場合）
        if (Schema::hasColumn('training_record_details', 'template_id')) {
            Schema::table('training_record_details', function (Blueprint $table) {
                // 外部キー制約がある場合は先に削除
                $foreignKeys = $this->listTableForeignKeys('training_record_details');
                foreach ($foreignKeys as $key) {
                    if (str_contains($key, 'template_id')) {
                        $table->dropForeign($key);
                    }
                }

                $table->dropColumn('template_id');
            });
        }

        // 各テーブルのモデルやドキュメントにコメントを追加するための情報更新
        DB::statement("ALTER TABLE template_exercises COMMENT = 'duration_seconds: Time in seconds for one set of exercise'");
        DB::statement("ALTER TABLE menu_exercises COMMENT = 'duration_seconds: Time in seconds for one set of exercise'");
        DB::statement("ALTER TABLE training_record_details COMMENT = 'duration_seconds: Time in seconds for one set of exercise'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menu_exercisesテーブルのduration_seconds型を元に戻す
        Schema::table('menu_exercises', function (Blueprint $table) {
            // 通常のintegerに戻す
            $table->integer('duration_seconds')->nullable()->change();
        });

        // training_record_detailsテーブルに追加したduration_secondsを削除
        if (Schema::hasColumn('training_record_details', 'duration_seconds')) {
            Schema::table('training_record_details', function (Blueprint $table) {
                $table->dropColumn('duration_seconds');
            });
        }

        // template_idの復元（削除した場合のみ）
        // 注: ロールバック時にデータは復元されない
        if (! Schema::hasColumn('training_record_details', 'template_id')) {
            Schema::table('training_record_details', function (Blueprint $table) {
                $table->unsignedBigInteger('template_id')->nullable()->after('exercise_id');
                // 外部キー制約の再追加（必要な場合）
                // $table->foreign('template_id')->references('id')->on('templates');
            });
        }

        // テーブルコメントを元に戻す（空にする）
        DB::statement("ALTER TABLE template_exercises COMMENT = ''");
        DB::statement("ALTER TABLE menu_exercises COMMENT = ''");
        DB::statement("ALTER TABLE training_record_details COMMENT = ''");
    }

    /**
     * Get list of foreign keys for a table
     */
    private function listTableForeignKeys($table)
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();
        $foreignKeys = [];

        if (method_exists($conn, 'listTableForeignKeys')) {
            $tableForeignKeys = $conn->listTableForeignKeys($table);
            foreach ($tableForeignKeys as $key) {
                $foreignKeys[] = $key->getName();
            }
        }

        return $foreignKeys;
    }
};

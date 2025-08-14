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
        // templatesテーブルの修正
        // まず新しいカラムを追加
        Schema::table('templates', function (Blueprint $table) {
            if (! Schema::hasColumn('templates', 'image_path')) {
                $table->string('image_path')->nullable();
            }
        });

        // データ移行は別のステップで実行
        try {
            DB::statement('UPDATE templates SET image_path = thumbnail_path WHERE thumbnail_path IS NOT NULL');
        } catch (\Exception $e) {
            // エラーをログに記録するなど必要に応じて処理
            \Log::error('Migration error: '.$e->getMessage());
        }

        // 不要なカラムを削除
        Schema::table('templates', function (Blueprint $table) {
            if (Schema::hasColumn('templates', 'thumbnail_url')) {
                $table->dropColumn('thumbnail_url');
            }
        });

        Schema::table('templates', function (Blueprint $table) {
            if (Schema::hasColumn('templates', 'thumbnail_path')) {
                $table->dropColumn('thumbnail_path');
            }
        });

        // exercisesテーブルの修正
        // まずデータ移行
        try {
            if (Schema::hasColumn('exercises', 'image_url') && Schema::hasColumn('exercises', 'image_path')) {
                DB::statement('UPDATE exercises SET image_path = image_url WHERE image_path IS NULL AND image_url IS NOT NULL');
            }
        } catch (\Exception $e) {
            // エラーをログに記録するなど必要に応じて処理
            \Log::error('Migration error: '.$e->getMessage());
        }

        // 不要なカラムを削除
        Schema::table('exercises', function (Blueprint $table) {
            if (Schema::hasColumn('exercises', 'image_url')) {
                $table->dropColumn('image_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // templatesテーブルの復元
        Schema::table('templates', function (Blueprint $table) {
            $table->string('thumbnail_url')->nullable();
            $table->string('thumbnail_path')->nullable();
        });

        // データ復元
        try {
            DB::statement('UPDATE templates SET thumbnail_path = image_path WHERE image_path IS NOT NULL');
        } catch (\Exception $e) {
            \Log::error('Migration rollback error: '.$e->getMessage());
        }

        Schema::table('templates', function (Blueprint $table) {
            if (Schema::hasColumn('templates', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        // exercisesテーブルの復元
        Schema::table('exercises', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });

        // データ復元
        try {
            if (Schema::hasColumn('exercises', 'image_path')) {
                DB::statement('UPDATE exercises SET image_url = image_path WHERE image_path IS NOT NULL');
            }
        } catch (\Exception $e) {
            \Log::error('Migration rollback error: '.$e->getMessage());
        }
    }
};

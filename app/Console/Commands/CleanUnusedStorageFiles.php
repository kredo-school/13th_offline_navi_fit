<?php

namespace App\Console\Commands;

use App\Models\Exercise;
use App\Models\Profile;
use App\Models\Template;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanUnusedStorageFiles extends Command
{
    /**
     * コンソールコマンドの名前と形式
     *
     * @var string
     */
    protected $signature = 'storage:clean-unused {--dry-run : 削除されるファイルを表示するだけで実際には削除しない}';

    /**
     * コンソールコマンドの説明
     *
     * @var string
     */
    protected $description = 'データベースで参照されていない未使用の画像ファイルをストレージから削除';

    /**
     * コマンドの実行
     */
    public function handle()
    {
        $this->info('ストレージのクリーンアップを開始します...');
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->info('ドライランモードで実行中。ファイルは実際には削除されません。');
        }

        // ストレージディレクトリ内のすべてのファイルを取得
        $this->cleanDirectory('avatars', $this->getProfileAvatars(), $dryRun);
        $this->cleanDirectory('exercises', $this->getExerciseImages(), $dryRun);
        $this->cleanDirectory('templates', $this->getTemplateImages(), $dryRun);
        $this->cleanThumbnails($dryRun);

        $this->info('ストレージのクリーンアップが完了しました！');
    }

    /**
     * 特定のディレクトリから参照リストに含まれていないファイルを削除
     */
    private function cleanDirectory(string $directory, array $referencedFiles, bool $dryRun): void
    {
        $this->info("ディレクトリのクリーンアップ: {$directory}");

        // ディレクトリ内のすべてのファイルを取得
        $existingFiles = Storage::disk('public')->files($directory);
        $filesToDelete = [];

        // クリーンアップ前のカウント
        $beforeCount = count($existingFiles);
        $this->info("クリーンアップ前のファイル数: {$beforeCount}");

        // 一貫した比較のために参照ファイルのパスを正規化
        $normalizedReferencedFiles = array_map(function ($path) {
            return $this->normalizePath($path);
        }, $referencedFiles);

        // データベースで参照されていないファイルを検索
        foreach ($existingFiles as $file) {
            // ストレージファイルパスの正規化
            $normalizedFilePath = $this->normalizePath($file);

            if (! in_array($normalizedFilePath, $normalizedReferencedFiles)) {
                $filesToDelete[] = $file;
                $this->line("削除対象: {$file} (正規化後: {$normalizedFilePath})");
            }
        }

        // ドライランモードでなければ未使用ファイルを削除
        if (! $dryRun && count($filesToDelete) > 0) {
            Storage::disk('public')->delete($filesToDelete);
            $this->info("ディレクトリ {$directory} から ".count($filesToDelete).' 個の未使用ファイルを削除しました');
        } else {
            $this->info("ディレクトリ {$directory} で ".count($filesToDelete).' 個の削除対象ファイルを検出しました');
        }

        // クリーンアップ後のカウント
        $afterCount = $beforeCount - count($filesToDelete);
        $this->info("クリーンアップ後のファイル数: {$afterCount}");
    }

    /**
     * 既存のテンプレート画像に基づいてサムネイルディレクトリをクリーンアップ
     */
    private function cleanThumbnails(bool $dryRun): void
    {
        $this->info('サムネイルディレクトリのクリーンアップ');

        // すべてのテンプレート画像を取得（対応するサムネイルが必要）
        $templateImages = $this->getTemplateImages();

        // パスなしでベースファイル名を抽出
        $templateImageFilenames = array_map(function ($path) {
            return basename($path);
        }, $templateImages);

        // サムネイルディレクトリ内のすべてのファイルを取得
        $existingThumbnails = Storage::disk('public')->files('thumbnails');
        $filesToDelete = [];

        // クリーンアップ前のカウント
        $beforeCount = count($existingThumbnails);
        $this->info("クリーンアップ前のサムネイル数: {$beforeCount}");

        // 対応するテンプレート画像がないサムネイルを検索
        foreach ($existingThumbnails as $thumbnail) {
            $filename = basename($thumbnail);

            if (! in_array($filename, $templateImageFilenames)) {
                $filesToDelete[] = $thumbnail;
                $this->line("削除対象: {$thumbnail}");
            }
        }

        // ドライランモードでなければ未使用サムネイルを削除
        if (! $dryRun && count($filesToDelete) > 0) {
            Storage::disk('public')->delete($filesToDelete);
            $this->info('未使用サムネイル '.count($filesToDelete).' 個を削除しました');
        } else {
            $this->info('削除対象のサムネイル '.count($filesToDelete).' 個を検出しました');
        }

        // クリーンアップ後のカウント
        $afterCount = $beforeCount - count($filesToDelete);
        $this->info("クリーンアップ後のサムネイル数: {$afterCount}");
    }

    /**
     * 一貫した比較のためにファイルパスを正規化
     */
    private function normalizePath(string $path): string
    {
        // 先頭の 'public/storage/', 'storage/', 'public/' を安全に削除
        $path = preg_replace('#^(public/storage/|storage/|public/)#', '', $path);

        // ディレクトリ区切り文字をスラッシュに正規化
        $path = str_replace('\\', '/', $path);

        return $path;
    }

    /**
     * データベースで参照されているすべてのプロフィールアバターを取得
     */
    private function getProfileAvatars(): array
    {
        return Profile::whereNotNull('avatar')
            ->pluck('avatar')
            ->toArray();
    }

    /**
     * データベースで参照されているすべてのエクササイズ画像を取得
     */
    private function getExerciseImages(): array
    {
        return Exercise::whereNotNull('image_path')
            ->pluck('image_path')
            ->toArray();
    }

    /**
     * データベースで参照されているすべてのテンプレート画像を取得
     */
    private function getTemplateImages(): array
    {
        return Template::whereNotNull('image_path')
            ->pluck('image_path')
            ->toArray();
    }
}

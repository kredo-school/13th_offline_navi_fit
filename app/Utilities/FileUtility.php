<?php

namespace App\Utilities;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUtility
{
    /**
     * Replace an old file with a new one
     *
     * @param  UploadedFile  $file  New file to upload
     * @param  string|null  $oldFilePath  Path to the old file that will be deleted
     * @param  string  $directory  Directory to store the new file
     * @return string Path to the new file
     */
    public static function replaceFile(UploadedFile $file, ?string $oldFilePath, string $directory): string
    {
        // Delete old file if it exists
        if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
            Storage::disk('public')->delete($oldFilePath);
        }

        // Store and return path to the new file
        return $file->store($directory, 'public');
    }
}

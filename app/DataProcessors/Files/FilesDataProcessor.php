<?php

namespace App\DataProcessors\Files;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class FilesDataProcessor
{
    public static function uploadFile(?UploadedFile $file, string $folder = 'general'): string|bool
    {
        if (! $file) {
            return false;
        }

        try {
            self::makeDir("files/$folder");

            $savedFileName = Str::ulid().".{$file->getClientOriginalExtension()}";

            return $file
                ->storePubliclyAs(
                    path: "files/$folder",
                    name: $savedFileName,
                    options: ['disk' => 'public']
                );
        } catch (\Throwable $exception) {
            errorLog($exception);

            return false;
        }
    }

    public static function getUploadedFileType(?UploadedFile $file): ?string
    {
        return $file?->getMimeType();
    }

    public static function addToZip(array $fileNames): string
    {
        self::makeDir('downloads');

        $zipFile = 'storage/downloads/'.Str::orderedUuid().'.zip';

        $zip = new ZipArchive;

        $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($fileNames as $fileName) {
            $zip->addFile(Storage::disk('public')->path($fileName), Str::of($fileName)->replace('files/attachments/', ''));
        }

        $zip->close();

        return $zipFile;
    }

    public static function makeDir(string $dir): void
    {
        //        if (! is_dir($dir = storage_path("app/public/$dir"))) {
        //            Storage::makeDirectory($dir);
        //            // mkdir($dir, 0775);
        //        }

        if (! Storage::exists($dir)) {
            Storage::makeDirectory($dir);
            if (Storage::exists($dir)) {
                Log::info("Directory created successfully: $dir");
            } else {
                Log::error("Failed to create directory: $dir");
            }
        } else {
            Log::info("Directory already exists: $dir");
        }
    }
}

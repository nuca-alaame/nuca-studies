<?php

namespace App\DataProcessors\Files;

use Carbon\Carbon;
use HeadlessChromium\BrowserFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PdfDataProcessor
{
    private static string $folderName;

    private static string $path;

    public static function generate(string $view, $data, ?string $folderName = null, ?string $fileName = null): ?string
    {
        try {

            self::$folderName = $folderName ?? 'pdfs';

            self::$path = (str_replace([':', '+', 'T', '-'], '_', $fileName ?? Carbon::now()->toIso8601String())).'.pdf';

            $htmlContent = view($view, $data)->render();

            $browserFactory = new BrowserFactory(env('CHROME_BIN', null));

            $browser = $browserFactory->createBrowser([
                'enableImages' => true,
            ]);

            $page = $browser->createPage();

            // Set HTML content to the page
            $page->setHtml($htmlContent, 60000);

            sleep(3);

            self::createFolders(self::$folderName);

            $fileName = 'generated_files/'.self::$folderName.'/'.self::$path;

            $fullPathFile = public_path('storage/'.$fileName);

            File::delete($fullPathFile);

            $page->pdf([
                'preferCSSPageSize' => true,
                'printBackground' => true,
                'marginTop' => 0.50,
                'marginBottom' => 0.50,
                'marginLeft' => 0.40,
                'marginRight' => 0.20,
                'scale' => 0.99,
                'displayHeaderFooter' => false,
            ])->saveToFile($fullPathFile);

            $browser->close();

            return Storage::disk('public')->url($fileName);

        } catch (\Throwable $throwable) {
            errorLog($throwable);
        }

        return null;
    }

    private static function createFolders(string $folderName): void
    {
        if (! Storage::exists('public'.DIRECTORY_SEPARATOR.'generated_files')) {
            FilesDataProcessor::makeDir('generated_files');
            Storage::makeDirectory('public'.DIRECTORY_SEPARATOR.'generated_files', 0755);
        }

        $folder = 'public'.DIRECTORY_SEPARATOR.'generated_files'.DIRECTORY_SEPARATOR.$folderName;
        if (! Storage::exists($folder)) {
            FilesDataProcessor::makeDir('generated_files'.DIRECTORY_SEPARATOR.$folderName);
        }
    }
}

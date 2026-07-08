<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageOptimizer;

class ConvertImagesToWebp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:convert-webp {--dirs=* : Public directories to scan} {--quality=85 : WebP quality (1-100)} {--dry-run : Only show files that would be converted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan public image directories and create missing WebP versions for JPEG/PNG/GIF files.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dirs = $this->option('dirs');
        if (empty($dirs)) {
            $dirs = config('imageoptimizer.scan_dirs', [
                'images',
                'faculty',
                'frontend/imgs',
                'frontend/imgs/sus',
                'assets/frontend/imgs',
                'uploads/products',
                'boucher',
                'videos',
            ]);
        }

        $quality = (int) $this->option('quality');
        if ($quality < 1 || $quality > 100) {
            $quality = config('imageoptimizer.quality', 85);
        }

        $dryRun = $this->option('dry-run');

        $found = 0;
        $converted = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($dirs as $dir) {
            $publicDir = public_path(trim($dir, '/'));
            if (!is_dir($publicDir)) {
                $this->warn("Skipping missing directory: {$publicDir}");
                continue;
            }

            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($publicDir, \FilesystemIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if (!$file->isFile()) {
                    continue;
                }

                $filename = $file->getFilename();
                if (!preg_match('/\.(jpe?g|png|gif)$/i', $filename)) {
                    continue;
                }

                $found++;
                $sourcePath = $file->getRealPath();
                $destinationPath = preg_replace('/\.(jpe?g|png|gif)$/i', '.webp', $sourcePath);

                if (file_exists($destinationPath) && filemtime($destinationPath) >= filemtime($sourcePath)) {
                    $skipped++;
                    continue;
                }

                if ($dryRun) {
                    $this->line("Would convert: {$sourcePath} -> {$destinationPath}");
                    continue;
                }

                $this->line("Converting: {$sourcePath}");
                if (ImageOptimizer::convertToWebp($sourcePath, $destinationPath, $quality)) {
                    $converted++;
                } else {
                    $failed++;
                    $this->error("Failed: {$sourcePath}");
                }
            }
        }

        $this->info("Scan complete. Found: {$found}, Converted: {$converted}, Skipped: {$skipped}, Failed: {$failed}.");

        return $failed > 0 ? 1 : 0;
    }
}

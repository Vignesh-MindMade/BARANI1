<?php

namespace App\Services;

class ImageOptimizer
{
    /**
     * Convert a local JPEG/PNG/GIF image to WebP.
     *
     * @param string $sourcePath
     * @param string|null $destinationPath
     * @param int $quality
     * @return bool
     */
    public static function convertToWebp(string $sourcePath, ?string $destinationPath = null, int $quality = 85): bool
    {
        if (!file_exists($sourcePath) || !is_readable($sourcePath)) {
            return false;
        }

        if ($destinationPath === null) {
            $destinationPath = preg_replace('/\.(jpe?g|png|gif)$/i', '.webp', $sourcePath);
        }

        if (!preg_match('/\.(jpe?g|png|gif)$/i', $sourcePath)) {
            return false;
        }

        if (file_exists($destinationPath) && filemtime($destinationPath) >= filemtime($sourcePath)) {
            return true;
        }

        $destinationDir = dirname($destinationPath);
        if (!is_dir($destinationDir) && !mkdir($destinationDir, 0755, true) && !is_dir($destinationDir)) {
            return false;
        }

        if (function_exists('ini_set')) {
            @ini_set('memory_limit', '512M');
        }

        $imageSize = @getimagesize($sourcePath);
        if ($imageSize === false) {
            return false;
        }

        list($width, $height) = $imageSize;
        $estimated = $width * $height * 5;
        $currentUsage = function_exists('memory_get_usage') ? memory_get_usage(true) : 0;
        $memoryLimit = self::getMemoryLimitBytes();
        if ($memoryLimit > 0 && ($currentUsage + $estimated) > $memoryLimit) {
            return false;
        }

        $imageData = file_get_contents($sourcePath);
        if ($imageData === false) {
            return false;
        }

        $image = @imagecreatefromstring($imageData);
        if (!$image) {
            return false;
        }

        if (!imageistruecolor($image)) {
            $trueColor = imagecreatetruecolor(imagesx($image), imagesy($image));
            if (preg_match('/\.(png|gif)$/i', $sourcePath)) {
                imagealphablending($trueColor, false);
                imagesavealpha($trueColor, true);
                $transparent = imagecolortransparent($image);
                if ($transparent >= 0) {
                    $transparentColor = imagecolorsforindex($image, $transparent);
                    $transparentIndex = imagecolorallocate($trueColor, $transparentColor['red'], $transparentColor['green'], $transparentColor['blue']);
                    imagefill($trueColor, 0, 0, $transparentIndex);
                    imagecolortransparent($trueColor, $transparentIndex);
                } else {
                    $transparent = imagecolorallocatealpha($trueColor, 0, 0, 0, 127);
                    imagefill($trueColor, 0, 0, $transparent);
                }
            }
            imagecopy($trueColor, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            imagedestroy($image);
            $image = $trueColor;
        }

        $prevHandler = set_error_handler(function () {
            return true;
        });
        $result = imagewebp($image, $destinationPath, $quality);
        restore_error_handler();

        imagedestroy($image);

        return $result;
    }

    /**
     * Return the configured PHP memory limit in bytes, or 0 for unlimited.
     *
     * @return int
     */
    protected static function getMemoryLimitBytes(): int
    {
        $memoryLimit = @ini_get('memory_limit');
        if (!$memoryLimit || $memoryLimit === '-1') {
            return 0;
        }

        $unit = strtolower(substr($memoryLimit, -1));
        $value = (int) $memoryLimit;

        switch ($unit) {
            case 'g':
                return $value * 1024 * 1024 * 1024;
            case 'm':
                return $value * 1024 * 1024;
            case 'k':
                return $value * 1024;
            default:
                return $value;
        }
    }

    /**
     * Return a WebP URL for a local image if the WebP version exists.
     *
     * @param string $srcUrl
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public static function resolveWebpUrl(string $srcUrl, $request)
    {
        $parts = parse_url($srcUrl);
        if ($parts === false || empty($parts['path'])) {
            return null;
        }

        $path = $parts['path'];
        if (strpos($path, '/') !== 0) {
            $path = '/' . $path;
        }

        $host = isset($parts['host']) ? $parts['host'] : null;
        if ($host && $host !== $request->getHost()) {
            return null;
        }

        $publicPath = public_path(ltrim($path, '/'));
        if (!is_file($publicPath)) {
            return null;
        }

        $webpPath = preg_replace('/\.(jpe?g|png|gif)$/i', '.webp', $publicPath);
        if (!is_file($webpPath)) {
            return null;
        }

        $webpUrl = preg_replace('/\.(jpe?g|png|gif)(\?.*)?$/i', '.webp$2', $srcUrl);
        return $webpUrl;
    }
}

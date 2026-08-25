<?php

declare(strict_types=1);

namespace App\Supports;

use GdImage;
use InvalidArgumentException;
use RuntimeException;

class ImageHelper
{
    /**
     * Resize (and optionally crop) an image, returning a GD image resource.
     *
     * The source type is determined from the file's real content — not its
     * name/extension — so a spoofed ".jpg" that is actually a PNG (or a
     * non-image upload) is rejected instead of causing a fatal error.
     *
     * @throws InvalidArgumentException When the file is missing or not a supported image.
     * @throws RuntimeException         When the image cannot be decoded.
     */
    public static function resize(string $file, int $w, int $h, bool $crop = false): GdImage
    {
        if ($file === '' || !is_file($file)) {
            throw new InvalidArgumentException('Image file does not exist.');
        }

        $info = @getimagesize($file);

        if ($info === false) {
            throw new InvalidArgumentException('File is not a valid image.');
        }

        [$width, $height] = $info;
        $type = $info[2]; // IMAGETYPE_* constant, derived from real content

        if ($width < 1 || $height < 1) {
            throw new InvalidArgumentException('Image has invalid dimensions.');
        }

        $ratio = $width / $height;

        if ($crop) {
            if ($width > $height) {
                $width = (int) ceil($width - ($width * abs($ratio - $w / $h)));
            } else {
                $height = (int) ceil($height - ($height * abs($ratio - $w / $h)));
            }
            $newWidth = $w;
            $newHeight = $h;
        } elseif ($w / $h > $ratio) {
            $newWidth = (int) round($h * $ratio);
            $newHeight = $h;
        } else {
            $newWidth = $w;
            $newHeight = (int) round($w / $ratio);
        }

        $newWidth = max(1, $newWidth);
        $newHeight = max(1, $newHeight);

        $src = match ($type) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($file),
            IMAGETYPE_PNG => @imagecreatefrompng($file),
            IMAGETYPE_GIF => @imagecreatefromgif($file),
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($file) : false,
            default => throw new InvalidArgumentException(
                'Unsupported image type: ' . image_type_to_mime_type($type)
            ),
        };

        if (!$src instanceof GdImage) {
            throw new RuntimeException('Failed to decode image.');
        }

        $dst = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for formats that support an alpha channel.
        if (in_array($type, [IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP], true)) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
            imagefilledrectangle($dst, 0, 0, $newWidth, $newHeight, $transparent);
        }

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        imagedestroy($src);

        return $dst;
    }
}

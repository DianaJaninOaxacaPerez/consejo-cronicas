<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

class ImageUploadService
{
    /**
     * Redimensiona y comprime una imagen subida, y la guarda en el disco 'public'.
     *
     * @param UploadedFile $file      Archivo subido (del request)
     * @param string       $folder    Carpeta destino dentro de storage/app/public (ej. 'galeria', 'cronistas')
     * @param int          $maxWidth  Ancho máximo en píxeles (se mantiene la proporción)
     * @param int          $quality   Calidad JPEG (0-100)
     * @return string      Ruta relativa guardada (ej. 'galeria/abc123.jpg')
     */
    public static function store(UploadedFile $file, string $folder, int $maxWidth = 1920, int $quality = 80): string
    {
        $manager = ImageManager::usingDriver(Driver::class);

        $image = $manager->decodeSplFileInfo($file);

        // Solo reduce si la imagen es más ancha que el máximo permitido (no la agranda)
        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        // Genera un nombre único, siempre guardamos como .jpg para consistencia y buen ratio de compresión
        $filename = $folder . '/' . Str::random(20) . '.jpg';

        $encoded = $image->encodeUsingFormat(Format::JPEG, quality: $quality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }

    /**
     * Elimina una imagen del disco 'public' si existe.
     */
    public static function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
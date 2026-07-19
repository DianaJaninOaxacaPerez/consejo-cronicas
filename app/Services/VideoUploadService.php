<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoUploadService
{
    /**
     * Guarda un archivo de video en el disco 'public', dentro de la carpeta indicada.
     *
     * @param UploadedFile $file    Archivo subido (del request)
     * @param string       $folder  Carpeta destino dentro de storage/app/public (ej. 'videos')
     * @return string      Ruta relativa guardada (ej. 'videos/abc123.mp4')
     */
    public static function store(UploadedFile $file, string $folder): string
    {
        $filename = $folder . '/' . Str::random(20) . '.' . $file->getClientOriginalExtension();

        Storage::disk('public')->putFileAs(
            $folder,
            $file,
            basename($filename)
        );

        return $filename;
    }

    /**
     * Elimina un video del disco 'public' si existe.
     */
    public static function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
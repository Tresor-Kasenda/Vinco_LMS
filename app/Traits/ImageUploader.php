<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageUploader
{
    public static function uploadFiles(Request $request): string
    {
        return $request->file('images')
            ->storePublicly('/', ['disk' => 'public']);
    }

    public function uploadPDFFile(Request $request): bool|string
    {
        return $request->file('content')
            ->storePublicly('/resource', ['disk' => 'public']);
    }

    public function removePDFFiles($model): void
    {
        Storage::disk('public')
            ->delete($model->path);
    }


    public function removePathOfImages($model): void
    {
        Storage::disk('public')
            ->delete($model->images);
    }
}

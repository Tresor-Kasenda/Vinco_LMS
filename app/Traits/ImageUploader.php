<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageUploader
{
    public static function uploadFiles(Request $request): string
    {
        return $request->file('images')
            ->storePublicly('/', ['disk' => 'public']);
    }

    public static function uploadIcons(Request $request): bool|string
    {
        return $request->file('app_icons')
            ->storePublicly('/icons', ['disk' => 'public']);
    }

    public static function uploadLogo(Request $request): bool|string
    {
        return $request->file('app_images')
            ->storePublicly('/logos', ['disk' => 'public']);
    }

    public static function uploadVideos(Request $request): bool|string
    {
        return $request->file('video_lesson')
            ->storePublicly('/tutorials', ['disk' => 'public']);
    }
    
    public static function uploadPDF(Request $request): bool|string
    {
        return $request->file('pdf_format')
            ->storePublicly('/pdf', ['disk' => 'public']);
    }

    public function uploadPDFFile(Request $request): bool|string
    {
        return $request->file('files')
            ->storePublicly('/resource', ['disk' => 'public']);
    }

    public function removePDFFiles($model): void
    {
        Storage::disk('public')
            ->delete($model->path);
    }

    public function removeIcons($model): void
    {
        Storage::disk('public')
            ->delete($model->path);
    }

    public function removeLogos($model): void
    {
        Storage::disk('public')
            ->delete($model->path);
    }

    public function removePathOfImages($model): void
    {
        Storage::disk('public')
            ->delete($model->images);
    }

    public function removePathOfImage($model): void
    {
        Storage::disk('public')
            ->delete($model->image);
    }

    private function removePathOfInstitution(Model $model): void
    {
        Storage::disk('public')
            ->delete($model->institution_images);
    }

    private function removePathOfVideos(Model $model): void
    {
        Storage::disk('public')
            ->delete($model->video_name);
    }
}

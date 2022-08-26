<?php

declare(strict_types=1);

namespace App\Services\EnableX;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

final class EnableXService
{
    public static function createConnexion(): PendingRequest|RedirectResponse
    {
        try {
            $access = Http::withHeaders([
                'Content-Type: application/json',
            ])
                ->withBasicAuth(
                    config('enable.app_id'),
                    config('enable.app_key')
                )->timeout(1000);
            return $access;
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }
}

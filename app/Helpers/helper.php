<?php

declare(strict_types=1);

namespace App\Helpers;

if (! function_exists('verifyIfLessonIsVideo')) {
    function verifyIfLessonIsVideo(string $url)
    {
        if (preg_match('#^https?://#i', $url) === 1) {
            return $url;
        }
    }
}


if (! function_exists('priceFormat')) {
    function priceFormat($price): string
    {
        return number_format($price, 2, '.', ' ');
    }
}

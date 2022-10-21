<?php

declare(strict_types=1);

namespace App\Helpers;

if (! function_exists('verifyEncodeLink')) {
    function verifyEncodeLink(string $url): ?string
    {
        if (preg_match('#^https?://#i', $url) === 1) {
            return $url;
        }

        return  null;
    }
}

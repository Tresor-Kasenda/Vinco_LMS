<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ToastMessageService;

class BaseControllerFrontendController extends Controller
{
    public function __construct(
        public ToastMessageService $factory
    ) {
    }
}

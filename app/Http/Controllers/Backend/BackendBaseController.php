<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ToastMessageService;

class BackendBaseController extends Controller
{
    public function __construct(
        public ToastMessageService $factory
    ) {
    }
}

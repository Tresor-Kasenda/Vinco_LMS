<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExerciceBackendApiController extends Controller
{
    public function render(Request $request)
    {
        dd($request->all());
    }
}

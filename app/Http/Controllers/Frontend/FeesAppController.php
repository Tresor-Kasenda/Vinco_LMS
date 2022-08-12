<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

final class FeesAppController extends Controller
{
    public function index(): Renderable
    {
        return view('frontend.domain.fees.index');
    }
}

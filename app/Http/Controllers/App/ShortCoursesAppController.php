<?php
declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class ShortCoursesAppController extends Controller
{
    public function index(): Renderable
    {
        return view('apps.domain.short-courses.index');
    }
}

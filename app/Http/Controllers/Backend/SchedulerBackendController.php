<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\SchedulerRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;

class SchedulerBackendController extends Controller
{
    public function __construct(public SchedulerRepositoryInterface $repository)
    {
    }

    public function index(): Renderable
    {
        return view('');
    }
}

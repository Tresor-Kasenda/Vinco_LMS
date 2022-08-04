<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\EnableX;

use App\Contracts\EnableX\EnableXRepositoryInterface;
use App\Http\Controllers\Controller;

class EnableBackendController extends Controller
{
    public function __construct(protected readonly EnableXRepositoryInterface $repository)
    {
    }

    public function index()
    {
        return view('backend.domain.aperi.index');
    }
}

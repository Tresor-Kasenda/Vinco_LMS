<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ProfileRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;

final class ProfileBackendController extends Controller
{
    public function __construct(
        protected readonly ProfileRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        return view('backend.domain.profile.index');
    }

    public function store(ProfileRequest $attributes)
    {
    }

    public function update(string $key)
    {
    }
}

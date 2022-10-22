<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Contracts\InstitutionRepositoryInterface;
use App\Contracts\StudentRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

final class HomeFrontendController extends Controller
{
    public function __construct(
        protected readonly InstitutionRepositoryInterface $repository,
        protected readonly StudentRepositoryInterface $studentRepository,
    ) {
    }

    public function __invoke(): Renderable
    {
        return view('frontend.index');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Professor\ProfessorStatusRequest;
use App\Repositories\Backend\Professor\ProfessorStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusProfessorBackendController extends Controller
{
    public function __invoke(
        ProfessorStatusRequest $request,
        ProfessorStatusRepository $repository
    ): JsonResponse {
        $professor = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'professor' => $professor,
        ]);
    }
}

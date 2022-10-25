<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Student\StudentStatusRequest;
use App\Repositories\Backend\Student\StudentStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusStudentBackendController extends Controller
{
    public function __invoke(
        StudentStatusRequest $request,
        StudentStatusRepository $repository
    ): JsonResponse {
        $student = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'student' => $student,
        ]);
    }
}

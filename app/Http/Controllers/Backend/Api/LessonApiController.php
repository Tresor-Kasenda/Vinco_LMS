<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonApiRequest;
use App\Repositories\Api\LessonApiRepository;
use Illuminate\Http\JsonResponse;

class LessonApiController extends Controller
{
    public function getLesson(
        LessonApiRequest    $apiRequest,
        LessonApiRepository $repository
    ): JsonResponse {
        $lessons = $repository->getLessons($apiRequest);

        return response()->json([
            'lessons' => $lessons,
            'status' => 'success',
        ], 200);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterApiRequest;
use App\Repositories\Api\ChapterApiRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ChapterApiController extends Controller
{
    public function getChapters(
        ChapterApiRequest $request,
        ChapterApiRepository $repository
    ): JsonResponse {
        $chapters = $repository->getChapters($request);

        return response()->json([
            'chapters' => $chapters,
            'status' => 'success',
        ], Response::HTTP_OK);
    }
}

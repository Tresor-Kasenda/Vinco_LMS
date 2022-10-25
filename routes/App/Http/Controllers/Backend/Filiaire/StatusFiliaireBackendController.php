<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Filiaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Filiaire\FiliaireStatusRequest;
use App\Repositories\Backend\Filiaire\FiliaireStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusFiliaireBackendController extends Controller
{
    public function __invoke(
        FiliaireStatusRequest $request,
        FiliaireStatusRepository $repository
    ): JsonResponse {
        $filiaire = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'filiaire' => $filiaire,
        ]);
    }
}

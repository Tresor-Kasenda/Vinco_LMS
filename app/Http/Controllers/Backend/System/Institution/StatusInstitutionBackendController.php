<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\System\Institution;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionStatusRequest;
use App\Repositories\Institution\StatusInstitution\InstitutionStatusRepository;
use Illuminate\Http\JsonResponse;

class StatusInstitutionBackendController extends Controller
{
    public function __invoke(
        InstitutionStatusRequest $request,
        InstitutionStatusRepository $repository
    ): JsonResponse {
        $institution = $repository->handle($request);

        return response()->json([
            'success' => 'Action executez avec success',
            'institution' => $institution,
        ]);
    }
}

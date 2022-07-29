<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Api;

use App\Http\Requests\InstitutionApiRequest;
use App\Repositories\Api\InstitutionApiRepository;
use Symfony\Component\HttpFoundation\Response;

class InstitutionApiController
{
    public function getInstitution(InstitutionApiRequest $apiRequest, InstitutionApiRepository $repository)
    {
        $campus = $repository->getInstitution($apiRequest);

        return response()->json([
            'campus' => $campus,
            'status' => 'success'
        ], Response::HTTP_OK);
    }
}

<?php

namespace App\Repositories\Institution;

use App\Contracts\Institution\StoreInstitutionRepositoryInterface;
use App\Http\Requests\Frontend\Institution\StoreInstitutionRequest;
use App\Models\Institution;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreInstitutionRepository implements StoreInstitutionRepositoryInterface
{
    use ImageUploader;

    public function store(StoreInstitutionRequest $institution): Model|Institution|Builder
    {
        return Institution::query()
            ->create([
                'institution_name' => $institution->input('institution_name'),
                'institution_country' => $institution->input('institution_country'),
                'institution_town' => $institution->input('institution_town'),
                'institution_images' => self::uploadFiles($institution),
                'institution_email' => $institution->input('institution_email'),
                'institution_phones' => $institution->input('institution_phones'),
                'institution_website' => $institution->input('institution_website'),
                'institution_address' => $institution->input('institution_address'),
            ]);
    }
}

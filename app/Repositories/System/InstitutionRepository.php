<?php

declare(strict_types=1);

namespace App\Repositories\System;

use App\Contracts\InstitutionRepositoryInterface;
use App\Events\InstitutionEvent;
use App\Models\Institution;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class InstitutionRepository implements InstitutionRepositoryInterface
{
    use ImageUploader;

    public function getInstitutions(): array|Collection|\Illuminate\Support\Collection
    {
        return Institution::query()
            ->select([
                'id',
                'institution_images',
                'institution_name',
                'institution_town',
                'institution_address',
            ])
            ->with('user:institution_id,name,email,avatar')
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Institution|Builder|RedirectResponse
    {
        $institution = Institution::query()
            ->create([
                'institution_name' => $attributes->input('institution_name'),
                'institution_address' => $attributes->input('institution_address'),
                'institution_country' => $attributes->input('institution_country'),
                'institution_phones' => $attributes->input('institution_phones'),
                'institution_town' => $attributes->input('institution_town'),
                'institution_images' => self::uploadFiles($attributes),
                'institution_website' => $attributes->input('institution_website'),
                'institution_email' => $attributes->input('institution_email'),
            ]);
        InstitutionEvent::dispatch($institution);

        return $institution;
    }

    public function updated(string $key, $attributes): Model|Institution|Builder
    {
        $institution = $this->showInstitution(key: $key);
        $institution->update([
            'institution_name' => $attributes->input('institution_name'),
            'institution_address' => $attributes->input('institution_address'),
            'institution_country' => $attributes->input('institution_country'),
            'institution_phones' => $attributes->input('institution_phones'),
            'institution_town' => $attributes->input('institution_town'),
            'institution_website' => $attributes->input('institution_website'),
            'institution_email' => $attributes->input('institution_email'),
        ]);

        return $institution;
    }

    public function showInstitution(string $key): Model|Institution|Builder
    {
        $institution = Institution::query()
            ->select([
                'id',
                'institution_name',
                'institution_country',
                'institution_town',
                'institution_address',
                'institution_phones',
                'institution_website',
                'institution_email',
                'institution_images',
                'institution_description',
                'created_at',
                'updated_at',
            ])
            ->whereId($key)
            ->firstOrFail();

        return $institution->load(['campuses', 'events', 'user']);
    }

    public function deleted(string $key): Model|Institution|Builder
    {
        $institution = $this->showInstitution(key: $key);
        $institution->delete();

        return $institution;
    }
}

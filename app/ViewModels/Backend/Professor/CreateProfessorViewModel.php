<?php

namespace App\ViewModels\Backend\Professor;

use App\Http\Controllers\Backend\ProfessorBackendController;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class CreateProfessorViewModel extends ViewModel
{
    public string $indexUrl;

    public string $storeUrl;

    public function __construct()
    {
        $this->indexUrl = action([ProfessorBackendController::class, 'index']);
        $this->storeUrl = action([ProfessorBackendController::class, 'store']);
    }

    public function institutions(): array|Collection
    {
        return Institution::select(['id', 'institution_name'])->get();
    }
}

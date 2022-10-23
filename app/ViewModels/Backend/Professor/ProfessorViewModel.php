<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Professor;

use App\Http\Controllers\Backend\ProfessorBackendController;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class ProfessorViewModel extends ViewModel
{
    public string $createUrl;

    public function __construct()
    {
        $this->createUrl = action([ProfessorBackendController::class, 'create']);
    }

    public function professors(): Collection|array
    {
        return Professor::query()
            ->with('user')
            ->latest()
            ->get();
    }
}

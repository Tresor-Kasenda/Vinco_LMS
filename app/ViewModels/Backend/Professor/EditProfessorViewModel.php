<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Professor;

use App\Http\Controllers\Backend\ProfessorBackendController;
use App\Models\Institution;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\ViewModels\ViewModel;

class EditProfessorViewModel extends ViewModel
{
    public string $indexUrl;
    public string $updateUrl;

    public function __construct(
        public string|int $id
    ) {
        $this->indexUrl = action([ProfessorBackendController::class, 'index']);
        $this->updateUrl = action([ProfessorBackendController::class, 'update'], $this->id);
    }

    public function institution(): array|Collection
    {
        return Institution::select(['id', 'institution_name'])->get();
    }

    public function professor(): Model|Professor|Builder|null
    {
        return Professor::query()
            ->where('id', '=', $this->id)
            ->first();
    }
}

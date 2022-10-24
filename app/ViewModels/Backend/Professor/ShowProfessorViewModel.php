<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Professor;

use App\Http\Controllers\Backend\ProfessorBackendController;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use Spatie\ViewModels\ViewModel;

class ShowProfessorViewModel extends ViewModel
{
    public string $indexUrl;

    public string $editUrl;

    public string $deleteUrl;

    public function __construct(
        public string|int $id
    ) {
        $this->indexUrl = action([ProfessorBackendController::class, 'index']);
        $this->editUrl = action([ProfessorBackendController::class, 'edit'], $this->id);
        $this->deleteUrl = action([ProfessorBackendController::class, 'destroy'], $this->id);
    }

    public function user(): Model|_IH_User_QB|Builder|User|null
    {
        return User::query()
            ->where('id', '=', $this->professor()->user_id)
            ->first();
    }

    public function professor(): Model|Professor|Builder|null
    {
        return Professor::query()
            ->where('id', '=', $this->id)
            ->first();
    }
}

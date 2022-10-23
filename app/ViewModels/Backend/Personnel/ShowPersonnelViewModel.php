<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Personnel;

use App\Http\Controllers\Backend\PersonnelBackendController;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use Spatie\ViewModels\ViewModel;

class ShowPersonnelViewModel extends ViewModel
{
    public string $indexUrl;

    public string $editUrl;

    public string $deleteUrl;

    public function __construct(
        public string|int $id
    ) {
        $this->indexUrl = action([PersonnelBackendController::class, 'index']);
        $this->editUrl = action([PersonnelBackendController::class, 'edit'], $this->id);
        $this->deleteUrl = action([PersonnelBackendController::class, 'destroy'], $this->id);
    }

    public function user(): Model|_IH_User_QB|Builder|User|null
    {
        return User::query()
            ->where('id', '=', $this->personnel()->id)
            ->first();
    }

    public function personnel(): Model|Builder|Personnel|null
    {
        return Personnel::query()
            ->where('id', '=', $this->id)
            ->first();
    }
}

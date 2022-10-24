<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Guardian;

use App\Http\Controllers\Backend\ParentBackendController;
use App\Models\Guardian;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use Spatie\ViewModels\ViewModel;

class ViewParentViewModel extends ViewModel
{
    public string $indexUrl;

    public string $editUrl;

    public string $deleteUrl;

    public function __construct(
        public string|int $key
    ) {
        $this->indexUrl = action([ParentBackendController::class, 'index']);
        $this->editUrl = action([ParentBackendController::class, 'edit'], $this->key);
        $this->deleteUrl = action([ParentBackendController::class, 'destroy'], $this->key);
    }

    public function user(): Model|_IH_User_QB|Builder|User|null
    {
        return User::query()
            ->whereId($this->parent()->user_id)
            ->first();
    }

    public function parent(): Model|Builder|Guardian|null
    {
        return Guardian::query()
            ->whereId($this->key)
            ->first();
    }
}

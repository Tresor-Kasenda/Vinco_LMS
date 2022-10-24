<?php

namespace App\ViewModels\Backend\Campus;

use App\Http\Controllers\Backend\Campus\CampusBackendController;
use App\Models\Campus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Campus_QB;
use Spatie\ViewModels\ViewModel;

class ShowCampusViewModel extends ViewModel
{
    public string $indexUrl;
    public string $editUrl;
    public string $deleteUrl;

    public function __construct(public string|int $id)
    {
        $this->indexUrl = action([CampusBackendController::class, 'index']);
        $this->editUrl = action([CampusBackendController::class, 'edit'], $this->id);
        $this->deleteUrl = action([CampusBackendController::class, 'destroy'], $this->id);
    }

    public function campus(): Campus|Model|Builder|_IH_Campus_QB|null
    {
        $campus = Campus::query()
            ->where('id', '=', $this->id)
            ->first();

        return $campus->load(['user', 'institution', 'departments']);
    }
}

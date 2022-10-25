<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Section;

use App\Http\Controllers\Backend\FiliaireBackendController;
use App\Models\Subsidiary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Subsidiary_QB;
use Spatie\ViewModels\ViewModel;

class ViewSectionViewModel extends ViewModel
{
    public string $indexUrl;

    public string $editUrl;

    public string $deleteUrl;

    public function __construct(public string|int $id)
    {
        $this->indexUrl = action([FiliaireBackendController::class, 'index']);
        $this->editUrl = action([FiliaireBackendController::class, 'edit'], $this->id);
        $this->deleteUrl = action([FiliaireBackendController::class, 'destroy'], $this->id);
    }

    public function filiaire(): Model|Builder|Subsidiary|_IH_Subsidiary_QB|null
    {
        $filiaire = Subsidiary::query()
            ->where('id', '=', $this->id)
            ->firstOrCreate();

        return $filiaire->load(['department', 'user', 'department.campus:id,name']);
    }
}

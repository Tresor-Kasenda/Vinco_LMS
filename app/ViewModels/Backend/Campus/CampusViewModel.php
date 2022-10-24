<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Campus;

use App\Http\Controllers\Backend\Campus\CampusBackendController;
use App\Models\Campus;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Campus_C;
use Spatie\ViewModels\ViewModel;

class CampusViewModel extends ViewModel
{
    public string $indexUrl;

    public function __construct()
    {
        $this->indexUrl = action([CampusBackendController::class, 'create']);
    }

    public function campuses(): array|Collection|_IH_Campus_C|\Illuminate\Support\Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Campus::query()
                ->select([
                    'id',
                    'name',
                    'images',
                    'institution_id',
                    'user_id',
                ])
                ->with(['institution:id,institution_name', 'user:id,name,email'])
                ->get();
        }

        return Campus::query()
            ->select([
                'id',
                'name',
                'images',
                'institution_id',
                'user_id',
            ])
            ->where('institution_id', '=', auth()->user()->institution_id)
            ->with(['institution:id,institution_name', 'user:id,name,email'])
            ->get();
    }
}

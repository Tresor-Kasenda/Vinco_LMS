<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Guardian;

use App\Http\Controllers\Backend\ParentBackendController;
use App\Models\Guardian;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class ParentViewModel extends ViewModel
{
    public string $createUrl;

    public function __construct()
    {
        $this->createUrl = action([ParentBackendController::class, 'create']);
    }

    public function parents(): array|Collection
    {
        return Guardian::query()
            ->latest()
            ->get();
    }
}

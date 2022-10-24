<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Student;

use App\Http\Controllers\Backend\Student\StudentBackendController;
use App\Models\Guardian;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Guardian_C;
use Spatie\ViewModels\ViewModel;

class CreateStudentViewModel extends ViewModel
{
    public string $indexUrl;
    public string $storeUrl;


    public function __construct()
    {
        $this->indexUrl = action([StudentBackendController::class, 'index']);
        $this->storeUrl = action([StudentBackendController::class, 'store']);
    }

    public function institutions()
    {
    }

    public function guardians(): array|Collection|_IH_Guardian_C
    {
        return Guardian::query()
            ->latest()
            ->get([
                'id',
                'name_guardian',
            ]);
    }
}

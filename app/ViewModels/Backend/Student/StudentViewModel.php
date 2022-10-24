<?php

declare(strict_types=1);

namespace App\ViewModels\Backend\Student;

use App\Http\Controllers\Backend\Student\StudentBackendController;
use App\Models\Student;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class StudentViewModel extends ViewModel
{
    public string $indexUrl;

    public function __construct()
    {
        $this->indexUrl = action([StudentBackendController::class, 'create']);
    }

    public function students(): array|\Illuminate\Database\Eloquent\Collection|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Student::query()
                ->select([
                    'id',
                    'name',
                    'firstname',
                    'lastname',
                    'matriculate',
                    'department_id',
                    'subsidiary_id',
                    'user_id',
                    'email',
                    'images',
                ])
                ->with(['subsidiary:id,name', 'user'])
                ->whereHas('department', function ($builder) {
                    $builder->with([
                        'campus:id,name,institution_id' => [
                            'institution:id,institution_name',
                        ],
                    ]);
                })
                ->orderByDesc('created_at')
                ->get();
        } else {
            return Student::query()
                ->select([
                    'id',
                    'name',
                    'firstname',
                    'lastname',
                    'matriculate',
                    'department_id',
                    'subsidiary_id',
                    'email',
                    'images',
                ])
                ->with('subsidiary:id,name')
                ->whereHas('department', function ($builder) {
                    $builder->whereHas('campus', function ($builder) {
                        $builder->where('institution_id', auth()->user()->institution->id);
                    });
                })
                ->orderByDesc('created_at')
                ->get();
        }
    }
}

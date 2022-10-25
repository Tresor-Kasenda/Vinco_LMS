<?php

namespace App\ViewModels\Backend\Student;

use App\Http\Controllers\Backend\Student\StudentBackendController;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Student_QB;
use LaravelIdea\Helper\App\Models\_IH_User_QB;
use Spatie\ViewModels\ViewModel;

class ShowStudentViewModel extends ViewModel
{
    public string $indexUrl;

    public string $editUrl;

    public string $deleteUrl;

    public function __construct(public string|int $id)
    {
        $this->indexUrl = action([StudentBackendController::class, 'index']);
        $this->editUrl = action([StudentBackendController::class, 'edit'], $this->id);
        $this->deleteUrl = action([StudentBackendController::class, 'destroy'], $this->id);
    }

    public function user(): Model|_IH_User_QB|Builder|User|null
    {
        return User::query()
            ->where('id', '=', $this->student()->user_id)
            ->first();
    }

    public function student(): Student|Model|Builder|_IH_Student_QB|null
    {
        $student = Student::query()
            ->where('id', '=', $this->id)
            ->first();

        return  $student->load([
            'department:id,name',
            'subsidiary:id,name',
        ]);
    }
}

<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\CampusRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\PersonnelRepositoryInterface;
use App\Interfaces\ProfessorRepositoryInterface;
use App\Models\Campus;
use App\Models\Personnel;
use App\Models\Professor;
use App\Models\User;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    use ImageUploader;

    public function getDepartments()
    {
        // TODO: Implement getDepartments() method.
    }

    public function showDepartment(string $key)
    {
        // TODO: Implement showDepartment() method.
    }

    public function stored($attributes, $factory)
    {
        // TODO: Implement stored() method.
    }

    public function updated(string $key, $attributes, $factory)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key, $factory)
    {
        // TODO: Implement deleted() method.
    }
}

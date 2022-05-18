<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\UsersRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Support\Facades\View;

class UsersBackendController extends Controller
{
    public function __construct(public UsersRepositoryInterface $repository, SweetAlertFactory $factory){}

    public function index(): \Illuminate\Contracts\View\View
    {
        return View::make('backend.domain.users.index', [
           'administrators' => $this->repository->getUsers()
        ]);
    }
}

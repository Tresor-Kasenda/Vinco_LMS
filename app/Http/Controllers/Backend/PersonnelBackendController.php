<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonnelRequest;
use App\Interfaces\PersonnelRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;

final class PersonnelBackendController extends Controller
{
    public function __construct(public PersonnelRepositoryInterface $repository){}

    public function index(): Renderable
    {
        return view('backend.domain.personnels.index', [
            'personnels' => $this->repository->getPersonnelContent()
        ]);
    }

    public function show(string $key)
    {

    }

    public function create(): Renderable
    {
        return view('backend.domain.personnels.create');
    }

    public function store(PersonnelRequest $attributes)
    {
        dd($attributes->all());
    }
}

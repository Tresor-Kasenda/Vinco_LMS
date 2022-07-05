<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Contracts\InstitutionRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class ShowInstitution extends Component
{
    private InstitutionRepositoryInterface $repository;

    public function mount(InstitutionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function render(): Renderable
    {
        $institutions = $this->repository->getInstitutions();

        return view('backend.livewire.show-institution', compact('institutions'))
            ->extends('backend.layout.base')
            ->section('content');
    }
}

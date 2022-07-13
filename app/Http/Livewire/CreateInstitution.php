<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Repositories\System\InstitutionRepository;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateInstitution extends Component
{
    use WithFileUploads;

    public $institution_name;

    public $institution_country;

    public $institution_town;

    public $manager;

    public $institution_phones;

    public $institution_website;

    public $institution_address;

    public $images;

    private SweetAlertFactory $factory;

    public function storeInstitution(): RedirectResponse
    {
        $institution = $this->validate();

        $repository = new InstitutionRepository();

        $repository->stored($institution);

        $this->factory->addSuccess('A new institution has been successfully added');

        return redirect()->route('admins.institution.index');
    }

    public function render(): Factory|View|Application
    {
        return view('backend.livewire.create-institution')
            ->extends('backend.layout.base')
            ->section('content');
    }
}

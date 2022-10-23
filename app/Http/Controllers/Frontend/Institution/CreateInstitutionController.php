<?php

namespace App\Http\Controllers\Frontend\Institution;

use App\Contracts\Institution\StoreInstitutionRepositoryInterface;
use App\Http\Controllers\BaseControllerFrontendController;
use App\Http\Requests\Frontend\Institution\StoreInstitutionRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class CreateInstitutionController extends BaseControllerFrontendController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly StoreInstitutionRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function __invoke(): Renderable
    {
        return view('frontend.domain.institution.create');
    }

    public function storeInstitution(StoreInstitutionRequest $institution): RedirectResponse
    {
        $this->repository->store(institution: $institution);

        $this->factory->success(
            'success',
            "L'institution a ete enregistrer avec success"
        );

        return redirect()->back();
    }
}

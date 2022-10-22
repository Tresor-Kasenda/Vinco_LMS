<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend\Student;

use App\Contracts\Student\StoreStudentFrontendRepositoryInterface;
use App\Http\Controllers\BaseControllerFrontendController;
use App\Http\Requests\Frontend\Student\StoreStudentRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Support\Renderable;

class StudentFrontendController extends BaseControllerFrontendController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly StoreStudentFrontendRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function __invoke(): Renderable
    {
        return view('frontend.domain.student.create');
    }

    public function storeStudent(StoreStudentRequest $request)
    {
        $this->repository->store(request: $request);

        $this->factory->success(
            'success',
            "Votre compte a ete cree avec success; Veillez consulter vos mail pour plus d'information"
        );

        return redirect()->route('login');
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\LessonRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\Models\LessonType;
use App\Models\Student;
use App\Repositories\Contracts\CreateRoomRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class LessonBackendController extends Controller
{
    public function __construct(
        protected readonly LessonRepositoryInterface $repository,
        public CreateRoomRepositoryInterface $repositories
    ) {
    }

    public function index(): Renderable
    {
        $lessons = $this->repository->getLessons();

        return view('backend.domain.academic.lessons.index', compact('lessons'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.lessons.create');
    }

    public function store(LessonRequest $attributes): RedirectResponse
    {
        $type = LessonType::query()
            ->select([
                'id',
                'name',
            ])
            ->where('id', '=', $attributes->input('type'))
            ->firstOrFail();
        if($type->id == \App\Enums\LessonType::TYPE_APERI->value){
            $promotion = $attributes->promotion;
            if($promotion === null){
                $this->service->warning('Veuillez choisir une promotion');
                return back();
            }
            $student = Student::query()
                ->select([
                    'email',
                ])->where('promotion_id', '=', $promotion)
                ->get();
            $students = $student->load([
                'parent:id,name_guardian,email_guardian,phones',
                'department:id,name',
                'subsidiary:id,name',
                'user:id',
                'user.roles:id,name',
                'parent:id,name_guardian',
            ]);
            $guests = [];
            foreach ($students as $key => $stud){
                array_push($guests, $stud->email);
            }
            $aperi = array(
                'name'=>\Auth::user()->name,
                'email'=>\Auth::user()->email,
                'date'=>$attributes->date,
                'startTime'=>$attributes->startTime,
                'endTime'=>$attributes->endTime,
                'usersNumber'=>$students->count(),
                'guests'=>$guests
            );

            $this->repositories->createRoom(attributes: $attributes);

            dd($aperi);
        }
//        $this->repository->stored(attributes: $attributes);
//
//        return to_route('admins.academic.lessons.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $lesson = $this->repository->showLesson(key:  $key);

        return view('backend.domain.academic.lessons.show', compact('lesson'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $lesson = $this->repository->showLesson(key:  $key);

        return view('backend.domain.academic.lessons.edit')->with('lesson', $lesson);
    }

    public function update(string $key, LessonUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        return to_route('admins.academic.lessons.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return back();
    }
}

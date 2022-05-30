<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\TrashedChapterRepositoryInterface;
use App\Interfaces\TrashedLessonRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class TrashedLessonBackendController extends Controller
{
    public function __construct(
        public SweetAlertFactory $alertFactory,
        public TrashedLessonRepositoryInterface $repository
    ) {
    }

    public function index($course, $chapter): Renderable
    {
        [$lessons, $chapters, $courses] = $this->repository->getTrashes(course: $course, chapter: $chapter);

        return view('backend.domain.cours.lessons.trashed.index', [
            'lessons' => $lessons,
            'course' => $courses,
            'chapter' => $chapters,
        ]);
    }

    public function restore($course, $chapter, string $key): RedirectResponse
    {
        [$chapters, $courses] = $this->repository->restore(course: $course, chapter: $chapter, key: $key, alert: $this->alertFactory);

        return back();
    }

    public function destroy($course, $chapter, string $key): RedirectResponse
    {
        [$chapters, $courses] = $this->repository->deleted(course: $course, chapter: $chapter, key: $key, alert: $this->alertFactory);

        return back();
    }
}

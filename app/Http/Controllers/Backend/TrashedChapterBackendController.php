<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\TrashedChapterRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class TrashedChapterBackendController extends Controller
{
    public function __construct(
        public SweetAlertFactory $alertFactory,
        public TrashedChapterRepositoryInterface $repository
    ) {
    }

    public function index($course): Renderable
    {
        [$chapters, $courses] = $this->repository->getTrashes(course: $course);

        return view('backend.domain.cours.chapters.trashed.index', [
            'chapters' => $chapters,
            'course' => $courses,
        ]);
    }

    public function restore($course, string $key): RedirectResponse
    {
        $chapter = $this->repository->restore(course: $course, key: $key, alert: $this->alertFactory);

        return to_route('admins.course.show', ['course' => $chapter->key]);
    }

    public function destroy($course, string $key): RedirectResponse
    {
        $chapter = $this->repository->deleted(course: $course, key: $key, alert: $this->alertFactory);

        return to_route('admins.course.show', ['course' => $chapter->key]);
    }
}

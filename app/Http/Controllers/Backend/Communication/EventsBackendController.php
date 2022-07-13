<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Communication;

use App\Contracts\EventRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * @EventsBackendController
 */
class EventsBackendController extends Controller
{
    public function __construct(
        protected readonly EventRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
//        $calendar = $this->repository->events();

        $eloquentEvent = Event::all(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

        $calendar = \Calendar::addEvents($eloquentEvent);

        return view('backend.domain.communication.events.index', compact('calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return \view('backend.domain.communication.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventRequest  $request
     * @return RedirectResponse
     */
    public function store(EventRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request, factory: $this->factory);

        return redirect()->route('admins.communication.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return Application|Factory|View
     */
    public function edit(string $id): View|Factory|Application
    {
        $event = $this->repository->showEvent($id);

        return  \view('backend.domain.communication.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventRequest  $request
     * @param  string  $id
     * @return RedirectResponse
     */
    public function update(EventRequest $request, string $id): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request, factory: $this->factory);

        return redirect()->route('admins.communication.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->repository->deleted(key: $id, factory: $this->factory);

        return  back();
    }
}

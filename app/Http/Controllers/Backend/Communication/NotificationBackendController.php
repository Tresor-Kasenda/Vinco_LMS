<?php

namespace App\Http\Controllers\Backend\Communication;

use App\Contracts\NotificationRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

final class NotificationBackendController extends Controller
{
    public function __construct(
        protected readonly NotificationRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        $notifications = $this->repository->notifications();

        return view('backend.domain.communication.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return \view('backend.domain.communication.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request, factory: $this->factory);

        return redirect()->route('admins.communication.notification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Factory|Application
    {
        $notification = $this->repository->showNotification($id);

        return \view('backend.domain.communication.notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotificationRequest $request, string $id): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request, factory: $this->factory);

        return redirect()->route('admins.communication.notification.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->repository->deleted($id, $this->factory);

        return back();
    }
}

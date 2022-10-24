<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Communication;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class CalendarBackendController extends Controller
{
    public function __construct(
        protected readonly AcademicYearRepositoryInterface $repository,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        $eloquentEvent = Calendar::all(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

        $calendar = \Calendar::addEvents($eloquentEvent);

        return view('backend.domain.communication.calendar.index', compact('calendar', 'eloquentEvent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View|Factory|Application
    {
        return \view('backend.domain.communication.calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        Calendar::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'institution_id' => \Auth::user()->institution->id,
        ]);

        return redirect()->route('admins.communication.calendar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

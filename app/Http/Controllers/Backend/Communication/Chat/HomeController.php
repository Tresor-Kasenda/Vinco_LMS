<?php

namespace App\Http\Controllers\Backend\Communication\Chat;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get group where user is present
        $groups = auth()->user()->group_member;

        return view('backend.domain.communication.chat.home', compact('groups'));
    }
}

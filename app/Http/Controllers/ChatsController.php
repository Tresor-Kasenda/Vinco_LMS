<?php

namespace App\Http\Controllers;

use App\Events\RoomMessageSent;
use App\Models\Room;
use App\Models\RoomMessage;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->roomId;

        return view('frontend.chat', ['id'=>$id]);
    }
}

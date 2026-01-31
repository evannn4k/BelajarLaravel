<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::where("status", true)->get();
        
        return view("user.index", [
            "events" => $events
        ]);
    }
}

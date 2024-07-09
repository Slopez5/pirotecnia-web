<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        return view('panel.dashboard', compact('events'));
    }
}

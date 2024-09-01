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
        $events = $events->map(function ($event) {
            // add packages to the event from first package of packages
            if ($event->packages->isEmpty()) {
                return $event;
            } else {
                $package = $event->packages->first();
                unset($event->package);
                $event->package = $package;
                return $event;
            }
        });
        $itemActive = 1;
        return view('panel.dashboard', compact('events', 'itemActive'));
    }
}

<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        $evdntsInWeek = Event::whereBetween('event_date', [Carbon::now(), Carbon::now()->addWeek()])->get()->count();
        $employees = Employee::all()->count();
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
        })->sortBy('event_date', SORT_REGULAR, true);
        $itemActive = 1;

        return view('panel.dashboard', compact('events', 'itemActive', 'evdntsInWeek', 'employees'));
    }
}

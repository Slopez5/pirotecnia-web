<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        })->whereBetween('event_date', [Carbon::now(), Carbon::now()->addWeek()])->sortBy('event_date', SORT_REGULAR, false);
        $itemActive = 1;
        return view('panel.dashboard', compact('events', 'itemActive', 'evdntsInWeek', 'employees'));
    }

    public function test()
    {
        // Convert date to UTC
        $date = '2024-10-15 21:46:00';
        // now date in UTC format 2024-10-19 20:11:00
        $now = Carbon::now('America/Mexico_City');
        $days = Carbon::parse($now)->diffInDays($date);
        return $days;
    }
    
}
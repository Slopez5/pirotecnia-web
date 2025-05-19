<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    //

    public function index()
    {
        $parentItemActive = 8;
        $itemActive = 4;
        $eventTypes = EventType::all();

        return view('panel.settings.event_types.index', compact('itemActive', 'parentItemActive', 'eventTypes'));
    }

    public function create()
    {
        return view('panel.settings.event_types.create');
    }

    public function store(Request $request)
    {
        $eventType = new EventType;
        $eventType->name = $request->name;
        $eventType->description = $request->description;
        $eventType->save();

        return redirect()->route('settings.event_types.index');
    }

    public function show($id)
    {
        return view('panel.settings.event_types.show');
    }

    public function edit($id)
    {
        return view('panel.settings.event_types.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('settings.event_types.index');
    }

    public function destroy($id)
    {
        $eventType = EventType::find($id);
        $eventType->delete();

        return redirect()->route('settings.event_types.index');
    }
}

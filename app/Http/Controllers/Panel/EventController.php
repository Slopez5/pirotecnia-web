<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    public function index()
    {
        $events = Event::all();
        return view('panel.events.index', compact('events'));
    }

    public function create()
    {
        return view('panel.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->image = $request->image;
        $event->save();

        return redirect()->route('events.index');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        return view('panel.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $event = Event::find($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->image = $request->image;
        $event->save();

        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return redirect()->route('events.index');
    }

    public function show($id)
    {
        $event = Event::find($id);
        return view('panel.events.show', compact('event'));
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Core\Data\Entities\Event;
use App\Core\UseCases\Events\CreateEvent;
use App\Core\UseCases\Events\GetAllEvents;
use App\Core\UseCases\Events\GetEvent;
use App\Core\UseCases\Events\GetEventsByEmployee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Events\StoreEventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    public function index(Request $request)
    {
        $events = app(GetAllEvents::class)->execute($request->get('page', 1));

        return response()->success($events, 200);
    }

    public function getEventsByEmployee(Request $request)
    {
        $id = $request->header('userid');
        $events = app(GetEventsByEmployee::class)->execute($id, $request->get('page', 1));

        return response()->success($events, 200);
    }

    public function show($id)
    {
        $event = app(GetEvent::class)->execute($id);

        return response()->success($event, 200);
    }

    public function store(StoreEventRequest $request)
    {
        $event = app(CreateEvent::class)->execute(Event::fromArray($request->all()));

        return response()->success($event, 201);
    }

    public function update(Request $request, $id) {}

    public function destroy(Request $request, $id) {}
}

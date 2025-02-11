<?php

namespace App\Http\Controllers\API;

use App\Core\Data\Entities\Event;
use App\Core\UseCases\Events\CreateEvent;
use App\Core\UseCases\Events\GetAllEvents;
use App\Core\UseCases\Events\GetEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class EventController extends Controller
{
    //

    public function index(Request $request)
    {
        $events = app(GetAllEvents::class)->execute($request->get('page', 1));
        return response()->json($events, 200);
    }

    public function show($id) {
        $event = app(GetEvent::class)->execute($id);
        return response()->json($event, 200);
    }

    public function store(Request $request) {



        $event = app(CreateEvent::class)->execute(Event::fromArray($request->all()));
        return response()->json($event, 201);
    }

    public function update(Request $request, $id) {}

    public function destroy(Request $request, $id) {}
}

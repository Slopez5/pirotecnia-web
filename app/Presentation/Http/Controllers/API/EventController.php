<?php 

namespace App\Presentation\Http\Controllers\API;

use App\Application\Employees\EventList\UseCases\CreateEventUseCase;
use App\Application\Employees\EventList\UseCases\EventDetailUseCase;
use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\CreateEventRequest;

class EventController extends Controller{

    public function eventDetails($id, EventDetailUseCase $eventDetailUseCase) {
        return $eventDetailUseCase($id);
    }

    public function createEvent(CreateEventRequest $createEventRequest, CreateEventUseCase $createEventUseCase) {
        $event = $createEventUseCase($createEventRequest->all());
        return $event;
    }
}
<?php 

namespace App\Infraestructure\Persistence\Eloquent\Repositories;

use App\Application\Employees\Dashboard\DTO\EventData;
use App\Domain\Employees\Dashboard\Contracts\DashboardRepository;
use App\Domain\Employees\Dashboard\Entities\Event;
use App\Infraestructure\Persistence\Eloquent\Mappers\EventMapper;
use App\Models\Event as ModelsEvent;

class EloquentDashboard implements DashboardRepository {
    public function dashboard(): array {
        $events = ModelsEvent::all();
        
        return array_map(fn($event) => EventMapper::fromModel($event),$events->all());
    }

    public function eventDetail(int $id): Event
    {
        $event = ModelsEvent::find($id);
        return EventMapper::fromModel($event);
    }
}
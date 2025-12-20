<?php 
namespace App\Application\Employees\EventList\UseCases;

use App\Application\Employees\Dashboard\DTO\EventData;
use App\Application\Employees\Dashboard\DTO\EventDetailsData;
use App\Domain\Employees\Events\Contracts\EventRepository;

class CreateEventUseCase {
    public function __construct(private EventRepository $eventRepositoryInterface) {}

    public function __invoke(array $params){
        $event = $this->eventRepositoryInterface->saveEvent( $params);
        return EventDetailsData::fromEntity($event);
    }
}
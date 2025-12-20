<?php 

namespace App\Application\Employees\EventList\UseCases;

use App\Application\Employees\Dashboard\DTO\EventDetailsData;
use App\Domain\Employees\Events\Contracts\EventRepository;

class EventDetailUseCase {
    public function __construct(private EventRepository $dashboardRepository) {}

    public function __invoke(int $id)
    {
        $event = $this->dashboardRepository->eventDetail($id);

        return EventDetailsData::fromEntity($event);
    }
}
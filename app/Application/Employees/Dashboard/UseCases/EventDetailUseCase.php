<?php 

namespace App\Application\Employees\Dashboard\UseCases;

use App\Application\Employees\Dashboard\DTO\EventDetailsData;
use App\Domain\Employees\Dashboard\Contracts\DashboardRepository;

class EventDetailUseCase {
    public function __construct(private DashboardRepository $dashboardRepository) {}

    public function __invoke(int $id)
    {
        $event = $this->dashboardRepository->eventDetail($id);

        return EventDetailsData::fromEntity($event);
    }
}
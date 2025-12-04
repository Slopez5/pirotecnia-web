<?php

namespace   App\Application\Employees\Dashboard\UseCases;

use App\Application\Employees\Dashboard\DTO\EventData;
use App\Domain\Employees\Dashboard\Contracts\DashboardRepository;
use App\Domain\Employees\Dashboard\Entities\Event;

class DashboardUseCase {
    public function __construct(private DashboardRepository $dashboardRepository) {}

    public function __invoke()
    {
        $events = $this->dashboardRepository->dashboard();

        return array_map(fn($event) => EventData::fromEntity($event), $events);
    }
}
<?php 

namespace App\Domain\Employees\Dashboard\Contracts;

use App\Domain\Employees\Dashboard\Entities\Event;

interface DashboardRepository {
    public function dashboard(): array;

    public function eventDetail(int $id): Event;
}
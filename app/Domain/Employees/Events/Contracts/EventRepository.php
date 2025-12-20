<?php 

namespace App\Domain\Employees\Events\Contracts;

use App\Domain\Employees\Dashboard\Entities\Event;

interface EventRepository {
    public function eventDetail(int $id): Event;

    public function saveEvent(array $params): Event;
}
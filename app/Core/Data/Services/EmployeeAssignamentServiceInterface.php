<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Event;
use Illuminate\Support\Collection;

interface EmployeeAssignamentServiceInterface
{
    public function assignToEvent(Event $event, Collection $employees): Event;

}
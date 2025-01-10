<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Event;

interface ProductAssignamentServiceInterface
{
    public function assignToEvent(Event $event): Event;

}
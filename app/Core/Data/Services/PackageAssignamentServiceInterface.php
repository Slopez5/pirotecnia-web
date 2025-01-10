<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Event;
use Illuminate\Support\Collection;

interface PackageAssignamentServiceInterface
{
    public function assignToEvent(Event $event, Collection $packages): Event;

    public function assignToEventByPackageId(Event $event, $packageId): Event;

}
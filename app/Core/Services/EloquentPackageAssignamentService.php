<?php 

namespace App\Core\Services;

use App\Core\Data\Entities\Event;
use App\Core\Data\Entities\Package;
use App\Core\Data\Services\PackageAssignamentServiceInterface;
use App\Models\Event as ModelsEvent;
use Illuminate\Support\Collection;

class EloquentPackageAssignamentService implements PackageAssignamentServiceInterface
{
    public function assignToEvent(Event $event, Collection $packages): Event
    {
        $eloquentEvent = ModelsEvent::find($event->id);
        $eloquentEvent->packages()->sync($packages);

        // get packages from packages in event selected;
        $packages = $eloquentEvent->packages->map(function ($eloquentPackage) {
            $package = new Package([
                'id' => $eloquentPackage->id,
                'experience_level_id' => $eloquentPackage->experience_level_id,
                'name' => $eloquentPackage->name,
                'description' => $eloquentPackage->description,
                'price' => $eloquentPackage->price,
                'duration' => $eloquentPackage->duration,
                'video_url' => $eloquentPackage->video_url,
            ]);
            return $package;
        });

        $event->packages = $packages;

        return $event;
    }

    public function assignToEventByPackageId(Event $event, $packageId): Event
    {

        return $event;
    }
}
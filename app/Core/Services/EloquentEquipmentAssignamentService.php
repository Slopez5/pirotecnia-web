<?php

namespace App\Core\Services;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EquipmentRepositoryInterface;
use App\Core\Data\Services\EquipmentAssignamentServiceInterface;
use App\Models\Event as ModelsEvent;

class EloquentEquipmentAssignamentService implements EquipmentAssignamentServiceInterface
{

    public function __construct(private EquipmentRepositoryInterface $equipmentRepository) {}

    public function assignToEvent(Event $event): Event
    {
        logger('assignEquipmentToEvent');
        $packageIds =$event->packages->pluck('id')->toArray();
        $equipments = $this->equipmentRepository->getByPackageIds($packageIds);
        $eloquentEvent = ModelsEvent::find($event->id);

        $syncData = $equipments->mapWithKeys(function ($equipment) {
            return [
                $equipment->id => [
                    'quantity' => $equipment->quantity,
                ],
            ];
        })->toArray();

        $eloquentEvent->equipments()->sync($syncData);
        $event->equipments = $equipments;

        return $event;
    }
}

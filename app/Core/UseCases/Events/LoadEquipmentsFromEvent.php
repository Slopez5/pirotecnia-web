<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Repositories\EquipmentRepositoryInterface;
use Illuminate\Support\Collection;

class LoadEquipmentsFromEvent
{
    public function __construct(private EquipmentRepositoryInterface $equipmentRepository) {}

    public function execute(int $eventId): Collection
    {
        return $this->equipmentRepository->findByEventId($eventId);
    }
}

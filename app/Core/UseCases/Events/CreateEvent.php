<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;
use App\Core\Data\Services\ReminderSchedulerService;
use App\Core\UseCases\Inventories\CheckLowInventoryByProducts;
use App\Core\UseCases\Reminders\SendReminderToAdmin;
use App\Core\UseCases\Reminders\SendReminderToEmployee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateEvent
{
    public function __construct(
        private StoreEvent $storeEvent,
        private AssignPackagesToEvent $assignPackagesToEvent,
        private AssignEquipmentsToEvent $assignEquipmentsToEvent,
        private AssignProductsToEvent $assignProductsToEvent,
        private AssignEmployeesToEvent $assignEmployeesToEvent,
        private SendReminderToEmployee $sendReminderToEmployee,
        private SendReminderToAdmin $sendReminderToAdmin,
        private CheckLowInventoryByProducts $checkLowInventoryByProducts
    ) {}

    public function execute(Event $event, bool $validateInventory = true): ?Event
    {
        try {
            return DB::transaction(function () use ($event, $validateInventory) {
                logger('Creating event');
                logger($event);
                $event = $this->storeEvent->execute($event)
                ->withPackages($this->assignPackagesToEvent->execute($event)->packages ?? new Collection())
                ->withProducts($this->assignProductsToEvent->execute($event)->products)
                ->withEquipments($this->assignEquipmentsToEvent->execute($event)->equipments)
                ->withEmployees($this->assignEmployeesToEvent->execute($event)->employees);
              
                
                if ($validateInventory) {
                    $lowInventory = $this->checkLowInventoryByProducts->execute($event->products);                
                    $event->lowInventoryProducts = $lowInventory;
                }
                throw new \Exception('Event could not be created (Simulated error)');

                return $event;
            });
        } catch (\Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }
}

<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;
use App\Core\Data\Services\ReminderSchedulerServiceInterface;

class CreateEvent
{
    public function __construct(
        private EventRepositoryInterface $eventRepository,
        private AssignPackagesToEvent $assignPackagesToEvent,
        private AssignEquipmentsToEvent $assignEquipmentsToEvent,
        private AssignProductsToEvent $assignProductsToEvent,
        private AssignEmployeesToEvent $assignEmployeesToEvent,
        private UpdateProductsOfInventory $updateProductsOfInventory,
        private ReminderSchedulerServiceInterface $reminderSchedulerService
    ) {}

    public function execute(Event $event): Event
    {
        // create event
        $event = $this->eventRepository->create($event);

        if (!$event) {
            logger('Event could not be created');
            throw new \Exception('Event could not be created');
        }

        // save packages of event
        $event = $this->assignPackagesToEvent->execute($event->id, $event->packages);

        // save products of event (from packages)
        $event = $this->assignProductsToEvent->execute($event->id, $event->products);

        // save equipment of event (from packages)
        $event = $this->assignEquipmentsToEvent->execute($event->id, $event->equipments);

        // save employees of event
        $event = $this->assignEmployeesToEvent->execute($event->id, $event->employees);

        // schedule reminder to send whatsapp message to admin (4 day before event)
        $this->reminderSchedulerService->scheduleReminderToAdmin($event, 4);

        // schedule reminder to send whatsapp message to employees (3 day before event)
        $this->reminderSchedulerService->scheduleReminderToEmployees($event, 3);

        return $event;
    }
}

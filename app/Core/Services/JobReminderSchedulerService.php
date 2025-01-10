<?php 

namespace App\Core\Services;

use App\Core\Data\Entities\Event;
use App\Core\Data\Services\ReminderSchedulerServiceInterface;

class JobReminderSchedulerService implements ReminderSchedulerServiceInterface {
    public function scheduleReminderToAdmin(Event $event, $daysBeforeEvent) {
        logger('scheduleReminderToAdmin');
    }

    public function scheduleReminderToEmployees(Event $event, $daysBeforeEvent) {
        logger('scheduleReminderToEmployees');
    }
}
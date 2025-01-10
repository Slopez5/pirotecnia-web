<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Event;

interface ReminderSchedulerServiceInterface
{
    public function scheduleReminderToAdmin(Event $event, $daysBeforeEvent);
    public function scheduleReminderToEmployees(Event $event, $daysBeforeEvent);
}
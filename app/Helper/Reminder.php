<?php

namespace App\Helper;

use App\Jobs\SendReminder;
use App\Models\Event;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class Reminder {
    public static function send(Event $event, $method, $days, $sendToOwner = false) {
        // Ejecuta el job para enviar el recordatorio

        if (Date::parse($event->event_date)->diffInDays() <= $days) {
            SendReminder::dispatch($method, $event, $sendToOwner);
        } else {
            SendReminder::dispatch($method, $event,$sendToOwner)->delay(Date::parse($event->event_date)->subDays($days));
        }
    }
}
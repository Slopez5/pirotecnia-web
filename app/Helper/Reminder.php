<?php

namespace App\Helper;

use App\Jobs\SendReminder;
use App\Models\Event;
use Carbon\Carbon;

class Reminder
{
    public static function send(Event $event, $method, $days, $sendToOwner = false)
    {
        // Ejecuta el job para enviar el recordatorio

        logger('Event date: ' . $event->event_date);
        logger('Now: ' . now());
        logger('Diff in days: ' . Carbon::parse($event->event_date)->diffInDays(now()));
        if (Carbon::parse($event->event_date)->diffInDays(now()) <= $days) {
            SendReminder::dispatch($method, $event, $sendToOwner);
        } else {
            SendReminder::dispatch($method, $event, $sendToOwner)->delay(Carbon::parse($event->event_date)->subDays($days));
        }
    }
}

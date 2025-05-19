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

        $now = Carbon::now('America/Mexico_City');
        $diffDays = Carbon::parse($now)->diffInDays($event->event_date);
        if (($diffDays <= $days) || $days == 0) {
            SendReminder::dispatch($method, $event, $sendToOwner);
        } else {
            SendReminder::dispatch($method, $event, $sendToOwner)->delay(Carbon::parse($event->event_date)->subDays($days));
        }
    }
}

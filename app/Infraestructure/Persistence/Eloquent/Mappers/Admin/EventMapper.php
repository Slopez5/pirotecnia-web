<?php

namespace App\Infraestructure\Persistence\Eloquent\Mappers\Admin;

use App\Domain\Admin\Events\Entities\Event;

class EventMapper
{
    public static function fromModel(object $model): Event
    {
        return Event::reconstitute(
            id: $model->id,
            type: $model->id,
            date: $model->id,
            clientName: $model->id,
            clientAddress: $model->id,
            eventAddress: $model->id,
            eventDate: $model->id,
            discount: $model->id,
            advance: $model->id,
            travelExpenses: $model->id,
            notes: $model->id,
            reminderSendDate: $model->id,
            reminderSent: $model->id,
            price: $model->id
        );
    }
}

<?php

namespace App\Infraestructure\Persistence\Eloquent\Repositories;

use App\Domain\Admin\Events\Contracts\EventRepository;
use App\Domain\Admin\Events\Entities\Event;

class EloquentEventRepository implements EventRepository
{
    public function getEvents(): array
    {
        return [];
    }

    public function save(Event $event) {}

    public function update(Event $event) {}

    public function delete(Event $event) {}
}

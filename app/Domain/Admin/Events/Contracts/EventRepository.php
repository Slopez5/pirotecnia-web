<?php

namespace App\Domain\Admin\Events\Contracts;

use App\Domain\Admin\Events\Entities\Event;

interface EventRepository
{
    public function getEvents(): array;

    public function save(Event $event);

    public function update(Event $event);

    public function delete(Event $event);
}

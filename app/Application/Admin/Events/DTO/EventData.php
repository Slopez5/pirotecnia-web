<?php

namespace App\Application\Admin\Events\DTO;

use App\Domain\Admin\Events\Entities\Event;
use Spatie\LaravelData\Data;

class EventData extends Data
{
    public function __construct(
        public ?int $id,
        public string $type,
        public string $date,
        public string $clientName,
        public string $clientAddress,
        public string $eventAddress,
        public string $eventDate,
        public string $discount,
        public string $advance,
        public string $travelExpenses,
        public string $notes,
        public string $reminderSendDate,
        public string $reminderSent,
        public string $price,
    ) {}

    public function fromEntity(Event $event): self
    {
        return new self(
            id: 1,
            type: '',
            date: '',
            clientName: '',
            clientAddress: '',
            eventAddress: '',
            eventDate: '',
            discount: '',
            advance: '',
            travelExpenses: '',
            notes: '',
            reminderSendDate: '',
            reminderSent: '',
            price: ''
        );
    }
}

<?php

namespace App\Domain\Admin\Events\Entities;

class Event
{
    public function __construct(
        private ?int $id,
        private string $type,
        private string $date,
        private string $clientName,
        private string $clientAddress,
        private string $eventAddress,
        private string $eventDate,
        private string $discount,
        private string $advance,
        private string $travelExpenses,
        private string $notes,
        private string $reminderSendDate,
        private string $reminderSent,
        private string $price,
    ) {}

    public static function create(
        string $type,
        string $date,
        string $clientName,
        string $clientAddress,
        string $eventAddress,
        string $eventDate,
        string $discount,
        string $advance,
        string $travelExpenses,
        string $notes,
        string $reminderSendDate,
        string $reminderSent,
        string $price,
    ) {
        return new self(
            id: null,
            type: $type,
            date: $date,
            clientName: $clientName,
            clientAddress: $clientAddress,
            eventAddress: $eventAddress,
            eventDate: $eventDate,
            discount: $discount,
            advance: $advance,
            travelExpenses: $travelExpenses,
            notes: $notes,
            reminderSendDate: $reminderSendDate,
            reminderSent: $reminderSent,
            price: $price
        );
    }

    public static function reconstitute(
        int $id,
        string $type,
        string $date,
        string $clientName,
        string $clientAddress,
        string $eventAddress,
        string $eventDate,
        string $discount,
        string $advance,
        string $travelExpenses,
        string $notes,
        string $reminderSendDate,
        string $reminderSent,
        string $price,
    ) {
        return new self(
            id: $id,
            type: $type,
            date: $date,
            clientName: $clientName,
            clientAddress: $clientAddress,
            eventAddress: $eventAddress,
            eventDate: $eventDate,
            discount: $discount,
            advance: $advance,
            travelExpenses: $travelExpenses,
            notes: $notes,
            reminderSendDate: $reminderSendDate,
            reminderSent: $reminderSent,
            price: $price
        );
    }
}

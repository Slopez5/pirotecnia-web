<?php

namespace App\Domain\Employees\Dashboard\Entities;

class Event
{
    public function __construct(
        public ?int $id,
        public string $eventType,
        public ?string $image,
        public string $package,
        public string $date,
        public string $phone,
        public string $clientName,
        public Address $clientAddress,
        public Address $eventAddress,
        public string $eventDate,
        public string $discount,
        public string $advance,
        public string $travelExpenses,
        public string $price,
        public ?string $fullPrice,
        public ?string $balance,
        public string $notes,
        public ?string $reminderSendDate,
        public ?string $reminderSend,
        public ?string $pdfUrl,
        public array $employees = [],
        public array $packages = [],
        public array $products = [],
        public array $equipments = []
    ) {}

    public function getAllProducts(): array
    {
        $products = $this->products;

        return $products;
    }

    public function getAllEquipments(): array
    {
        $equipments = $this->equipments;
        $equipmentsInPackages = [];
        foreach ($this->packages as $index => $package) {
            $package->equipments;
            foreach ($package->equipments as $indexEquipment => $equipment) {
                $equipmentsInPackages[] = $equipment;
            }
        }

        return $this->equipments;
    }

    public function getTotal(): string
    {
        $price = 0;
        $price = $this->getPrice();
        $discount = 0;

        if ($this->discount > 0) {
            if ($this->discount < 1) {
                $discount = $this->discount * $price;
            } else {
                $discount = $this->discount;
            }
        }

        return $price - $discount;
    }

    public function getBalance(): string
    {
        $total = $this->getTotal();
        $balance = $total - $this->advance;

        return $balance;
    }

    public function getPrice(): string
    {
        $price = 0;
        foreach ($this->packages as $index => $package) {
            $price += $package->price;
        }
        logger($this->travelExpenses);
        $price += $this->travelExpenses;

        return $price;
    }
}

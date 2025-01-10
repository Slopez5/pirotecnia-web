<?php

namespace App\Core\Data\Entities;

use Illuminate\Support\Collection;

class Event
{
    public $id;
    public $event_type_id;
    public $package_id;
    public $date;
    public $phone;
    public $client_name;
    public $client_address;
    public $event_address;
    public $event_date;
    public $disscount;
    public $advance;
    public $travel_expenses;
    public $notes;
    public $reminder_send_date;
    public $reminder_send;
    public Collection $employees;
    public Collection $packages;
    public Collection $products;
    public Collection $equipments;

    public function __construct(array $attributes = [])
    {
        $this->employees = new Collection();
        $this->packages = new Collection();
        $this->products = new Collection();
        $this->equipments = new Collection();

        // Asigna los atributos dinámicamente
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function __toString()
    {
        return sprintf(
            "Event
            id: %d
            event_type_id: %d
            package_id: %d
            date: %s
            phone: %s
            client_name: %s
            client_address: %s
            event_address: %s
            event_date: %s
            disscount: %s
            advance: %s
            travel_expenses: %s
            notes: %s
            reminder_send_date: %s
            reminder_send: %s
            employees: %s
            packages: %s
            products: %s
            equipments: %s",
            $this->id,
            $this->event_type_id,
            $this->package_id,
            $this->date,
            $this->phone,
            $this->client_name,
            $this->client_address,
            $this->event_address,
            $this->event_date,
            $this->disscount,
            $this->advance,
            $this->travel_expenses,
            $this->notes,
            $this->reminder_send_date,
            $this->reminder_send,
            json_encode($this->employees->toArray()),
            json_encode($this->packages->toArray()),
            json_encode($this->products->toArray()),
            json_encode($this->equipments->toArray())
        );
    }
}

<?php

namespace App\Core\Data\Entities;

use App\Models\Event as ModelsEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Event
{
    public $id;

    public $event_type;

    public $package;

    public $date;

    public $phone;

    public $client_name;

    public $client_address;

    public $event_address;

    public $event_date;

    public $discount = 0;

    public $advance = 0;

    public $travel_expenses = 0;

    public $price = 0;

    public $notes;

    public $reminder_send_date = null;

    public $reminder_send = false;

    public ?Collection $employees;

    public ?Collection $packages;

    public ?Collection $products;

    public ?Collection $equipments;

    public ?Collection $lowInventoryProducts;

    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function fromArray(array $attributes)
    {
        // convert employees, packages, products, equipments to collections
        $employees = (new Collection($attributes['employees'] ?? []))->map(function ($employee) {
            return new Employee($employee);
        });

        $packages = (new Collection($attributes['packages'] ?? []))->map(function ($package) {
            return new Package($package);
        });

        $products = (new Collection($attributes['products'] ?? []))->map(function ($product) {
            return new Product($product);
        });

        $equipments = (new Collection($attributes['equipments'] ?? []))->map(function ($equipment) {
            return new Equipment($equipment);
        });
        unset($attributes['employees']);
        unset($attributes['packages']);
        unset($attributes['products']);
        unset($attributes['equipments']);

        $newEvent = (new self($attributes))
            ->withPackages($packages)
            ->withProducts($products)
            ->withEquipments($equipments)
            ->withEmployees($employees);

        return $newEvent;
    }

    public static function fromEvent(ModelsEvent|Model $event)
    {
        $event->load('employees', 'packages', 'products', 'equipments');
        $newEvent = new self(self::extractAttributes($event));
        logger('Event attributes: '.json_encode($newEvent));
        $newEvent->employees = self::mapEmployees($event->employees);
        $newEvent->packages = self::mapPackages($event->packages);
        $newEvent->products = self::mapProducts($event->packages, $event->products);
        $newEvent->equipments = self::mapEquipments($event->packages, $event->equipments);

        $newEvent->packages = $newEvent->packages->map(function ($package) {
            unset($package->products);
            unset($package->equipments);

            return $package;
        });

        return $newEvent;
    }

    private static function extractAttributes($event)
    {

        return [
            'id' => $event->id,
            'event_type' => $event->typeEvent->name,
            'package' => $event->packages[0]->name,
            'date' => $event->date,
            'phone' => $event->phone,
            'client_name' => $event->client_name,
            'client_address' => $event->client_address,
            'event_address' => $event->event_address,
            'event_date' => $event->event_date,
            'discount' => $event->discount,
            'advance' => $event->advance,
            'travel_expenses' => $event->travel_expenses,
            'notes' => $event->notes,
            'reminder_send_date' => $event->reminder_send_date,
            'reminder_send' => $event->reminder_send,
            'price' => $event->price,
        ];
    }

    private static function mapEmployees($employees)
    {
        return $employees->count() > 0 ? $employees->map(fn ($employee) => Employee::fromEmployee($employee)) : new Collection;
    }

    private static function mapPackages($packages)
    {
        return $packages->count() > 0 ? $packages->map(fn ($package) => Package::fromPackage($package)) : new Collection;
    }

    private static function mapProducts($packages, $products)
    {
        $products = $packages->flatMap(fn ($package) => $package->products->map(fn ($product) => Product::fromProduct($product)))
            ->merge($products->map(fn ($product) => Product::fromProduct($product)));

        return $products->map(function ($product) use ($products) {
            $sameProduct = $products->where('id', $product->id);
            $product->quantity = $sameProduct->sum('quantity');

            return $product;
        })->unique('id')->values();
    }

    private static function mapEquipments($packages, $equipments)
    {
        $equipments = $packages->flatMap(fn ($package) => $package->equipments->map(fn ($equipment) => Equipment::fromEquipment($equipment)))
            ->merge($equipments->map(fn ($equipment) => Equipment::fromEquipment($equipment)));

        return $equipments->map(function ($equipment) use ($equipments) {
            $sameEquipment = $equipments->where('id', $equipment->id);
            $equipment->quantity = $sameEquipment->sum('quantity');

            return $equipment;
        })->unique('id')->values();
    }

    public function __toString()
    {
        return json_encode($this);
    }

    public function toArray()
    {
        return json_decode($this->__toString(), true);
    }

    public function withPackages(Collection $packages): self
    {
        $this->packages = $packages;

        return $this;
    }

    public function withProducts(Collection $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function withEquipments(Collection $equipments): self
    {
        $this->equipments = $equipments;

        return $this;
    }

    public function withEmployees(Collection $employees): self
    {
        $this->employees = $employees;

        return $this;
    }
}

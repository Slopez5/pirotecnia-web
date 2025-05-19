<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\EventRepositoryInterface;
use Illuminate\Support\Collection;

class AssignProductsToEvent
{
    public function __construct(
        private EventRepositoryInterface $eventRepository
    ) {}

    public function execute(Event $event): ?Event
    {
        $eventId = $event->id;
        $products = $event->products;

        $products = $this->validateProducts($products);
        if ($event) {
            $event = $this->eventRepository->assignProductsToEvent($eventId, $products);

            return $event;
        }

        return null;
    }

    private function validateProducts(Collection $products): Collection
    {
        $products = $products->map(function ($product) use ($products) {
            // Add quantity to product duplicates
            $quantity = $products->where('id', $product->id)->sum('quantity');
            $product->quantity = $quantity;

            return $product;
        })->unique('id')->values();

        return $products;
    }
}

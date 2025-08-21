<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class LoadProductsFromEvent
{
    public function __construct(private ProductRepositoryInterface $productRepository) {}

    public function execute(int $eventId): Collection
    {
        return collect();
    }
}

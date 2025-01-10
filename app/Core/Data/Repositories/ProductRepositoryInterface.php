<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function create(Product $product): Product;

    public function update(Product $product): Product;

    public function delete(Product $product): bool;

    public function findById(int $id): ?Product;

    public function getByPackageIds(array $packageIds): Collection;

    public function getByEventId(int $eventId): Collection;
}
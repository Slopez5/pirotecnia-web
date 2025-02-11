<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface {
    public function all(): Collection;
    public function find(int $productId): ?Product;
    public function findByInventoryId(int $inventoryId): Collection;
    public function findByPackageId(int $packageId): Collection;
    public function getByPackageIds(Collection $packageIds): Collection;
    public function getByEventId(int $eventId): Collection;
    public function create(Product $product): ?Product;
    public function update(int $productId, Product $product): ?Product;
    public function delete(int $productId): bool;
    public function searchProducts($searchTerm): Collection;
    


    
}
<?php

namespace App\Core\Domains\Repositories;

use App\Core\Data\Entities\Product;
use App\Core\Data\Repositories\ProductRepositoryInterface;
use App\Core\Data\Services\ProductService;
use Illuminate\Support\Collection;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function all(): Collection
    {
        return $this->productService->all();
    }

    public function find(int $id): ?Product
    {
        return $this->productService->find($id);
    }

    public function findByInventoryId(int $inventoryId): Collection
    {
        return $this->productService->findByInventoryId($inventoryId);
    }

    public function findByPackageId(int $packageId): Collection
    {
        return $this->productService->findByPackageId($packageId);
    }

    public function create(Product $product): ?Product
    {
        return $this->productService->create($product);
    }

    public function update(int $productId, Product $product): ?Product
    {
        return $this->productService->update($product);
    }

    public function delete(int $productId): bool
    {
        return $this->productService->delete($productId);
    }

    public function searchProducts($searchTerm): Collection
    {
        return $this->productService->searchProducts($searchTerm);
    }

    public function getByPackageIds(Collection $packageIds): Collection
    {
        return $this->productService->getByPackageIds($packageIds);
    }

    public function getByEventId(int $eventId): Collection
    {
        return $this->productService->getByEventId($eventId);
    }
}

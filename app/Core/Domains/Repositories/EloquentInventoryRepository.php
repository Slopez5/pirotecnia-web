<?php

namespace App\Core\Domains\Repositories;

use App\Core\Data\Entities\Inventory;
use App\Core\Data\Repositories\InventoryRepositoryInterface;
use App\Core\Data\Services\InventoryService;
use App\Models\Inventory as ModelsInventory;
use Illuminate\Support\Collection;

class EloquentInventoryRepository implements InventoryRepositoryInterface {
    public function __construct(
        private InventoryService $inventoryService
    ) {}

    public function all(): Collection
    {
        return $this->inventoryService->all();
    }

    public function find(int $inventoryId): ?Inventory
    {
        return $this->inventoryService->find($inventoryId);

    }

    public function create(Inventory $inventory): ?Inventory
    {
        return $this->inventoryService->create($inventory);
    }

    public function update(int $inventoryId, Inventory $inventory): ?Inventory
    {
        return $this->inventoryService->update($inventory);
    }

    public function delete(int $inventoryId): bool
    {
        return $this->inventoryService->delete($inventoryId);
    }

    public function searchInventories($searchTerm): Collection
    {
       
        return $this->inventoryService->searchInventories($searchTerm);
    }

    public function checkLowInventoryByProducts(Collection $products): Collection
    {
        return $this->inventoryService->checkLowInventoryByProducts($products);
    }


}
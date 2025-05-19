<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Inventory;
use Illuminate\Support\Collection;

interface InventoryRepositoryInterface
{
    public function all(): Collection;

    public function find(int $inventoryId): ?Inventory;

    public function create(Inventory $inventory): ?Inventory;

    public function update(int $inventoryId, Inventory $inventory): ?Inventory;

    public function delete(int $inventoryId): bool;

    public function searchInventories($searchTerm): Collection;

    public function checkLowInventoryByProducts(Collection $products): Collection;
}

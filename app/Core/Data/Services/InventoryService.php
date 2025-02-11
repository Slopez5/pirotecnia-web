<?php

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Inventory;
use App\Core\Data\Entities\Product;
use App\Models\Inventory as ModelsInventory;
use App\Models\Product as ModelsProduct;
use Illuminate\Database\Events\ModelsPruned;
use Illuminate\Support\Collection;

class InventoryService
{
    public function all(): Collection
    {
        try {
            $inventories = ModelsInventory::all();
            $inventories = $inventories->map(function ($inventory) {
                return Inventory::fromInventory($inventory);
            });
            return $inventories;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function find(int $inventoryId): ?Inventory
    {
        try {
            $inventory = ModelsInventory::find($inventoryId);
            return Inventory::fromInventory($inventory);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function create(Inventory $inventory): ?Inventory
    {
        try {
            $newInventory = new ModelsInventory();
            $newInventory->fill([
                'name' => $inventory->name,
                'products' => $inventory->products
            ]);
            $newInventory->save();
            $inventory->id = $newInventory->id;
            return $inventory;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update(Inventory $inventory): ?Inventory
    {
        try {
            $inventoryToUpdate = ModelsInventory::find($inventory->id);
            $inventoryToUpdate->fill([
                'name' => $inventory->name,
                'products' => $inventory->products
            ]);
            $inventoryToUpdate->save();
            return $inventory;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete(int $inventoryId): bool
    {
        try {
            $inventory = ModelsInventory::find($inventoryId);
            $inventory->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function searchInventories(string $searchTerm): Collection
    {
        try {
            // TODO: Implement searchInventories() method
            return new Collection();
        } catch (\Exception $e) {
            return new Collection();
        }
    }

    public function checkLowInventoryByProducts(Collection $products): Collection
    {
        try {
            $eloquentProducts = ModelsProduct::with('inventories')->whereIn('id', $products->pluck('id'))->whereHas('inventories', function ($query) {
                $query->where('id', 1);
            })->get();
            
            $products = $eloquentProducts->map(function ($product){
                $product = Product::fromProduct($product,'inventory');
                return $product;
            });

            return $products;
        } catch (\Exception $e) {
            logger($e->getMessage());
            return new Collection();
        }
    }
}

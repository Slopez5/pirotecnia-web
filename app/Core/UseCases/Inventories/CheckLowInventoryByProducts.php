<?php

namespace App\Core\UseCases\Inventories;

use App\Core\Data\Repositories\InventoryRepositoryInterface;
use App\Models\Inventory as ModelsInventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CheckLowInventoryByProducts
{
    public function __construct(
        private InventoryRepositoryInterface $inventoryRepository
    ) {}

    public function execute(Collection $products): Collection
    {
        try {
            $products = DB::transaction(function () use ($products) {
                $products = $this->inventoryRepository
                    ->checkLowInventoryByProducts($products)
                    ->map(function ($product) use ($products) {
                        $product->quantity -= $products->where('id', $product->id)->first()->quantity;

                        return $product;
                    })
                    ->where('quantity', '<', ModelsInventory::MIN_STOCK)
                    ->values();

                return $products;
            });

            return $products;
        } catch (\Exception $e) {
            return new Collection;
        }
    }
}

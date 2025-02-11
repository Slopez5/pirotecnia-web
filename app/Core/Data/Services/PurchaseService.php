<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Purchase;
use App\Models\Purchase as ModelsPurchase;
use Illuminate\Support\Collection;

class PurchaseService {
    public function all(): Collection
    {
        try {
            $eloquentPurchases = ModelsPurchase::all();
            $purchases = $eloquentPurchases->map(function ($eloquentPurchase) {
                return Purchase::fromPurchase($eloquentPurchase);
            });
            return $purchases;
        } catch (\Exception $e) {
            return new Collection();
        }
    }

    public function find($purchaseId): ?Purchase
    {
        try {
            $eloquentPurchase = ModelsPurchase::find($purchaseId);
            $purchase = Purchase::fromPurchase($eloquentPurchase);
            return $purchase;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function create($purchase): ?Purchase
    {
        try {
            $eloquentPurchase = new ModelsPurchase();
            $eloquentPurchase->fill([
                'name' => $purchase->name,
                'description' => $purchase->description
            ]);
            $eloquentPurchase->save();
            $purchase->id = $eloquentPurchase->id;
            return $purchase;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update($purchase): ?Purchase {
        try {
            $eloquentPurchase = ModelsPurchase::find($purchase->id);
            $eloquentPurchase->fill([
                'name' => $purchase->name,
                'description' => $purchase->description
            ]);
            $eloquentPurchase->save();
            return $purchase;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete($purchaseId): bool {
        try {
            $eloquentPurchase = ModelsPurchase::find($purchaseId);
            $eloquentPurchase->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getPurchaseByProductId($productId): Collection
    {
        try {
            $eloquentPurchases = ModelsPurchase::where('product_id', $productId)->get();
            $purchases = $eloquentPurchases->map(function ($eloquentPurchase) {
                return Purchase::fromPurchase($eloquentPurchase);
            });
            return $purchases;
        } catch (\Exception $e) {
            return new Collection();
        }
    }
}
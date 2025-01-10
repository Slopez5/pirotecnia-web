<?php

namespace App\Core\Repositories;

use App\Core\Data\Entities\Product;
use App\Core\Data\Repositories\ProductRepositoryInterface;
use App\Models\Product as ModelsProduct;
use Illuminate\Support\Collection;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function create(Product $product): Product
    {
        logger('Product created');
        return $product;
    }

    public function update(Product $product): Product
    {
        return $product;
    }

    public function delete(Product $product): bool
    {
        return true;
    }

    public function findById(int $id): ?Product
    {
        return null;
    }

    public function getByPackageIds(array $packageIds): Collection
    {
        $products = ModelsProduct::with(['packages' => function ($query) use ($packageIds) {
            $query->whereIn('id', $packageIds)
                ->select('id', 'name') // Selecciona solo las columnas necesarias
                ->withPivot('quantity'); // Carga la cantidad directamente desde el pivote
        }])
            ->whereHas('packages', function ($query) use ($packageIds) {
                $query->whereIn('id', $packageIds);
            })
            ->select('id', 'name') // Selecciona solo las columnas necesarias
            ->get();
            
        $products = $products->flatMap(function ($product) {
            return $product->packages->map(function ($package) use ($product) {
                return [
                    'quantity' => $package->pivot->quantity,
                    'product' => new Product([
                        'id' => $product->id,
                        'product_role_id' => $product->product_role_id,
                        'name' => $product->name,
                        'description' => $product->description ?? null,
                        'unit' => $product->unit ?? null,
                        'duration' => $product->duration ?? null,
                        'shots' => $product->shots ?? null,
                        'caliebr' => $product->caliebr ?? null,
                        'shape' => $product->shape ?? null,
                    ]),
                ];
            });
        });
        return $products;
    }

    public function getByEventId(int $eventId): Collection
    {
        $packages = new Collection();
        return $packages;
    }
}

<?php 

namespace App\Application\Employees\Dashboard\DTO;

use App\Domain\Employees\Dashboard\Entities\Product;
use Spatie\LaravelData\Data;

class ProductData extends Data {
    public function __construct(
        public int $id,
        public ?string $productRole,
        public string $name,
        public string $description,
        public string $unit,
        public ?string $duration,
        public ?string $shots,
        public string $caliber,
        public ?string $shape,
        public ?string $quantity,
        public ?string $price
    ) {}

    public static function fromEntity(Product $product): self {
        return new self(
            id: $product->id,
            productRole: $product->productRole,
            name: $product->name,
            description: $product->description,
            unit: $product->unit,
            duration: $product->duration,
            shots: $product->shots,
            caliber: $product->caliber,
            shape: $product->shape,
            quantity: $product->quantity,
            price: $product->price
        );
    }
}
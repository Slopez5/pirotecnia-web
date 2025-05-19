<?php

namespace App\Core\Data\Entities;

class ProductInventory
{
    public $id;

    public $name;

    public $description;

    public $quantity;

    public $price;

    public function __construct(array $attributes = [])
    {
        // Asigna los atributos dinámicamente
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function __toString()
    {
        return json_encode($this);
    }

    public static function fromProduct($product)
    {
        return new ProductInventory([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'quantity' => $product->pivot ? $product->pivot->quantity : null,
            'price' => $product->pivot ? $product->pivot->price : null,
        ]);
    }
}

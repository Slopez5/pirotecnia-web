<?php

namespace App\Core\Data\Entities;

class Inventory {
    public $id;
    public $name;
    public $products;

    public function __construct(array $attributes = [])
    {
        // Asigna los atributos dinámicamente
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    static function fromInventory($inventories) {
        return $inventories->map(function($inventory) {
            return new Inventory([
                'id' => $inventory->id,
                'name' => $inventory->name,
                'products' => $inventory->products,
                'quantity' => $inventory->pivot->quantity
            ]);
        });
    }
}
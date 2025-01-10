<?php

namespace App\Core\Data\Entities;

class Product {
    public $id;
    public $product_role_id;
    public $name;
    public $description;
    public $unit;
    public $duration;
    public $shots;
    public $caliebr;
    public $shape;
    public $quantity;

    public function __construct(array $attributes = [])
    {
        // Asigna los atributos dinámicamente
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
<?php

namespace App\Core\Data\Entities;


class Equipment {
    public $id;
    public $name;
    public $description;
    public $unit;

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
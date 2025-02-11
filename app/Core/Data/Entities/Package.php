<?php

namespace App\Core\Data\Entities;

class Package {
    public $id;
    public $experience_level_id;
    public $name;
    public $description;
    public $price;
    public $duration;
    public $video_url;
    public $equipments;
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

    public function __toString()
    {
        return json_encode($this);
    }

    static function fromPackage($package) {
        return new Package([
            'id' => $package->id,
            'experience_level_id' => $package->experience_level_id,
            'name' => $package->name,
            'description' => $package->description,
            'price' => $package->price,
            'duration' => $package->duration,
            'video_url' => $package->video_url,
            'equipments' => $package->equipments->map(fn($equipment) => Equipment::fromEquipment($equipment)),
            'products' => $package->products->map(fn($product) => Product::fromProduct($product))
        ]);
    }
}
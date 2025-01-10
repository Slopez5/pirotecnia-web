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
<?php

namespace App\Core\Data\Entities;

class ExperienceLevel {
    public $id;
    public $name;
    public $description;

    public function __construct(array $attributes = [])
    {
        // Asigna los atributos dinámicamente
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    static function fromExperienceLevel($experienceLevel) {
        return new ExperienceLevel([
            'id' => $experienceLevel->id,
            'name' => $experienceLevel->name,
            'description' => $experienceLevel->description
        ]);
    }
}
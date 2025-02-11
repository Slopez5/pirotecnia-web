<?php

namespace App\Core\Data\Entities;

class EventType {
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

    static function fromEventType($eventType) {
        return new EventType([
            'id' => $eventType->id,
            'name' => $eventType->name,
            'description' => $eventType->description
        ]);
    }
}
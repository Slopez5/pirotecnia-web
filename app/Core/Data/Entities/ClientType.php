<?php

namespace App\Core\Data\Entities;

class ClientType {
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

    static function fromClientType($clientType) {
        return new ClientType([
            'id' => $clientType->id,
            'name' => $clientType->name,
            'description' => $clientType->description
        ]);
    }
}
<?php

namespace App\Core\Data\Entities;

class Employee
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $salary;
    public $photo;
    public $experience_level_id;

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
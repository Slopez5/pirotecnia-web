<?php 

namespace App\Domain\Employees\Dashboard\Entities;

class Location {
    public function __construct(
        public string $latitude,
        public string $longitude
    ) {}
}
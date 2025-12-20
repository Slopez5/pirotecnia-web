<?php 

namespace App\Domain\Employees\Dashboard\Entities;

class ExperienceLevel {
    public function __construct(
        public int $id,
        public string $name,
        public string $description
    ) {}
}
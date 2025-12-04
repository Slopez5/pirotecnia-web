<?php 

namespace App\Domain\Employees\Dashboard\Entities;

class Employee {
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $phone,
        public string $address,
        public string $salary,
        public ?string $photo,
        public string $experienceLevel,
    ) {}
}
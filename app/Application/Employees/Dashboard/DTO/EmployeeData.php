<?php 

namespace App\Application\Employees\Dashboard\DTO;

use App\Domain\Employees\Dashboard\Entities\Employee;
use Spatie\LaravelData\Data;

class EmployeeData extends Data {
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $phone,
        public string $address,
        public string $salary,
        public string $photo,
        public string $experienceLevel
    ){}

    public static function fromEntity(Employee $employee): self {
        return new self(
            id: $employee->id,
            name: $employee->name,
            email: $employee->email,
            phone: $employee->phone,
            address: $employee->address,
            salary: $employee->salary,
            photo: $employee->photo ?? "",
            experienceLevel: $employee->experienceLevel
        );
    }
}
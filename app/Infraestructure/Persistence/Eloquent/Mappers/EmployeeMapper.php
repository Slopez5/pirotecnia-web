<?php 

namespace App\Infraestructure\Persistence\Eloquent\Mappers;

use App\Domain\Employees\Dashboard\Entities\Employee;

class EmployeeMapper {
    public static function fromModel(object $model): Employee {
        return new Employee(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            phone: $model->phone,
            address: $model->address,
            salary: $model->salary,
            photo: $model->photo,
            experienceLevel: $model->experienceLevel
        );
    }
}
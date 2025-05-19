<?php

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Employee;
use App\Models\Employee as ModelsEmployee;
use Illuminate\Support\Collection;

class EmployeeService
{
    public function all(): Collection
    {
        try {
            $eloquentEmployees = ModelsEmployee::all();
            $employees = $eloquentEmployees->map(function ($eloquentEmployee) {
                return Employee::fromEmployee($eloquentEmployee);
            });

            return $employees;
        } catch (\Exception $e) {
            return new Collection;
        }
    }

    public function find(int $employeeId): ?Employee
    {
        try {
            $eloquentEmployee = ModelsEmployee::find($employeeId);
            $employee = Employee::fromEmployee($eloquentEmployee);

            return $employee;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function findEmployeesByEvent(int $eventId): Collection
    {
        try {
            $eloquentEmployees = ModelsEmployee::whereHas('events', function ($query) use ($eventId) {
                $query->where('id', $eventId);
            })->get();
            $employees = $eloquentEmployees->map(function ($eloquentEmployee) {
                return Employee::fromEmployee($eloquentEmployee);
            });

            return $employees;
        } catch (\Exception $e) {
            return new Collection;
        }
    }

    public function create(Employee $employee): ?Employee
    {
        try {
            $eloquentEmployee = new ModelsEmployee;
            $eloquentEmployee->fill([
                'name' => $employee->name,
                'email' => $employee->email,
                'phone' => $employee->phone,
                'address' => $employee->address,
                'salary' => $employee->salary,
                'photo' => $employee->photo,
                'experience_level_id' => $employee->experience_level_id,
            ]);
            $eloquentEmployee->save();
            $employee->id = $eloquentEmployee->id;

            return $employee;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update(Employee $employee): ?Employee
    {
        try {
            $eloquentEmployee = ModelsEmployee::find($employee->id);
            $eloquentEmployee->fill([
                'name' => $employee->name,
                'email' => $employee->email,
                'phone' => $employee->phone,
                'address' => $employee->address,
                'salary' => $employee->salary,
                'photo' => $employee->photo,
                'experience_level_id' => $employee->experience_level_id,
            ]);
            $eloquentEmployee->save();

            return $employee;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete(int $employeeId): bool
    {
        try {
            $eloquentEmployee = ModelsEmployee::find($employeeId);
            $eloquentEmployee->delete();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function searchEmployees(string $searchTerm): Collection
    {
        try {
            $eloquentEmployees = ModelsEmployee::where('name', 'like', "%$searchTerm%")->get();
            $employees = $eloquentEmployees->map(function ($eloquentEmployee) {
                return Employee::fromEmployee($eloquentEmployee);
            });

            return $employees;
        } catch (\Exception $e) {
            return new Collection;
        }
    }
}

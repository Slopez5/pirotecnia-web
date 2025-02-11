<?php

namespace App\Core\Domains\Repositories;

use App\Core\Data\Entities\Employee;
use App\Core\Data\Repositories\EmployeeRepositoryInterface;
use App\Core\Data\Services\EmployeeService;
use Illuminate\Support\Collection;

class EloquentEmployeeRepository implements EmployeeRepositoryInterface {

    public function __construct(
        private EmployeeService $employeeService
    ){}

    public function all(): Collection
    {
        return $this->employeeService->all();
    }

    public function find($id): ?Employee
    {
        return $this->employeeService->find($id);
    }

    public function findEmployeesByEvent($eventId): Collection
    {
        return $this->employeeService->findEmployeesByEvent($eventId);
    }

    public function create($employee): ?Employee
    {
        return $this->employeeService->create($employee);
    }

    public function update($id, $employee): ?Employee
    {
        return $this->employeeService->update($id, $employee);
    }

    public function delete($id): bool
    {
        return $this->employeeService->delete($id);
    }

    public function searchEmployees($searchTerm): Collection
    {
        return $this->employeeService->searchEmployees($searchTerm);
    }
}
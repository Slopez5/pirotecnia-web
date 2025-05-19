<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Employee;
use Illuminate\Support\Collection;

interface EmployeeRepositoryInterface
{
    public function all(): Collection;

    public function find(int $employeeId): ?Employee;

    public function findEmployeesByEvent(int $eventId): Collection;

    public function create(Employee $employee): ?Employee;

    public function update(int $employeeId, Employee $employee): ?Employee;

    public function delete(int $employeeId): bool;

    public function searchEmployees(string $searchTerm): Collection;
}

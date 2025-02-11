<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\ClientType;
use Illuminate\Support\Collection;

interface ClientTypeRepositoryInterface {
    public function all(): Collection;
    public function find(int $clientTypeId): ?ClientType;
    public function create(ClientType $clientType): ?ClientType;
    public function update(int $clientTypeId, ClientType $clientType): ?ClientType;
    public function delete(int $clientTypeId): bool;
    public function searchClientTypes($searchTerm): ?Collection;
}
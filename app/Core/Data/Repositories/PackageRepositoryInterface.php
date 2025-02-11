<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Package;
use Illuminate\Support\Collection;

interface PackageRepositoryInterface {
    public function all(): Collection;
    public function find(int $packageId): ?Package;
    public function create(Package $package): ?Package;
    public function update(int $packageId, Package $package): ?Package;
    public function delete(int $packageId): bool;
    public function searchPackages($searchTerm): Collection;
}
<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Purchase;
use Illuminate\Support\Collection;

interface PurchaseRepositoryInterface
{
    public function all(): Collection;

    public function find(int $purchaseId): ?Purchase;

    public function create(Purchase $purchase): ?Purchase;

    public function update(int $purchaseId, Purchase $purchase): ?Purchase;

    public function delete(int $purchaseId): bool;

    public function searchPurchases($searchTerm): Collection;
}

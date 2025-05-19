<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Sale;
use Illuminate\Support\Collection;

interface SaleRepositoryInterface
{
    public function all(): Collection;

    public function find(int $saleId): ?Sale;

    public function create(Sale $sale): ?Sale;

    public function update(int $saleId, Sale $sale): ?Sale;

    public function delete(int $saleId): bool;

    public function searchSales($searchTerm): Collection;
}

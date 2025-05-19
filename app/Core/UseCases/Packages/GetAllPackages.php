<?php

namespace App\Core\UseCases\Packages;

use App\Core\Data\Repositories\PackageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllPackages
{
    public function __construct(
        private PackageRepositoryInterface $packageRepository
    ) {}

    public function execute(int $page): Collection
    {
        $perPage = 10;
        $packages = $this->packageRepository->all();
        $slicedPackages = $packages->slice(($page - 1) * $perPage, $perPage)->values();
        $paginator = new LengthAwarePaginator($slicedPackages, $packages->count(), $perPage, $page);

        return new Collection([
            'total' => $packages->count(),
            'total_pages' => $paginator->lastPage(),
            'current_page' => $page,
            'per_page' => $perPage,
            'packages' => $paginator->values(),
        ]);
    }
}

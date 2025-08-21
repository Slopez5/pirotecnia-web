<?php

namespace App\Core\UseCases\Events;

use App\Core\Data\Repositories\PackageRepositoryInterface;
use Illuminate\Support\Collection;

class LoadPackagesFromEvent
{
    public function __construct(private PackageRepositoryInterface $packageRepository) {}

    public function execute(int $eventId): Collection
    {
        return $this->packageRepository->findByEventId($eventId);
    }
}

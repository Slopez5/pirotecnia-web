<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\Event;
use Illuminate\Support\Collection;

interface EventRepositoryInterface
{
    public function all(): Collection;
    public function find($id): ?Event;
    public function create(Event $event): ?Event;
    public function update(Event $event, $id): Event;
    public function delete($id): void;
    public function assignProducts(Event $event, array $products): void;
    public function assignEmployees(Event $event, array $employees): void;
    public function assignEquipment(Event $event, array $equipment): void;
    public function assignPackages(Event $event, array $packages): void;
}
<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\EventType;
use App\Models\EventType as ModelsEventType;
use Illuminate\Support\Collection;

class EventTypeService {
    public function all(): Collection
    {
        try {
            $eloquentEventTypes = ModelsEventType::all();
            $eventTypes = $eloquentEventTypes->map(function ($eloquentEventType) {
                return EventType::fromEventType($eloquentEventType);
            });

            return $eventTypes;
        } catch (\Exception $e) {
            return new Collection();
        }
    }

    public function find(int $eventTypeId): ?EventType
    {
        try {
            $eloquentEventType = ModelsEventType::find($eventTypeId);
            $eventType = EventType::fromEventType($eloquentEventType);
            return $eventType;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function create(EventType $eventType): ?EventType
    {
        try {
            $eloquentEventType = new ModelsEventType();
            $eloquentEventType->fill([
                'name' => $eventType->name,
                'description' => $eventType->description
            ]);
            $eloquentEventType->save();
            $eventType->id = $eloquentEventType->id;
            return $eventType;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update(EventType $eventType): ?EventType {
        try {
            $eloquentEventType = ModelsEventType::find($eventType->id);
            $eloquentEventType->fill([
                'name' => $eventType->name,
                'description' => $eventType->description
            ]);
            $eloquentEventType->save();
            return $eventType;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete(int $eventTypeId): bool {
        try {
            $eloquentEventType = ModelsEventType::find($eventTypeId);
            $eloquentEventType->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function searchEventTypes(string $searchTerm): Collection
    {
        try {
            // TODO: Implement searchEventTypes() method.
            return new Collection();
        } catch (\Exception $e) {
            return new Collection();
        }
    }
}
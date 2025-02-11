<?php

namespace App\Core\Data\Services;

use App\Core\Data\Entities\ClientType;
use App\Models\ClientType as ModelsClientType;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class ClientTypeService
{

    public function all(): Collection
    {
        try {
            $eloquentClientTypes = ModelsClientType::all();
            $clientTypes = $eloquentClientTypes->map(function ($eloquentClientType) {
                return new ClientType(
                    $eloquentClientType->id,
                    $eloquentClientType->name,
                    $eloquentClientType->description
                );
            });

            return $clientTypes;
        } catch (\Exception $e) {
            return new Collection();
        }
    }

    public function find(int $clientTypeId)
    {
        try {
            $eloquentClientType = ModelsClientType::find($clientTypeId);
            $clientType = ClientType::fromClientType($eloquentClientType);
            return $clientType;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function create(ClientType $clientType): ?ClientType
    {
        try {
            $eloquentClientType = new ModelsClientType();
            $eloquentClientType->fill([
                'name' => $clientType->name,
                'description' => $clientType->description
            ]);
            $eloquentClientType->save();
            $clientType->id = $eloquentClientType->id;
            return $clientType;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update(ClientType $clientType): ?ClientType {
        try {
            $eloquentClientType = ModelsClientType::find($clientType->id);
            $eloquentClientType->fill([
                'name' => $clientType->name,
                'description' => $clientType->description
            ]);
            $eloquentClientType->save();
            return $clientType;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete(int $clientTypeId): bool {
        try {
            $eloquentClientType = ModelsClientType::find($clientTypeId);
            $eloquentClientType->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function searchClientTypes(String $searchTerm): Collection {
        try {
            $eloquentClientTypes = ModelsClientType::where('name', 'like', '%' . $searchTerm . '%')->get();
            $clientTypes = $eloquentClientTypes->map(function ($eloquentClientType) {
                return new ClientType(
                    $eloquentClientType->id,
                    $eloquentClientType->name,
                    $eloquentClientType->description
                );
            });
            return $clientTypes;
        } catch (\Exception $e) {
            return new Collection();
        }
    }
}

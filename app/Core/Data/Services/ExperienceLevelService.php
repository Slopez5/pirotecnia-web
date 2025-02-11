<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\ExperienceLevel;
use App\Models\ExperienceLevel as ModelsExperienceLevel;
use Illuminate\Support\Collection;

class ExperienceLevelService {
    public function all(): Collection
    {
        try {
            $eloquentExperienceLevels = ModelsExperienceLevel::all();
            $experienceLevels = $eloquentExperienceLevels->map(function ($eloquentExperienceLevel) {
                return ExperienceLevel::fromExperienceLevel($eloquentExperienceLevel);
            });

            return $experienceLevels;
        } catch (\Exception $e) {
            return new Collection();
        }
    }

    public function find(int $experienceLevelId): ?ExperienceLevel
    {
        try {
            $eloquentExperienceLevel = ModelsExperienceLevel::find($experienceLevelId);
            $experienceLevel = ExperienceLevel::fromExperienceLevel($eloquentExperienceLevel);
            return $experienceLevel;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function create(ExperienceLevel $experienceLevel): ?ExperienceLevel
    {
        try {
            $eloquentExperienceLevel = new ModelsExperienceLevel();
            $eloquentExperienceLevel->fill([
                'name' => $experienceLevel->name,
                'description' => $experienceLevel->description
            ]);
            $eloquentExperienceLevel->save();
            $experienceLevel->id = $eloquentExperienceLevel->id;
            return $experienceLevel;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update(ExperienceLevel $experienceLevel): ?ExperienceLevel {
        try {
            $eloquentExperienceLevel = ModelsExperienceLevel::find($experienceLevel->id);
            $eloquentExperienceLevel->fill([
                'name' => $experienceLevel->name,
                'description' => $experienceLevel->description
            ]);
            $eloquentExperienceLevel->save();
            return $experienceLevel;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete(int $experienceLevelId): bool {
        try {
            $eloquentExperienceLevel = ModelsExperienceLevel::find($experienceLevelId);
            $eloquentExperienceLevel->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function searchExperienceLevels(string $searchTerm): Collection
    {
        try {
            // TODO: Implement searchExperienceLevels() method.
            return new Collection();
        } catch (\Exception $e) {
            return new Collection();
        }
    }
}
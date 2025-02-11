<?php

namespace App\Core\Data\Repositories;

use App\Core\Data\Entities\ExperienceLevel;
use Illuminate\Support\Collection;

interface ExperienceLevelRepositoryInterface {
    public function all(): Collection;
    public function find(int $experienceLevelId): ?ExperienceLevel;
    public function create(ExperienceLevel $experienceLevel): ?ExperienceLevel;
    public function update(int $experienceLevelId, ExperienceLevel $experienceLevel): ?ExperienceLevel;
    public function delete(int $experienceLevelId): bool;
    public function searchExperienceLevels($searchTerm): Collection;

}
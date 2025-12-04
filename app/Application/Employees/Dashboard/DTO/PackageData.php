<?php 

namespace App\Application\Employees\Dashboard\DTO;

use App\Domain\Employees\Dashboard\Entities\Package;
use Spatie\LaravelData\Data;

class PackageData extends Data {
    public function __construct(
        public int $id,
        public string $experienceLevel,
        public string $name,
        public string $description,
        public string $price,
        public string $duration,
        public ?string $videoUrl) {}

        public static function fromEntity(Package $package): self {
        return new self(
            id: $package->id,
            experienceLevel: $package->experienceLevel,
            name: $package->name,
            description: $package->description,
            price: $package->price,
            duration: $package->duration,
            videoUrl: $package->videoUrl ?? ""
        );
    }
}
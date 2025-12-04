<?php 

namespace App\Application\Employees\Dashboard\DTO;

use App\Domain\Employees\Dashboard\Entities\Equipment;
use Spatie\LaravelData\Data;

class EquipmentData extends Data {
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public string $unit,
        public int $quantity
    ) {}

    public static function fromEntity(Equipment $equipment): self {
        return new self(
            id: $equipment->id,
            name: $equipment->name,
            description: $equipment->description,
            unit: $equipment->unit,
            quantity: $equipment->quantity ?? 0
        );
    }
}
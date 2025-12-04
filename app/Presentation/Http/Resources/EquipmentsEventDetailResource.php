<?php 

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentsEventDetailResource extends JsonResource {
    public $resource;

    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "unit" => $this->unit,
            "quantity" => $this->quantity
        ];
    }
}
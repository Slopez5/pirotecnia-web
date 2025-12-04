<?php 

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsEventDetailResource extends JsonResource {
    public $resource;

    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "productRole" => $this->productRole,
            "name" => $this->name,
            "description" => $this->description,
            "unit" => $this->unit,
            "duration" => $this->duration,
            "shots" => $this->shots,
            "caliber" => $this->caliber,
            "shape" => $this->shape,
            "quantity" => $this->quantity,
            "price" => $this->price
        ];
    }

    
}
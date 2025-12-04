<?php 

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackagesEventDetailResource extends JsonResource {
    public $resource;

    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "experienceLevel" => $this->experienceLevel,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "duration" => $this->duration,
            "videoUrl" => $this->videoUrl
        ];
    }
}
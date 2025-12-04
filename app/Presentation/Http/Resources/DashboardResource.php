<?php 

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource {
    public $resource;

    public function toArray($request): array {
        return [
            "id" => $this->id,
            "image" => $this->image,
            "eventType" => $this->eventType,
            "eventDate" => $this->eventDate,
            "eventAddress" => $this->eventAddress
        ];
    }
}
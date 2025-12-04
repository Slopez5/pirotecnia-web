<?php 

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesEventDetailResource extends JsonResource {
    public $resource;

    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "address" => $this->address,
            "salary" => $this->salary,
            "photo" => $this->photo,
            "experienceLevel" => $this->experienceLevel
        ];
    }
}
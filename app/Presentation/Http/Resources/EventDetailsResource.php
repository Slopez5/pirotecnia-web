<?php 

namespace App\Presentation\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailsResource extends JsonResource {
    public $resource;

    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "eventType" => $this->eventType,
            "package" => $this->package,
            "date" => $this->date,
            "phone" => $this->phone,
            "clientName" => $this->clientName,
            "clientAddress" => $this->clientAddress,
            "eventAddress" => $this->eventAddress,
            "eventDate" => $this->eventDate,
            "discount" => $this->discount,
            "advance" => $this->advance,
            "travelExpenses" => $this->travelExpenses,
            "price" => $this->price,
            "notes" => $this->notes,
            "reminderSendDate" => $this->reminderSendDate,
            "reminderSend" => $this->reminderSend,
            "fullPrice" => $this->fullPrice,
            "balance" => $this->balance,
            "pdfUrl" => $this->pdfUrl,
            "employees" => EmployeesEventDetailResource::collection($this->employees),
            "packages" => PackagesEventDetailResource::collection($this->packages),
            "products" => ProductsEventDetailResource::collection($this->products),
            "equipments" => EquipmentsEventDetailResource::collection($this->equipments)
        ];


    }
}
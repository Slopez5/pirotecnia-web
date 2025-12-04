<?php 

namespace App\Application\Employees\Dashboard\DTO;

use App\Core\Data\Entities\EventType;
use App\Domain\Employees\Dashboard\Entities\Event;
use App\Infraestructure\Persistence\Eloquent\Mappers\ProductMapper;
use Spatie\LaravelData\Data;

use function PHPSTORM_META\map;

class EventDetailsData extends Data{
    public function __construct(
        public int $id,
        public string $eventType,
        public string $date,
        public string $phone,
        public string $clientName,
        public string $clientAddress,
        public string $eventAddress,
        public string $eventDate,
        public string $discount,
        public string $advance,
        public string $travelExpenses,
        public string $price,
        public string $notes,
        public string $reminderSendDate,
        public string $reminderSend,
        public string $fullPrice,
        public string $balance,
        public string $pdfUrl,
        public array $employees,
        public array $packages,
        public array $products,
        public array $equipments
    ) {}

    public static function fromEntity(Event $event): self {
        return new self(
            id: $event->id,
            eventType: $event->eventType,
            date: $event->date,
            phone: $event->phone,
            clientName: $event->clientName,
            clientAddress: $event->clientAddress->street,
            eventAddress: $event->eventAddress->street,
            eventDate: $event->eventDate,
            discount: $event->discount,
            advance: $event->advance,
            travelExpenses: $event->travelExpenses ?? "",
            price: $event->price ?? "",
            notes: $event->notes ?? "",
            reminderSendDate: $event->reminderSendDate ?? "",
            reminderSend: $event->reminderSend ?? "",
            fullPrice: $event->fullPrice ?? "",
            balance: $event->balance ?? "",
            pdfUrl: $event->pdfUrl ?? "",
            employees: array_map(fn ($employee) => EmployeeData::fromEntity($employee), $event->employees),
            packages: array_map(fn ($package) => PackageData::fromEntity($package),$event->packages),
            products: array_map(fn($product) => ProductData::fromEntity($product), $event->getAllProducts()),
            equipments: array_map(fn($equipment) => EquipmentData::fromEntity($equipment),$event->getAllEquipments())
        );
    }

            // "package" => $this->package,
}
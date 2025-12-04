<?php 

namespace App\Application\Employees\Dashboard\DTO;

use App\Domain\Employees\Dashboard\Entities\Event;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class EventData extends Data{
    public function __construct(
        public ?int $id,
        public string $image,
        public string $eventType,
        public string $eventDate,
        public string $eventAddress
    ){}

    public static function fromEntity(Event $event): self {
        $eventData = new self(
            id: $event->id,
            image: $event->image ?? "https://lh3.googleusercontent.com/aida-public/AB6AXuAYYAmY9FQ7jyYtYIkBN79q-b1Cs14APTxs5-ZCC-0_pGHIsoBR07hoPAhhp4jPgB6ZMSUTOyaU4nT62OHE6yKy7WTu-6_7oH-g28gU3xTWSsqKF7pqpfyhHgvWwGPBfB6PccunQuv91AnGabze8lX1ztThdtE0kXO8skLrdCIEwJ2YoTQtccN5J2Nfu9_g-iAMDocifEf40ICFLKdwf-g7OQ7EnTg-nb6iLy1FUWef-vZRpIHYqzXp2McHcKWIhxclniMW43qBfDE",
            eventType: $event->eventType,
            eventDate: $event->eventDate,
            eventAddress: "{$event->eventAddress->street}"
        );
        $eventData->updateFormatDate();
        return $eventData;
    }

    private function updateFormatDate() {
        $this->eventDate  = Carbon::parse($this->eventDate)->format('d/m/Y h:ia');
    }
    
}
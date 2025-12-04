<?php 

namespace  App\Infraestructure\Persistence\Eloquent\Mappers;

use App\Domain\Employees\Dashboard\Entities\Address;
use App\Domain\Employees\Dashboard\Entities\Event;
use App\Infraestructure\Persistence\Eloquent\Mappers\EmployeeMapper;


class EventMapper {
    public static function fromModel(object $model): Event {
        return new Event(
            id: $model->id,
            eventType: $model->typeEvent->name,
            image: $model->image,
            package: "", // momentanamente
            date: $model->date,
            phone: $model->phone,
            clientName: $model->client_name,
            clientAddress: new Address(id: null, street:$model->client_address, neighborhood: "",city: "",state: "",country: "",zipCode: "",location: null),
            eventAddress: new Address(id: null, street:$model->event_address, neighborhood: "",city: "",state: "",country: "",zipCode: "",location: null),
            eventDate: $model->event_date,
            discount: $model->discount,
            advance: $model->advance,
            travelExpenses: $model->travel_expenses,
            price: $model->price,
            notes: $model->notes,
            reminderSendDate: $model->reminder_send_date,
            reminderSend: $model->reminder_send,
            fullPrice: $model->full_price,
            balance: $model->balance,
            pdfUrl: $model->pdf_url,
            employees: array_map(fn($employee) => EmployeeMapper::fromModel($employee), $model->employees->all()),
            packages: array_map(fn($package) => PackageMapper::fromModel($package),$model->packages->all()),
            products: array_map(fn($product) => ProductMapper::fromModel($product), $model->products->all()),
            equipments: array_map(fn($equipment) => EquipmentMapper::fromModel($equipment), $model->equipments->all())
        );
    }
}
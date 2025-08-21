<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de evento</title>
    <style>
        /* Materials table styles */
        #materials_table {
            width: 70%;
            border-collapse: collapse;
        }

        /* column 1 width 2 column 2 width 1 */
        #materials_table th:nth-child(1) {
            width: 90%;
        }

        #materials_table th:nth-child(2) {
            width: 10%;
        }

        #materials_table th {
            background-color: #f2f2f2;
        }

        #materials_table td,
        #materials_table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #materials_table tbody tr {
            text-align: center;
        }

        /* Equipments table styles */
        #equipment_table {
            width: 70%;
            border-collapse: collapse;
        }

        /* column 1 width 2 column 2 width 1 */
        #equipment_table th:nth-child(1) {
            width: 90%;
        }

        #equipment_table th:nth-child(2) {
            width: 10%;
        }

        #equipment_table th {
            background-color: #f2f2f2;
        }

        #equipment_table td,
        #equipment_table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #equipment_table tbody tr {
            text-align: center;
        }
    </style>
</head>

<body>
    {{-- Event Info --}}
    {{--
    Tienes un evento próximamente
    Hola, este es un recordatorio para el evento Aniversario.
    Detalles del evento:
    Fecha: 28/09/2024
    Hora: 17:30
    Lugar: Unidad deportiva Cuauhtemoc
    Responsable: Luis Javier Lopez Ceballos
    Detalles adicionales: Preguntar al encargado los momentos y secuencias de detonación
    --}}
    <h3>Información general</h3>
    <p><strong>Tipo de Evento:</strong> {{ $event->event_type }}</p>
    <p><strong>Teléfono:</strong> {{ $event->phone }}</p>
    <p><strong>Cliente:</strong> {{ $event->client_name }}</p>
    <p><strong>Dirección de cliente:</strong> {{ $event->client_address }}</p>
    <p><strong>Dirección del evento:</strong> {{ $event->event_address }}</p>
    <p><strong>Fecha del evento:</strong> {{ date('j \d\e F \d\e Y \a \l\a\s g:ia', strtotime($event->event_date)) }}
    </p>
    <p><strong>Total de Paquete:</strong> ${{ $event->full_price }}</p>
    @if ($event->discount <= 1)
        <p><strong>Descuento:</strong> ${{ $event->discount * $event->full_price }}</p>
    @else
        <p><strong>Descuento:</strong> ${{ $event->discount }}</p>
    @endif
    <p><strong>Anticipo:</strong> ${{ $event->advance }}</p>
    <p><strong>Saldo:</strong> ${{ $event->balance }}</p>

    @foreach ($event->employees as $index => $employee)
        <p><strong>Responsable {{ $index + 1 }}:</strong> {{ $employee->name }}</p>
    @endforeach
    <p><strong>Detalles adicionales: {{ $event->notes }}</strong></p>


    {{-- Event Materials --}}
    <h3>Materiales del evento</h3>
    <table id="materials_table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Check</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event->products as $material)
                <tr>
                    <td>{{ $material->name }}
                        {{ $material->caliber != '' ? $material->caliber . "''" : '' }}{{ $material->caliber != '' && $material->shots != '' ? 'x' : '' }}{{ $material->shots != '' ? "$material->shots" : '' }}
                        {{ $material->shape }}
                    </td>
                    <td>{{ $material->quantity }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Event equipments --}}
    <h3>Equipo del evento</h3>
    <table id="equipment_table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>check</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event->equipments as $package)

                <tr>
                    <td>{{ $package->name }}</td>
                    <td>{{ $package->quantity }}</td>
                    <td></td>
                </tr>

            @endforeach
        </tbody>
    </table>
</body>

</html>
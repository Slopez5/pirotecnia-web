@extends('templates.adminlte')

@section('extra-css')
    <style>
        .logo-container {
            display: flex;
            align-items: center;
            /* Para centrar verticalmente la imagen dentro de la columna */
            height: 100%;
            /* Asegura que el contenedor tome toda la altura disponible */
        }

        .logo-container img {
            max-height: 100%;
            /* Asegura que la imagen no exceda la altura del contenedor */
            width: auto;
            /* Mantiene la proporción de la imagen */
        }
    </style>
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Evento</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Eventos</a></li>
                        <li class="breadcrumb-item active">Evento</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <x-card title="Información del evento" icon="fas fa-calendar-alt">
                        <x-slot:tools>
                            <a href="{{ route('events.index') }}" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>

                        </x-slot>
                        <x-slot:body>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Fecha:</strong> {{ $event->date }}</p>
                                    <p><strong>Teléfono:</strong> {{ $event->phone }}</p>
                                    <p><strong>Nombre:</strong> {{ $event->client_name }}</p>
                                    <p><strong>Domicilio:</strong> {{ $event->client_address }}</p>
                                    <p><strong>Lugar del evento:</strong> {{ $event->event_address }}</p>
                                    <p><strong>Fecha y hora del evento:</strong> {{ $event->event_date }}</p>
                                    <p><strong>Tipo de evento:</strong> {{ $event->event_type }}</p>
                                    @foreach ($event->employees as $index => $employee)
                                        <p><strong>Responsable {{ $index + 1 }}:</strong> {{ $employee->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                            {{-- send reminder --}}
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('events.send-reminder', $event) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Enviar recordatorio</button>
                                    </form>
                                </div>
                                {{-- Show pdf with event --}}
                                <div class="col">
                                    <a class="btn btn-primary" href="{{ route('showByWhatsapp', $event->id) }}"
                                        class="btn btn-primary">Ver PDF</a>
                                </div>
                        </x-slot>
                    </x-card>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-card title="Materiales" icon="fas fa-boxes">
                        <x-slot:body>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($event->products as $material)
                                            <tr>

                                                <td>{{ $material->name }}
                                                    {{ $material->caliber != '' ? $material->caliber . "''" : '' }}{{ $material->caliber != '' && $material->shots != '' ? 'x' : '' }}{{ $material->shots != '' ? "$material->shots" : '' }}
                                                    {{ $material->shape }} </td>
                                                <td>{{ $material->pivot->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </x-slot>
                    </x-card>
                </div>
                <div class="col-md-6">
                    <x-card title="Equipo" icon="fas fa-tools">
                        <x-slot:body>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Equipo</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($event->equipments as $equipment)
                                            <tr>
                                                <td>{{ $equipment->name }}</td>
                                                <td>{{ $equipment->pivot->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </x-slot>
                    </x-card>

                </div>
            </div>
    </section>
@endsection

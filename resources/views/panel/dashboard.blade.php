@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <x-small-box color="bg-info" number="{{ $evdntsInWeek }}" text="Eventos en la semana" icon="ion ion-bag"
                    url="#" footerText="Mas Información" />
                <!-- ./col -->
                <x-small-box color="bg-success" number="{{ $employees }}" text="Empleados" icon="ion ion-stats-bars"
                    url="#" footerText="Mas Información" />
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <x-card title="Eventos" icon="fas fa-calendar-alt">
                        <x-slot:tools>
                            <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </x-slot>
                        <x-slot:body class="table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Fecha del evento</th>
                                        <th>Paquete</th>
                                        <th>Direccion del evento</th>
                                        <th>Teléfono</th>
                                        <th>Encargado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            {{-- Fecha del evento en formato dia mes año  Miercoles 25 de Febrero de 2025 8:00pm idioma español --}}
                                            <td>{{ Carbon\Carbon::parse($event->event_date)->locale('es')->isoFormat('dddd D/M/YYYY h:mma') }}
                                            </td>
                                            {{-- <td>{{ $event->event_date }}</td> --}}
                                            <td>{{ $event->package->name }}</td>
                                            <td>{{ $event->event_address }}</td>
                                            <td>{{ $event->phone }}</td>
                                            @if ($event->employees->count() > 1)
                                                <td>{{ $event->employees->first()->name }}</td>
                                            @else
                                                <td>N/A</td>
                                            @endif

                                            <td>
                                                <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">
                                                    <i
                                                        class="fas fa-eye
                                                "></i>
                                                </a>
                                                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">
                                                    <i
                                                        class="fas fa-edit
                                                "></i>
                                                </a>
                                                <form action="{{ route('events.destroy', $event) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <i
                                                            class="fas fa-trash
                                                    "></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </x-slot>
                    </x-card>
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Eventos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Eventos</li>
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
                <x-small-box color="bg-info" number="150" text="Nuevos pedidos" icon="ion ion-bag" url="#"
                    footerText="Más información" />
                <!-- ./col -->
                <x-small-box color="bg-success" number="53" text="Tasa de rebote" icon="ion ion-stats-bars"
                    url="#" footerText="Más información" />
                <!-- ./col -->
                <x-small-box color="bg-warning" number="44" text="Registros de usuario" icon="ion ion-person-add"
                    url="#" footerText="Más información" />
                <!-- ./col -->
                <x-small-box color="bg-danger" number="65" text="Visitantes únicos" icon="ion ion-pie-graph"
                    url="#" footerText="Más información" />
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <section class="col-lg-6">
                    <x-card title="Calendario" icon="fas fa-calendar-alt">
                        <x-slot:tools>
                            <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </x-slot>
                        <x-slot:body>
                            <div id="calendar"></div>
                        </x-slot>
                    </x-card>


                </section>
                <section class="col-lg-6">
                    {{-- <x-card title="Eventos" icon="fas fa-calendar-alt">
                        <x-slot:tools>
                            <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </x-slot>
                        <x-slot:body class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Paquete</th>
                                        <th>Fecha</th>
                                        <th>Teléfono</th>
                                        <th>Cliente</th>
                                        <th>Dirección</th>
                                        <th>Dirección del evento</th>
                                        <th>Fecha del evento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->package->name }}</td>
                                            <td>{{ $event->date }}</td>
                                            <td>{{ $event->phone }}</td>
                                            <td>{{ $event->client_name }}</td>
                                            <td>{{ $event->client_address }}</td>
                                            <td>{{ $event->event_address }}</td>
                                            <td>{{ $event->event_date }}</td>
                                            <td>
                                                <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="deleteForm-{{ $event->id }}"
                                                    action="{{ route('events.destroy', $event) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        onclick="confirmDelete({{ $event->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </x-slot>
                    </x-card> --}}
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('control-sidebar')
    {{-- Filtro de eventos --}}
    <div class="p-3">
        <h5>Filtro</h5>
        <div class="form-group">
            <label for="package">Paquete</label>
            <select class="form-control" id="package">
                <option value="">Seleccione un paquete</option>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" id="date" placeholder="Fecha">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" placeholder="Teléfono">
        </div>
        <div class="form-group">
            <label for="client_name">Cliente</label>
            <input type="text" class="form-control" id="client_name" placeholder="Cliente">
        </div>
        <div class="form-group">
            <label for="client_address">Dirección</label>
            <input type="text" class="form-control" id="client_address" placeholder="Dirección">
        </div>
        <div class="form-group">
            <label for="event_address">Dirección del evento</label>
            <input type="text" class="form-control" id="event_address" placeholder="Dirección del evento">
        </div>
        <div class="form-group">
            <label for="event_date">Fecha del evento</label>
            <input type="date" class="form-control" id="event_date" value="{{ date('Y-m-d') }}"
                placeholder="Fecha del evento">
        </div>
        <button class="btn btn-primary">Filtrar</button>
    </div>
@endsection


@section('extra-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                events: [
                    @foreach ($events as $event)
                        {
                            id: '{{ $event->id }}',
                            title: '{{ $event->package->name }} - {{ $event->event_address }}',
                            start: '{{ $event->event_date }}',
                            url: '{{ route('events.show', $event) }}'
                        },
                    @endforeach
                ],
                dateClick: function(info) {
                   console.log(info);
                }
            });
            calendar.render();
        });

        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            })
        }
    </script>
@endsection

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
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Eventos</a></li>
                        <li class="breadcrumb-item active">Crear Evento</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <x-card title="Crear Evento" icon="fas fa-calendar-plus">
                        <x-slot:body class="table-responsive">
                            <form action="{{ route('events.store') }}" method="POST">
                                @csrf
                                {{-- Date --}}
                                <div class="form-group">
                                    <label for="date">Fecha</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                                {{-- Phone --}}
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input type="text" name="phone" id="phone" class="form-control">
                                </div>
                                {{-- client name --}}
                                <div class="form-group">
                                    <label for="client_name">Nombre del cliente</label>
                                    <input type="text" name="client_name" id="client_name" class="form-control">
                                </div>
                                {{-- Client Address --}}
                                <div class="form-group">
                                    <label for="client_address">Dirección del cliente</label>
                                    <input type="text" name="client_address" id="client_address" class="form-control">
                                </div>
                                {{-- Event Address --}}
                                <div class="form-group">
                                    <label for="event_address">Dirección del evento</label>
                                    <input type="text" name="event_address" id="event_address" class="form-control">
                                </div>
                                {{-- Event DateTime --}}
                                <div class="form-group">
                                    <label for="event_datetime">Fecha y hora del evento</label>
                                    <input type="datetime-local" name="event_datetime" id="event_datetime" class="form-control">
                                </div>
                                {{-- Event Type --}}
                                <div class="form-group">
                                    <label for="event_type">Tipo de evento</label>
                                    <select name="event_type" id="event_type" class="form-control">
                                        <option value="Boda">Boda</option>
                                        <option value="XV años">XV años</option>
                                        <option value="Bautizo">Bautizo</option>
                                        <option value="Primera Comunión">Primera Comunión</option>
                                        <option value="Cumpleaños">Cumpleaños</option>
                                        <option value="Aniversario">Aniversario</option>
                                        <option value="Graduación">Graduación</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                {{-- Package --}}
                                <div class="form-group">
                                    <label for="package_id">Paquete</label>
                                    <select name="package_id" id="package_id" class="form-control">
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Button --}}
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </x-slot:body>
                    </x-card>
                </section>
            </div>
        </div>
    </section>
@endsection
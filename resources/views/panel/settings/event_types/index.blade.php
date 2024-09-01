@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tipos de eventos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Tipos de eventos</li>
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
                    <x-card title="Tipos de eventos" icon="fas fa-calendar-alt">
                        <x-slot:tools>
                            <a href="{{ route('event_types.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </x-slot>
                        <x-slot:body class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-8">Nombre</th>
                                        <th class="col-2">Precio</th>
                                        <th class="col-2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventTypes as $event_type)
                                        <tr>
                                            <td>{{ $event_type->name }}</td>
                                            <td>{{ $event_type->price }}</td>
                                            <td>
                                                <a href="{{ route('event_types.show', $event_type) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('event_types.edit', $event_type) }}"
                                                    class="btn btn-warning btn-sm" onclick="editEventType()">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="deleteForm-{{ $event_type->id }}"
                                                    action="{{ route('event_types.destroy', $event_type) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="deleteEventType({{ $event_type->id }})">
                                                        <i class="fas fa-trash"></i>
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
            </div>
        </div>
    </section>
@endsection

    
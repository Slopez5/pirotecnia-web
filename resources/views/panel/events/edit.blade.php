@extends('templates.adminlte')

@section('extra-css')

@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Editar Evento</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Eventos</a></li>
                        <li class="breadcrumb-item active">Editar Evento</li>
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
                    <x-card title="Editar Evento" icon="fas fa-calendar-edit">
                        <x-slot:body class="table-responsive">
                            <livewire:panel.events.event-form :event="$event" />
                        </x-slot:body>
                    </x-card>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('extra-script')

@endsection

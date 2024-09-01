@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Crear tipo de evento</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('settings.event_types.index') }}">Tipos de eventos</a></li>
                        <li class="breadcrumb-item active">Crear tipo de evento</li>
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
                    <x-card title="Crear tipo de evento" icon="fas fa-calendar-alt">
                        <x-slot:tools>
                            <a href="{{ route('settings.event_types.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-reply"></i>
                            </a>
                        </x-slot>
                        <x-slot:body>
                            <form action="{{ route('event_types.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </x-slot>
                    </x-card>
                </section>
            </div>
        </div>
    </section>
@endsection

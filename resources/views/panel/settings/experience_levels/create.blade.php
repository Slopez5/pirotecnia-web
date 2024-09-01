@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Crear nivel de experiencia</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('settings.experience-levels.index') }}">Niveles de experiencia</a></li>
                        <li class="breadcrumb-item active">Crear nivel de experiencia</li>
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
                <div class="col-md-12">
                    <x-card title="Crear nivel de experiencia" icon="fas fa-box">
                        <x-slot:tools>
                            <a href="{{ route('settings.experience-levels.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-reply"></i>
                            </a>
                        </x-slot>
                        <x-slot:body>
                            <form action="{{ route('experience-levels.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea name="description" id="description"
                                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </div>
    </section>
@endsection

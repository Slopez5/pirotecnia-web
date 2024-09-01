@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="content-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Crear Empleado</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Empleados</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <x-card title="Crear Empleado" icon="fas fa-user-plus">
                    <x-slot name="tools">
                        <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-reply"></i>
                        </a>
                    </x-slot>
                    <x-slot name="body">
                        <form action="{{ route('employees.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="salary">Salario</label>
                                <input type="text" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}">
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="photo">Foto</label>
                                <input type="file" name="photo" id="photo" class="form-control-file @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="experience_level">Nivel de Experiencia</label>
                                <select name="experience_level" id="experience_level" class="form-control @error('experience_level') is-invalid @enderror">
                                    <option value="">Seleccione...</option>
                                    @foreach ( $experienceLevels as $experienceLevel )
                                        <option value="{{ $experienceLevel->id }}">{{ $experienceLevel->name }}</option>
                                    @endforeach
                                </select>
                                @error('experience_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </x-slot>
                </x-card>
            </div>
        </div>
    </div>
@endsection


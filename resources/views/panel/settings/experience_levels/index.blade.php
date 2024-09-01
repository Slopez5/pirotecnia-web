@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Niveles de experiencia</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Niveles de experiencia</li>
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
                    <x-card title="Niveles de experiencia" icon="fas fa-box">
                        <x-slot:tools>
                            <a href="{{ route('experience-levels.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </x-slot>
                        <x-slot:body class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-8">Nombre</th>
                                        <th class="col-2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($experienceLevels as $experience_level)
                                        <tr>
                                            <td>{{ $experience_level->name }}</td>
                                            <td>
                                                <a href="{{ route('experience-levels.show', $experience_level) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('experience-levels.edit', $experience_level) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('experience-levels.destroy', $experience_level) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
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

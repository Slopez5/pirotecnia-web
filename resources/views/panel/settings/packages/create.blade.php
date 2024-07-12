@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Paquetes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Paquetes</li>
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
                    <x-card title="Crear Paquete" icon="fas fa-box">
                        <x-slot:body class="table-responsive">
                            <form action="{{ route('packages.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Precio</label>
                                    <input type="text" name="price" id="price" class="form-control">
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
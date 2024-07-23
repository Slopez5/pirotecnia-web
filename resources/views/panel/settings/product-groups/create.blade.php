@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Productos(Modo cliente)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Productos(modo cliente)</li>
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
                    <x-card title="Productos (Modo cliente)" icon="fas fa-box">
                        <x-slot:body>
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('product-groups.store') }}" method="POST">
                                        @csrf
                                        {{-- Name --}}
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                        {{-- Description --}}
                                        <div class="form-group">
                                            <label for="description">Descripción</label>
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                        {{-- Unit --}}
                                        <div class="form-group">
                                            <label for="unit">Unidad</label>
                                            <input type="text" name="unit" id="unit" class="form-control">
                                        </div>
                                        {{-- Submit Button --}}
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                </section>
            </div>
        </div>
    </section>
@endsection

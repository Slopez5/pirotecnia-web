@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Productos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('settings.products.index') }}">Productos</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
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
                    <x-card title="{{ $product->name }}" icon="fas fa-box">
                        <x-slot:tools>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </x-slot>
                        <x-slot:body class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th class="col-2">Nombre</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-2">Descripción</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-2">Unidad</th>
                                        <td>{{ $product->unit }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </x-slot:body>
                    </x-card>
                </section>

                <section class="col-lg-12 connectedSortable">
                    <livewire:panel.settings.products.show.products-table :product="$product" />
                </section>

            </div>
        </div>
    </section>
@endsection
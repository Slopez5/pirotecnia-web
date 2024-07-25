@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $package->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">{{ $package->name }}</li>
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
                <div class="col-6">
                    <x-card title="{{ $package->name }}" icon="fas fa-box">
                        <x-slot:tools>
                            <a href="{{ route('packages.edit', $package) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </x-slot>
                        <x-slot:footer>
                            <a href="{{ route('settings.packages.index') }}" class="btn btn-primary">Regresar</a>
                        </x-slot>
                        <x-slot:body>

                            <div class="row">
                                <div class="col-12">
                                    <p><strong>Nombre:</strong> {{ $package->name }}</p>
                                    <p><strong>Descripción:</strong> {{ $package->description }}</p>
                                    <p><strong>Precio:</strong> {{ $package->price }}</p>
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <livewire:panel.settings.packages.show.product-groups-table :package="$package" />
                    <livewire:panel.settings.packages.show.products-table :package="$package" />
                </div>
                <div class="col-md-6">
                    <livewire:panel.settings.packages.show.equipaments-table :package="$package" />
                </div>
            </div>
        </div>
    </section>
@endsection

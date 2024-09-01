@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col align-self-end">
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
                <div class="col-12">
                    <div class="text-center">
                        <h1>{{ $package->name }}</h1>
                    </div>
                </div>
            </div>

            {{--  Carousel with $package->video_url example:https://photos.app.goo.gl/Y5A15bTHg e55fodG7 --}}
            {{-- <div class="row">
                <div class="col-12">
                    <div class="text-center">

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                   
                                    <iframe src="https://drive.google.com/file/d/1Ka5yYa3gC1eiDqfvuWhJTT1f7vRiU8Ca/preview"
                                        width="640" height="480" allow="autoplay"></iframe>
                                </div>
                            </div>
                           <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a> 
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- Nombre --}}
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Nombre:</strong> {{ $package->name }}
                    </p>
                </div>
            </div>

            {{-- Descripción --}}
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Descripción:</strong> {{ $package->description }}
                    </p>
                </div>
            </div>

            {{-- Precio --}}
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Precio:</strong> {{ $package->price }}
                    </p>
                </div>
            </div>

            {{-- Duración --}}
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Duración:</strong> {{ $package->duration }}
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg">
                    <x-panel.settings.packages.show.materials-table :materials="$package->materials" />
                </div>
                <div class="col-lg">
                    <x-panel.settings.packages.show.equipment-table :equipments="$package->equipments" />
                </div>
            </div>
        </div>
    </section>
@endsection



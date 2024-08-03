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
                        <li class="breadcrumb-item active">Editar Producto</li>
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
                <section class="col-lg-12 connectedSortable">
                    <x-card title="Crear Producto" icon="fas fa-box">
                        <x-slot:body class="table-responsive">
                            <form action="{{ route('products.update', $product) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $product->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Duración</label>
                                    <input type="text" name="duration" id="duration" class="form-control"
                                        value="{{ $product->duration }}">
                                </div>
                                <div class="form-group">
                                    <label for="shots">Disparos</label>
                                    <input type="text" name="shots" id="shots" class="form-control"
                                        value="{{ $product->shots }}">
                                </div>
                                <div class="form-group">
                                    <label for="caliber">Calibre</label>
                                    <input type="text" name="caliber" id="caliber" class="form-control"
                                        value="{{ $product->caliber }}">
                                </div>
                                <div class="form-group">
                                    <label for="unit">Unidad</label>
                                    <input type="text" name="unit" id="unit" class="form-control"
                                        value="{{ $product->unit }}">
                                </div>
                                {{-- Button --}}
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </x-slot:body>
                    </x-card>
                </section>
            </div>
        </div>
    </section>
@endsection

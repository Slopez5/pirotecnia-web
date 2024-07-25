@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Compras</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Compras</li>
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
                    <x-card title="Compras" icon="fas fa-shopping-cart">
                        <x-slot:body>
                            <form action="{{ route('purchases.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_id">Producto</label>
                                        <select name="product_id" id="product_id" class="form-control" required>
                                            <option value="">Seleccione un producto</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Cantidad</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control"
                                            placeholder="Cantidad de productos" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="number" name="total" id="total" class="form-control"
                                            placeholder="Total de la compra" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </x-slot>
                    </x-card>
                </section>
            </div>
        </div>
    </section>
@endsection
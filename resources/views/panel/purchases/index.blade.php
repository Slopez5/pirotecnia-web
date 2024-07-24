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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <x-small-box color="bg-info" number="150" text="Nuevos pedidos" icon="ion ion-bag" url="#"
                    footerText="Más información" />
                <!-- ./col -->
                <x-small-box color="bg-success" number="53" text="Tasa de rebote" icon="ion ion-stats-bars"
                    url="#" footerText="Más información" />
                <!-- ./col -->
                <x-small-box color="bg-warning" number="44" text="Registros de usuario" icon="ion ion-person-add"
                    url="#" footerText="Más información" />
                <!-- ./col -->
                <x-small-box color="bg-danger" number="65" text="Visitantes únicos" icon="ion ion-pie-graph"
                    url="#" footerText="Más información" />
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <x-card title="Compras" icon="fas fa-shopping-cart">
                        <x-slot:tools>
                            {{-- Search --}}
                            <div class="row">
                                <div class="col">

                                    <form action="{{ route('purchases.index') }}" method="GET"
                                        class="form-inline">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control form-control-navbar" type="search" name="search"
                                                placeholder="Buscar" aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </x-slot>
                        <x-slot:body class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->created_at }}</td>
                                            <td>
                                                <a href="{{ route('purchases.show', $purchase) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('purchases.edit', $purchase) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('purchases.destroy', $purchase) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">
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
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

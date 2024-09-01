@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inventario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Inventario</li>
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
                    <x-card title="Inventario" icon="fas fa-boxes">
                        <x-slot:tools>

                            <a href="{{ route('inventory.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>

                        </x-slot>
                        <x-slot:body class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-4">Nombre</th>
                                        <th class="col-1">Stock</th>
                                        <th class="col-1">Price</th>
                                        @foreach ($clientTypes as $clientType)
                                            <th class="col-1">{{ $clientType->name }}</th>
                                        @endforeach
                                        <th class="col-2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->name }} {{ $item->caliber != '' ? $item->caliber . "''" : '' }}{{ $item->caliber != '' && $item->shots != '' ? 'x' : '' }}{{ $item->shots != '' ? "$item->shots" : '' }} {{ $item->shape}}
                                            </td>
                                            <td>{{ $item->pivot->quantity }}</td>
                                            <td>${{ number_format($item->pivot->price, 2) }}</td>
                                            @foreach ($clientTypes as $clientType)
                                                {{-- Format price $x,xxx.xx --}}
                                                <td>${{ number_format($item->pivot->price * $clientType->percentage_price, 2) }}
                                                </td>
                                            @endforeach
                                            <td class="col-2">
                                                <a href="{{ route('inventory.edit', $item) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('inventory.destroy', $item) }}" method="POST"
                                                    style="display: inline">
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

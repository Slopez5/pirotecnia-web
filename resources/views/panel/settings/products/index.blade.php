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
                        <li class="breadcrumb-item active">Productos</li>
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
                    <x-card title="Productos" icon="fas fa-box">
                        <x-slot:tools>
                            {{-- Button to import data --}}
                            <a href="{{ route('products.import') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-file-import"></i>
                            </a>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                        </x-slot>
                        <x-slot:body class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-4">Nombre</th>
                                        <th class="col-2">Duración</th>
                                        <th class="col-1">Disparos</th>
                                        <th class="col-1">Calibre</th>
                                        <th class="col-1">stock</th>
                                        <th class="col-1">Precio</th>
                                        <th class="col-2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->duration }}</td>
                                            <td>{{ $product->shots }}</td>
                                            <td>{{ $product->caliber }}</td>
                                            <td>
                                                @if($product->inventories->first() != null)
                                                    {{ $product->inventories->first()->pivot->quantity }}
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Format $x,xxx.xx --}}
                                                @if($product->inventories->first() != null)
                                                ${{ number_format($product->inventories->first()->pivot->price, 2) }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="deleteForm-{{ $product->id }}"
                                                    action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                        onclick="confirmDelete({{ $product->id }})">
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


@section('extra-script')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            })
        }
    </script>
@endsection

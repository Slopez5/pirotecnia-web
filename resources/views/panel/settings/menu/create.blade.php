@extends('templates.adminlte')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Crear Menu Item</h3>
            </div>
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" name="url" class="form-control" id="url" placeholder="URL">
                    </div>
                    <div class="form-group">
                        <label for="icon">Icono</label>
                        <input type="text" name="icon" class="form-control" id="icon" placeholder="Icono">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Menu Padre</label>
                        <select name="parent_id" class="form-control" id="parent_id">
                            <option value="">Ninguno</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Activo</label>
                        <select name="is_active" class="form-control" id="is_active">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('templates.adminlte')

@section('content-header')
@endsection

@section('main-content')
    <livewire:panel.settings.packages.package-builder :package="$package" />
@endsection

@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Paquetes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Paquetes</li>
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
                <section class="col-lg-12">
                    <x-card class="card-tabs">
                        <x-slot:header>
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="packages-tab" data-toggle="pill" href="#packages"
                                        role="tab" aria-controls="packages" aria-selected="true"
                                        onclick="setActiveTab('packages')">Paquete</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="materials-tab" data-toggle="pill" href="#materials"
                                        role="tab" aria-controls="materials" aria-selected="false"
                                        onclick="setActiveTab('materials')">Materiales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="equipments-tab" data-toggle="pill" href="#equipments"
                                        role="tab" aria-controls="equipments" aria-selected="false"
                                        onclick="setActiveTab('equipments')">Equipo</a>
                                </li>
                            </ul>
                        </x-slot:header>
                        <x-slot:body class="table-responsive">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="packages" role="tabpanel"
                                    aria-labelledby="packages-tab">
                                    {{-- Form to edit package --}}
                                    <livewire:panel.settings.packages.package-form :package="$package">
                                </div>
                                <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab">
                                    {{-- Form to add materials to package --}}
                                    <livewire:panel.settings.packages.material-in-package-form :package="$package">
                                </div>
                                <div class="tab-pane fade" id="equipments" role="tabpanel"
                                    aria-labelledby="equipments-tab">
                                    {{-- Form to add equipments to package --}}
                                    <livewire:panel.settings.packages.equipment-in-package-form :package="$package">
                                </div>
                            </div>
                        </x-slot:body>
                    </x-card>
                </section>
            </div>
        </div>
    </section>
@endsection


@section('extra-script')
    <script>
        function setActiveTab(tab) {
            localStorage.setItem('activeTab', tab);
        }

        document.addEventListener('DOMContentLoaded', function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#custom-tabs-two-tab a[href="#' + activeTab + '"]').tab('show');
                
            }
        });
    </script>
@endsection

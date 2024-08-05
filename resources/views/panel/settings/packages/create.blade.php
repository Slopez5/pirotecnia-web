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
                                    <a class="nav-link disabled" id="materials-tab" data-toggle="pill" href="#materials"
                                        role="tab" aria-controls="materials" aria-selected="false"
                                        onclick="setActiveTab('materials')">Materiales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="equipaments-tab" data-toggle="pill" href="#equipaments"
                                        role="tab" aria-controls="equipaments" aria-selected="false"
                                        onclick="setActiveTab('equipaments')">Equipo</a>
                                </li>
                            </ul>
                        </x-slot:header>
                        <x-slot:body class="table-responsive">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="packages" role="tabpanel"
                                    aria-labelledby="packages-tab">
                                    {{-- Form to edit package --}}
                                    <livewire:panel.settings.packages.package-form>
                                </div>
                                <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab">
                                    {{-- Form to add materials to package --}}
                                    <livewire:panel.settings.packages.material-in-package-form>
                                </div>
                                <div class="tab-pane fade" id="equipaments" role="tabpanel"
                                    aria-labelledby="equipaments-tab">
                                    {{-- Form to add equipaments to package --}}
                                    <livewire:panel.settings.packages.equipament-in-package-form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            const maxLines = 5;
            const maxChars = 2000; // Set your character limit here
            const lineHeight = parseFloat(getComputedStyle(textarea).lineHeight);
            const maxHeight = lineHeight * maxLines;

            textarea.addEventListener('input', function() {
                // Truncate text if it exceeds the character limit
                if (this.value.length > maxChars) {
                    this.value = this.value.substring(0, maxChars);
                }
                // Adjust height
                this.style.height = 'auto';
                if (this.scrollHeight > maxHeight) {
                    this.style.height = maxHeight + 'px';
                } else {
                    this.style.height = (this.scrollHeight) + 'px';
                }

                // Update character count
                const currentLength = this.value.length;
                charCount.textContent = `${currentLength}/${maxChars} caracteres`;
            });

            // Initial adjustment for pre-existing content, if any
            if (textarea.scrollHeight > maxHeight) {
                textarea.style.height = maxHeight + 'px';
            } else {
                textarea.style.height = 'auto';
                textarea.style.height = (textarea.scrollHeight) + 'px';
            }

            // Initial character count update
            charCount.textContent = `${textarea.value.length}/${maxChars} caracteres`;
        });


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

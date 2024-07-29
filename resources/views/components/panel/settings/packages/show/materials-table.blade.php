<x-card title="Materiales" icon="fas fa-box">
    <x-slot:body class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>

                    <th class="col-4">Descripción</th>
                    <th class="col-1">Cantidad</th>
                    <th class="col-1">Unidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $idnex => $material)
                    <tr wire:key="{{ $material->id }}">
                        <td>
                            {{ $material->name }}

                        </td>
                        <td>
                         
                                {{ $material->pivot->quantity }}
                            
                        </td>
                        <td>
                            {{ $material->unit }}

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-card>

<x-card title="Equipo" icon="fas fa-box">
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
                @foreach ($equipaments as $index => $equipament)
                    <tr wire:key="{{ $equipament->id }}">
                        <td>
                            {{ $equipament->name }}
                        </td>
                        <td>
                            {{ $equipament->pivot->quantity }}

                        </td>
                        <td>
                            {{ $equipament->unit }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-card>

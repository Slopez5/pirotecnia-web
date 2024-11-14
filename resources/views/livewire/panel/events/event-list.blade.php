<div>
    <table class="table table-bordered table-hover text-nowrap">
        <thead>
            <tr>
                <th>Paquete</th>
                <th>Fecha del evento</th>
                <th>Dirección del evento</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->package->name }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{{ $event->event_address }}</td>
                    <td>{{ $event->phone }}</td>                    
                    <td>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form id="deleteForm-{{ $event->id }}" action="{{ route('events.destroy', $event) }}"
                            method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="button"
                                onclick="confirmDelete({{ $event->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

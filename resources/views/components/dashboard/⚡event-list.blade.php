<?php

use Livewire\Component;

new class extends Component {
    public array $events = [];
};
?>

<div>
    @php
        $statusColorMap = [
            'secondary' => ['dot' => 'bg-secondary', 'text' => 'text-secondary'],
            'accent' => ['dot' => 'bg-accent', 'text' => 'text-accent'],
            'warning' => ['dot' => 'bg-warning', 'text' => 'text-warning'],
            'error' => ['dot' => 'bg-error', 'text' => 'text-error'],
        ];
    @endphp

    @if (count($events) === 0)
        <div class="px-6 pb-8">
            <div class="rounded-2xl bg-primary-700/70 p-6 text-center">
                <p class="text-sm font-semibold text-on-primary">No hay eventos próximos registrados</p>
                <p class="mt-2 text-xs text-primary-200">La tabla se actualizará cuando existan nuevas contrataciones en agenda.</p>
            </div>
        </div>
    @else
        <table class="w-full text-left border-separate border-spacing-y-2 px-6 pb-6">
            <thead>
                <tr class="text-primary-200 uppercase text-[10px] tracking-widest font-bold">
                    <th class="pb-4 pl-4">Fecha</th>
                    <th class="pb-4">Cliente</th>
                    <th class="pb-4">Tipo</th>
                    <th class="pb-4">Estado</th>
                    <th class="pb-4 pr-4 text-right">Monto</th>
                </tr>
            </thead>
            <tbody class="space-y-2">
                @foreach ($events as $event)
                    @php
                        $statusClasses = $statusColorMap[$event['statusColor'] ?? 'secondary'] ?? $statusColorMap['secondary'];
                    @endphp
                    <tr class="group hover:bg-primary-700/60 transition-colors">
                        <td class="py-4 pl-4 rounded-l-xl bg-primary-700/70 group-hover:bg-transparent">
                            <div class="flex flex-col">
                                <span class="text-on-primary font-semibold">{{ $event['month'] }} {{ $event['day'] }}</span>
                                <span class="text-xs text-primary-200">{{ $event['year'] }}</span>
                            </div>
                        </td>
                        <td class="py-4 bg-primary-700/70 group-hover:bg-transparent">
                            <span class="text-on-primary font-medium">{{ $event['client'] }}</span>
                        </td>
                        <td class="py-4 bg-primary-700/70 group-hover:bg-transparent">
                            <span
                                class="px-2 py-1 rounded bg-accent/10 text-accent text-xs font-bold uppercase tracking-tighter">{{ $event['type'] }}</span>
                        </td>
                        <td class="py-4 bg-primary-700/70 group-hover:bg-transparent">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ $statusClasses['dot'] }}"></span>
                                <span class="text-sm {{ $statusClasses['text'] }}">{{ $event['status'] }}</span>
                            </div>
                        </td>
                        <td class="py-4 pr-4 rounded-r-xl bg-primary-700/70 group-hover:bg-transparent text-right">
                            <span class="text-on-primary font-bold">{{ $event['price'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<?php

use Livewire\Component;

new class extends Component {
    public string $type = 'line';
    public array $series = [];
    public array $segments = [];
    public string $centerLabel = 'Total';
    public string $emptyMessage = 'Sin datos para mostrar';
};
?>


<div>
    @php
        $colorVariables = [
            'primary' => 'var(--color-primary)',
            'accent' => 'var(--color-accent)',
            'secondary' => 'var(--color-secondary)',
            'warning' => 'var(--color-warning)',
        ];

        $dotClasses = [
            'primary' => 'bg-primary',
            'accent' => 'bg-accent',
            'secondary' => 'bg-secondary',
            'warning' => 'bg-warning',
        ];
    @endphp

    @if ($type == 'line')
        @php
            $maxValue = collect($series)->max('value') ?: 0;
        @endphp

        @if (count($series) === 0 || $maxValue <= 0)
            <div class="flex h-64 items-center justify-center rounded-2xl bg-primary-700/40 text-sm text-primary-200">
                {{ $emptyMessage }}
            </div>
        @else
            <div class="h-64 flex items-end justify-between gap-2 px-2">
                @foreach ($series as $point)
                    @php
                        $value = (float) ($point['value'] ?? 0);
                        $height = $value > 0 ? max(14, round(($value / $maxValue) * 100)) : 8;
                        $isCurrent = $point['isCurrent'] ?? false;
                    @endphp
                    <div class="flex flex-1 flex-col items-center gap-3">
                        <div class="relative flex h-56 w-full items-end">
                            <div
                                class="group relative w-full rounded-t-lg transition-colors {{ $isCurrent ? 'bg-primary/50 border-t-2 border-primary' : 'bg-primary-700/70 hover:bg-primary/20' }}"
                                style="height: {{ $height }}%">
                                <div
                                    class="pointer-events-none absolute bottom-full left-1/2 mb-2 -translate-x-1/2 rounded bg-primary px-2 py-1 text-[10px] whitespace-nowrap text-on-primary opacity-0 transition-opacity group-hover:opacity-100">
                                    {{ $point['label'] }} · {{ $point['formatted'] ?? '' }}
                                </div>
                            </div>
                        </div>
                        <span class="text-[10px] font-semibold uppercase tracking-[0.18em] text-primary-200">{{ $point['label'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

    @if ($type == 'dona')
        @php
            $total = collect($segments)->sum('value');
            $start = 0;
            $gradientStops = [];

            foreach ($segments as $segment) {
                $value = (float) ($segment['value'] ?? 0);
                $percentage = $total > 0 ? ($value / $total) * 100 : 0;
                $end = $start + $percentage;
                $gradientStops[] = ($colorVariables[$segment['color'] ?? 'primary'] ?? $colorVariables['primary'])." {$start}% {$end}%";
                $start = $end;
            }

            $gradient = implode(', ', $gradientStops);
        @endphp

        @if ($total <= 0)
            <div class="flex h-full min-h-64 items-center justify-center rounded-2xl bg-primary-700/40 text-sm text-primary-200">
                {{ $emptyMessage }}
            </div>
        @else
            <div class="flex-1 flex flex-col justify-center items-center relative">
                <div class="relative flex items-center justify-center">
                    <div class="h-40 w-40 rounded-full" style="background: conic-gradient({{ $gradient }});"></div>
                    <div class="absolute h-24 w-24 rounded-full bg-primary-800"></div>
                    <div class="absolute text-center">
                        <span class="text-2xl font-extrabold text-on-primary">{{ $total }}</span>
                        <p class="text-[10px] text-primary-200 uppercase">{{ $centerLabel }}</p>
                    </div>
                </div>
                <div class="w-full mt-8 space-y-3">
                    @foreach ($segments as $segment)
                        @php
                            $percentage = $total > 0 ? round(((float) $segment['value'] / $total) * 100) : 0;
                            $dotClass = $dotClasses[$segment['color'] ?? 'primary'] ?? $dotClasses['primary'];
                        @endphp
                        <div class="flex justify-between items-center text-sm">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ $dotClass }}"></span>
                                <span class="text-primary-200">{{ $segment['label'] }}</span>
                            </div>
                            <span class="font-semibold text-on-primary">{{ $percentage }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>

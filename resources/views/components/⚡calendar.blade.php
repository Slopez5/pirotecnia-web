<?php

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Livewire\Component;

new class extends Component {
    public int $month;
    public int $year;
    public ?string $selectedDate = null;
    public string $monthLabel = '';
    public array $weekDays = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
    public array $days = [];
    public array $eventDates = [
        '2026-04-04' => 'blocked',
        '2026-04-06' => 'warning',
        '2026-04-11' => 'selected',
    ];

    public function mount(): void
    {
        $this->buildCalendar();
    }

    public function selectDate(string $day): void
    {
        $this->selectedDate = $day;

        $this->dispatch('select-date', $day);
    }

    protected function buildCalendar(): void
    {
        $currentMonth = Carbon::create('2026', '4', 1)->locale('es_MX');
        $start = $currentMonth->copy()->startOfMonth()->startOfWeek(CarbonInterface::SUNDAY);
        $end = $currentMonth->copy()->endOfMonth()->endOfWeek(CarbonInterface::SATURDAY);

        $this->monthLabel = ucfirst($currentMonth->translatedFormat('F Y'));
        $this->days = [];

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $this->days[] = [
                'statusDate' => $this->eventDates[$date->format('Y-m-d')] ?? 'available',
                'date' => $date->toDateString(),
                'day' => $date->day,
                'outside' => !$date->isSameMonth($currentMonth),
                'today' => $date->isToday(),
            ];
        }
    }
};
?>

@php
    $statusClasses = [
        'available' => 'border border-primary-700/70 bg-primary-900/35 text-on-primary hover:border-accent hover:bg-primary-700/70',
        'warning' => 'border border-warning/60 bg-warning/20 text-on-primary hover:bg-warning/25',
        'blocked' => 'border border-secondary/60 bg-secondary/20 text-on-primary hover:bg-secondary/25',
        'selected' => 'border border-accent bg-accent text-on-accent',
    ];
@endphp

<div class="lg:col-span-2 rounded-[2rem] border border-primary-700/60 bg-primary-900 p-6 text-on-primary shadow-card md:p-8">
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.32em] text-primary-200">Agenda</p>
                <h3 class="mt-2 font-heading text-3xl font-bold text-on-primary">{{ $monthLabel }}</h3>
            </div>
            <div class="flex gap-1 rounded-full bg-on-primary/10 p-1">
                <button class="rounded-full p-2 text-primary-100 transition hover:bg-on-primary/10 hover:text-on-primary" type="button">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="rounded-full p-2 text-primary-100 transition hover:bg-on-primary/10 hover:text-on-primary" type="button">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>

        <button class="inline-flex items-center justify-center rounded-full border border-primary-700/70 px-4 py-2 text-sm font-bold text-primary-100 transition hover:bg-on-primary/10 hover:text-on-primary"
            type="button">
            Hoy
        </button>
    </div>

    <div class="mb-3 grid grid-cols-7 gap-2">
        @foreach ($weekDays as $weekDay)
            <div class="py-2 text-center text-[11px] font-bold uppercase tracking-[0.22em] text-primary-200">
                {{ $weekDay }}
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-7 gap-2">
        @foreach ($days as $day)
            @php
                $baseClasses = $statusClasses[$day['statusDate']] ?? $statusClasses['available'];
                $todayClass = $day['today'] ? 'ring-2 ring-warning' : '';
                $selectedClass = $selectedDate === $day['date'] ? 'scale-[0.98] border-accent bg-accent text-on-accent' : '';
            @endphp

            <button
                class="flex h-14 items-center justify-center rounded-2xl text-sm font-semibold transition {{ $baseClasses }} {{ $day['outside'] ? 'opacity-40' : '' }} {{ $todayClass }} {{ $selectedClass }}"
                type="button" wire:click="selectDate('{{ $day['date'] }}')">
                {{ $day['day'] }}
            </button>
        @endforeach
    </div>

    <div class="mt-8 flex flex-col gap-3 border-t border-primary-700/60 pt-6 md:flex-row md:items-center md:justify-between">
        <p class="text-sm text-primary-200">
            {{ $selectedDate ? 'Fecha seleccionada: ' . \Carbon\Carbon::parse($selectedDate)->locale('es_MX')->translatedFormat('d \d\e F \d\e Y') : 'Selecciona una fecha para continuar con tu cotización.' }}
        </p>
        <button class="inline-flex items-center justify-center rounded-full bg-secondary px-5 py-3 text-sm font-bold text-on-secondary transition hover:bg-secondary-600"
            type="button">
            Consultar fecha seleccionada
        </button>
    </div>
</div>

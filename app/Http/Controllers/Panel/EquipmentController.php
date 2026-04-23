<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $equipments = Equipment::query()
            ->with([
                'events:id,event_date,client_name',
                'packages:id,name',
                'packages.events:id,event_date,client_name',
            ])
            ->orderBy('name')
            ->get();

        $today = Carbon::now('America/Mexico_City')->startOfDay();

        $equipmentRows = $equipments
            ->map(function (Equipment $equipment) use ($today) {
                $directEvents = $equipment->events ?? collect();
                $packageEvents = $equipment->packages
                    ->flatMap(fn ($package) => $package->events ?? collect());

                $allEvents = $directEvents
                    ->merge($packageEvents)
                    ->filter(fn ($event) => filled($event?->event_date))
                    ->unique('id')
                    ->values();

                $upcomingEvents = $allEvents
                    ->filter(fn ($event) => Carbon::parse($event->event_date, 'America/Mexico_City')->gte($today))
                    ->sortBy('event_date')
                    ->values();

                $previousEvents = $allEvents
                    ->filter(fn ($event) => Carbon::parse($event->event_date, 'America/Mexico_City')->lt($today))
                    ->sortByDesc('event_date')
                    ->values();

                $upcomingEvent = $upcomingEvents->first();
                $lastEvent = $previousEvents->first();
                $packagesCount = $equipment->packages->count();
                $isLinkedToPackage = $packagesCount > 0;
                $isAssignedToUpcomingEvent = $upcomingEvents->isNotEmpty();

                $typeLabel = $this->resolveEquipmentType($equipment);
                $categoryLabel = $this->resolveEquipmentCategory($isLinkedToPackage, $directEvents, $allEvents);

                if ($isAssignedToUpcomingEvent) {
                    $availability = [
                        'label' => 'Ocupado',
                        'tone' => 'warning',
                    ];
                } else {
                    $availability = [
                        'label' => 'Disponible',
                        'tone' => 'secondary',
                    ];
                }

                if ($isAssignedToUpcomingEvent) {
                    $operationalStatus = [
                        'label' => 'Programado',
                        'tone' => 'warning',
                    ];
                } elseif ($allEvents->isNotEmpty()) {
                    $operationalStatus = [
                        'label' => 'Con historial',
                        'tone' => 'accent',
                    ];
                } elseif ($isLinkedToPackage) {
                    $operationalStatus = [
                        'label' => 'En catálogo',
                        'tone' => 'accent',
                    ];
                } else {
                    $operationalStatus = [
                        'label' => 'Base',
                        'tone' => 'secondary',
                    ];
                }

                $referenceLabel = 'Sin uso registrado';
                $referenceMeta = $equipment->unit ?: 'Pza';

                if ($upcomingEvent) {
                    $referenceDate = Carbon::parse($upcomingEvent->event_date, 'America/Mexico_City');
                    $referenceLabel = $upcomingEvent->client_name ?: 'Evento programado';
                    $referenceMeta = $referenceDate->locale('es')->isoFormat('D MMM YYYY, HH:mm');
                } elseif ($lastEvent) {
                    $referenceDate = Carbon::parse($lastEvent->event_date, 'America/Mexico_City');
                    $referenceLabel = $lastEvent->client_name ?: 'Último evento';
                    $referenceMeta = $referenceDate->locale('es')->isoFormat('D MMM YYYY');
                } elseif ($equipment->updated_at) {
                    $referenceLabel = 'Actualizado';
                    $referenceMeta = Carbon::parse($equipment->updated_at, 'America/Mexico_City')->locale('es')->isoFormat('D MMM YYYY');
                }

                return [
                    'id' => $equipment->id,
                    'name' => $equipment->name,
                    'description' => $equipment->description,
                    'detail' => Str::limit((string) $equipment->description, 88),
                    'code' => 'EQ-' . str_pad((string) $equipment->id, 4, '0', STR_PAD_LEFT),
                    'type_label' => $typeLabel,
                    'category_label' => $categoryLabel,
                    'availability_label' => $availability['label'],
                    'availability_tone' => $availability['tone'],
                    'operational_label' => $operationalStatus['label'],
                    'operational_tone' => $operationalStatus['tone'],
                    'in_package' => $isLinkedToPackage,
                    'in_package_label' => $isLinkedToPackage ? 'Sí' : 'No',
                    'reference_label' => $referenceLabel,
                    'reference_meta' => $referenceMeta,
                    'direct_events_count' => $directEvents->count(),
                    'events_count' => $allEvents->count(),
                    'upcoming_events_count' => $upcomingEvents->count(),
                    'packages_count' => $packagesCount,
                    'unit' => $equipment->unit ?: 'Pza',
                ];
            })
            ->values();

        $typeOptions = $equipmentRows->pluck('type_label')->filter()->unique()->sort()->values();
        $availabilityOptions = $equipmentRows->pluck('availability_label')->filter()->unique()->sort()->values();
        $operationalOptions = $equipmentRows->pluck('operational_label')->filter()->unique()->sort()->values();

        $selectedType = trim((string) $request->query('type'));
        $selectedAvailability = trim((string) $request->query('availability'));
        $selectedOperational = trim((string) $request->query('operational'));
        $selectedPackageUsage = trim((string) $request->query('package_usage'));

        $equipmentRows = $equipmentRows
            ->when($selectedType !== '', fn (Collection $rows) => $rows->where('type_label', $selectedType))
            ->when($selectedAvailability !== '', fn (Collection $rows) => $rows->where('availability_label', $selectedAvailability))
            ->when($selectedOperational !== '', fn (Collection $rows) => $rows->where('operational_label', $selectedOperational))
            ->when(
                $selectedPackageUsage !== '',
                fn (Collection $rows) => $rows->where('in_package', $selectedPackageUsage === 'yes')
            )
            ->values();

        $equipmentStats = [
            'total' => $equipmentRows->count(),
            'available' => $equipmentRows->where('availability_label', 'Disponible')->count(),
            'assigned' => $equipmentRows->where('availability_label', 'Ocupado')->count(),
            'packageLinked' => $equipmentRows->where('in_package', true)->count(),
        ];

        $parentItemActive = 8;
        $itemActive = 2;

        return view('panel.settings.equipments.index', compact(
            'equipments',
            'equipmentRows',
            'equipmentStats',
            'typeOptions',
            'availabilityOptions',
            'operationalOptions',
            'selectedType',
            'selectedAvailability',
            'selectedOperational',
            'selectedPackageUsage',
            'itemActive',
            'parentItemActive'
        ));
    }

    public function create()
    {
        return view('panel.settings.equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $equipment = new Equipment;
        $equipment->name = $request->name;
        $equipment->description = $request->description;
        $equipment->unit = 'pz';
        $equipment->save();

        return redirect()->route('settings.equipments.index');
    }

    public function show($id)
    {
        $equipment = Equipment::find($id);

        return view('panel.settings.equipments.show', compact('equipment'));
    }

    public function edit($id)
    {
        $equipment = Equipment::find($id);

        return view('panel.settings.equipments.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $equipment = Equipment::find($id);
        $equipment->name = $request->name;
        $equipment->description = $request->description;
        $equipment->unit = 'pz';
        $equipment->save();

        return redirect()->route('settings.equipments.index');
    }

    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        $equipment->delete();

        return redirect()->route('settings.equipments.index');
    }

    private function resolveEquipmentType(Equipment $equipment): string
    {
        $source = Str::lower(trim($equipment->name . ' ' . $equipment->description));

        return match (true) {
            Str::contains($source, ['extintor', 'seguridad', 'emergencia', 'casco', 'arnes', 'proteccion']) => 'Seguridad',
            Str::contains($source, ['disparo', 'consola', 'ignicion', 'digital', 'launcher']) => 'Disparo',
            Str::contains($source, ['base', 'soporte', 'estructura', 'escalera', 'plataforma']) => 'Soporte',
            Str::contains($source, ['cable', 'control', 'herramienta', 'radio', 'tecnico']) => 'Técnico',
            default => 'Operativo',
        };
    }

    private function resolveEquipmentCategory(bool $isLinkedToPackage, Collection $directEvents, Collection $allEvents): string
    {
        return match (true) {
            $isLinkedToPackage && $allEvents->isNotEmpty() => 'Paquete + evento',
            $isLinkedToPackage => 'Base de paquete',
            $directEvents->isNotEmpty() => 'Asignación directa',
            default => 'General',
        };
    }
}

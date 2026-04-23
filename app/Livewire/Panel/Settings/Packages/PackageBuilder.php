<?php

namespace App\Livewire\Panel\Settings\Packages;

use App\Models\Equipment;
use App\Models\EventType;
use App\Models\ExperienceLevel;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class PackageBuilder extends Component
{
    public ?Package $package = null;

    public string $name = '';

    public string $description = '';

    public string $price = '';

    public string $duration = '';

    public string $video_url = '';

    public string $event_type_id = '';

    public string $experience_id = '';

    public string $valid_from = '';

    public string $valid_until = '';

    public string $selected_material_id = '';

    public float|int|string $selected_material_quantity = 1;

    public string $selected_equipment_id = '';

    public float|int|string $selected_equipment_quantity = 1;

    public array $pendingMaterials = [];

    public array $pendingEquipments = [];

    public ?array $feedback = null;

    public Collection $eventTypes;

    public Collection $experienceLevels;

    public Collection $products;

    public Collection $equipments;

    public function mount($package = null): void
    {
        $this->eventTypes = EventType::query()->orderBy('name')->get();
        $this->experienceLevels = ExperienceLevel::query()->orderBy('name')->get();
        $this->products = Product::query()
            ->where('product_role_id', '!=', 3)
            ->orderBy('name')
            ->get();
        $this->equipments = Equipment::query()->orderBy('name')->get();

        if ($package instanceof Package && $package->exists) {
            $this->package = $package;
            $this->refreshPackage();
            $this->fillFromPackage();
        }
    }

    public function render()
    {
        $currentStatus = $this->package?->status ?: 'draft';
        $summary = $this->buildSummary();
        $validationItems = $this->buildValidationItems($summary);
        $priceHistoryRows = $this->buildPriceHistoryRows($currentStatus);

        return view('livewire.panel.settings.packages.package-builder', [
            'isEditing' => (bool) $this->package,
            'packageCode' => $this->package ? 'PKG-' . str_pad((string) $this->package->id, 4, '0', STR_PAD_LEFT) : 'Se genera al guardar',
            'statusMeta' => $this->buildStatusMeta($currentStatus),
            'selectedExperience' => $this->experienceLevels->firstWhere('id', (int) $this->experience_id),
            'selectedEventType' => $this->eventTypes->firstWhere('id', (int) $this->event_type_id),
            'selectedMaterial' => $this->products->firstWhere('id', (int) $this->selected_material_id),
            'materialRows' => $this->buildMaterialRows(),
            'equipmentRows' => $this->buildEquipmentRows(),
            'summary' => $summary,
            'validationItems' => $validationItems,
            'priceHistoryRows' => $priceHistoryRows,
        ]);
    }

    public function saveDraft(): void
    {
        $wasEditing = (bool) $this->package;
        $status = $this->package?->status ?: 'draft';

        $this->persistPackage($status);
        $this->setFeedback(
            $wasEditing ? 'secondary' : 'warning',
            $wasEditing ? 'Cambios guardados' : 'Borrador guardado',
            $wasEditing
                ? 'La ficha del paquete se actualizó sin cambiar su estatus actual.'
                : 'La ficha principal del paquete ya quedó registrada.'
        );
    }

    public function savePackage(): void
    {
        $this->persistPackage('active');
        $this->setFeedback('secondary', 'Paquete guardado', 'Puedes continuar agregando productos y equipamiento.');
    }

    public function finalizePackage()
    {
        $package = $this->persistPackage($this->package?->status ?: 'draft');
        $summary = $this->buildSummary();

        if ($summary['materialCount'] === 0) {
            $this->addError('builder.materials', 'Agrega al menos un producto o material antes de finalizar.');
        }

        if ($summary['equipmentCount'] === 0) {
            $this->addError('builder.equipments', 'Agrega al menos un equipo antes de finalizar.');
        }

        if (! $this->experience_id) {
            $this->addError('experience_id', 'Selecciona un nivel de experiencia antes de finalizar.');
        }

        if (! $this->valid_from || ! $this->valid_until) {
            $this->addError('builder.validity', 'Define la vigencia de precio antes de finalizar.');
        }

        if ($this->getErrorBag()->isNotEmpty()) {
            $this->setFeedback(
                'warning',
                'Faltan datos por completar',
                'Revisa los indicadores de validación antes de finalizar el paquete.'
            );

            return;
        }

        $package = $this->persistPackage('active');

        return redirect()->route('packages.show', ['id' => $package->id]);
    }

    public function addMaterial(): void
    {
        $this->validate([
            'selected_material_id' => 'required|exists:products,id',
            'selected_material_quantity' => 'required|numeric|min:1',
        ]);

        $materialId = (int) $this->selected_material_id;
        $quantity = (float) $this->selected_material_quantity;

        if (! $this->package) {
            $this->addPendingMaterial($materialId, $quantity);
        } elseif ($this->package->materials->contains($materialId)) {
            $currentQuantity = (float) $this->package->materials->find($materialId)->pivot->quantity;
            $this->package->materials()->updateExistingPivot($materialId, [
                'quantity' => $currentQuantity + $quantity,
            ]);
        } else {
            $this->package->materials()->attach($materialId, [
                'quantity' => $quantity,
                'price' => 0,
            ]);
        }

        $this->refreshPackage();
        $this->reset(['selected_material_id', 'selected_material_quantity']);
        $this->selected_material_quantity = 1;
        $this->setFeedback('accent', 'Producto agregado', 'El paquete ya incluye el insumo seleccionado.');
    }

    public function updateMaterialQuantity(int $materialId, $quantity): void
    {
        $normalizedQuantity = max((float) $quantity, 1);

        if (! $this->package) {
            if (! isset($this->pendingMaterials[$materialId])) {
                return;
            }

            $this->pendingMaterials[$materialId]['quantity'] = $normalizedQuantity;

            return;
        }

        $this->package->materials()->updateExistingPivot($materialId, [
            'quantity' => $normalizedQuantity,
        ]);

        $this->refreshPackage();
    }

    public function removeMaterial(int $materialId): void
    {
        if (! $this->package) {
            unset($this->pendingMaterials[$materialId]);

            return;
        }

        $this->package->materials()->detach($materialId);
        $this->refreshPackage();
    }

    public function addEquipment(): void
    {
        $this->validate([
            'selected_equipment_id' => 'required|exists:equipments,id',
            'selected_equipment_quantity' => 'required|numeric|min:1',
        ]);

        $equipmentId = (int) $this->selected_equipment_id;
        $quantity = (float) $this->selected_equipment_quantity;

        if (! $this->package) {
            $this->addPendingEquipment($equipmentId, $quantity);
        } elseif ($this->package->equipments->contains($equipmentId)) {
            $currentQuantity = (float) $this->package->equipments->find($equipmentId)->pivot->quantity;
            $this->package->equipments()->updateExistingPivot($equipmentId, [
                'quantity' => $currentQuantity + $quantity,
            ]);
        } else {
            $this->package->equipments()->attach($equipmentId, [
                'quantity' => $quantity,
            ]);
        }

        $this->refreshPackage();
        $this->reset(['selected_equipment_id', 'selected_equipment_quantity']);
        $this->selected_equipment_quantity = 1;
        $this->setFeedback('accent', 'Equipo agregado', 'El equipamiento quedó vinculado al paquete.');
    }

    public function updateEquipmentQuantity(int $equipmentId, $quantity): void
    {
        $normalizedQuantity = max((float) $quantity, 1);

        if (! $this->package) {
            if (! isset($this->pendingEquipments[$equipmentId])) {
                return;
            }

            $this->pendingEquipments[$equipmentId]['quantity'] = $normalizedQuantity;

            return;
        }

        $this->package->equipments()->updateExistingPivot($equipmentId, [
            'quantity' => $normalizedQuantity,
        ]);

        $this->refreshPackage();
    }

    public function removeEquipment(int $equipmentId): void
    {
        if (! $this->package) {
            unset($this->pendingEquipments[$equipmentId]);

            return;
        }

        $this->package->equipments()->detach($equipmentId);
        $this->refreshPackage();
    }

    private function persistPackage(string $status): Package
    {
        $this->resetErrorBag();

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'duration' => 'required|integer|min:1|max:999',
            'video_url' => 'nullable|url',
            'event_type_id' => 'nullable|exists:event_types,id',
            'experience_id' => 'nullable|exists:experience_levels,id',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
        ]);

        $payload = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $this->normalizedPrice(),
            'duration' => (string) $validated['duration'],
            'video_url' => $validated['video_url'] ?: null,
            'event_type_id' => $validated['event_type_id'] ?: null,
            'experience_level_id' => $validated['experience_id'] ?: null,
            'status' => $status,
            'valid_from' => $validated['valid_from'] ?: null,
            'valid_until' => $validated['valid_until'] ?: null,
        ];

        if (! $this->package) {
            $this->package = Package::create($payload);
        } else {
            $this->package->update($payload);
        }

        $this->refreshPackage();
        $this->syncPendingRelations();
        $this->refreshPackage();

        return $this->package;
    }

    private function refreshPackage(): void
    {
        if (! $this->package || ! $this->package->exists || ! $this->package->getKey()) {
            return;
        }

        $this->package = Package::query()
            ->with([
                'materials' => fn ($query) => $query->orderBy('name'),
                'equipments' => fn ($query) => $query->orderBy('name'),
                'experienceLevel',
                'eventType',
            ])
            ->findOrFail($this->package->id);
    }

    private function fillFromPackage(): void
    {
        if (! $this->package) {
            return;
        }

        $this->name = (string) $this->package->name;
        $this->description = (string) ($this->package->description ?? '');
        $this->price = $this->package->price !== null ? (string) $this->package->price : '';
        $this->duration = (string) ($this->package->duration ?? '');
        $this->video_url = (string) ($this->package->video_url ?? '');
        $this->event_type_id = $this->package->event_type_id ? (string) $this->package->event_type_id : '';
        $this->experience_id = $this->package->experience_level_id ? (string) $this->package->experience_level_id : '';
        $this->valid_from = $this->package->valid_from?->format('Y-m-d') ?? '';
        $this->valid_until = $this->package->valid_until?->format('Y-m-d') ?? '';
    }

    private function buildMaterialRows(): Collection
    {
        $persistedRows = $this->package
            ? $this->package->materials
                ->values()
                ->map(function ($material) {
                    $typeLabel = (int) $material->product_role_id === 2 ? 'Material' : 'Producto';

                    return [
                        'id' => $material->id,
                        'name' => $material->name,
                        'caliber' => $material->caliber ?: null,
                        'quantity' => (float) $material->pivot->quantity,
                        'unit' => $material->unit ?: 'Pza',
                        'typeLabel' => $typeLabel,
                        'detail' => collect([
                            $material->description ?: null,
                            $material->shots ? $material->shots . ' tiros' : null,
                            $material->shape ?: null,
                        ])->filter()->implode(' · ') ?: 'Sin detalle adicional.',
                    ];
                })
            : collect();

        $pendingRows = collect($this->pendingMaterials)
            ->values()
            ->map(function (array $pendingMaterial) {
                $material = $this->products->firstWhere('id', $pendingMaterial['id']);

                if (! $material) {
                    return null;
                }

                $typeLabel = (int) $material->product_role_id === 2 ? 'Material' : 'Producto';

                return [
                    'id' => $material->id,
                    'name' => $material->name,
                    'caliber' => $material->caliber ?: null,
                    'quantity' => (float) $pendingMaterial['quantity'],
                    'unit' => $material->unit ?: 'Pza',
                    'typeLabel' => $typeLabel,
                    'detail' => collect([
                        $material->description ?: null,
                        $material->shots ? $material->shots . ' tiros' : null,
                        $material->shape ?: null,
                    ])->filter()->implode(' · ') ?: 'Sin detalle adicional.',
                ];
            })
            ->filter();

        return $this->mergeRowsByQuantity($persistedRows, $pendingRows);
    }

    private function buildEquipmentRows(): Collection
    {
        $persistedRows = $this->package
            ? $this->package->equipments
                ->values()
                ->map(function ($equipment) {
                    return [
                        'id' => $equipment->id,
                        'name' => $equipment->name,
                        'quantity' => (float) $equipment->pivot->quantity,
                        'unit' => $equipment->unit ?: 'Pza',
                        'description' => $equipment->description ?: 'Equipo operativo vinculado.',
                    ];
                })
            : collect();

        $pendingRows = collect($this->pendingEquipments)
            ->values()
            ->map(function (array $pendingEquipment) {
                $equipment = $this->equipments->firstWhere('id', $pendingEquipment['id']);

                if (! $equipment) {
                    return null;
                }

                return [
                    'id' => $equipment->id,
                    'name' => $equipment->name,
                    'quantity' => (float) $pendingEquipment['quantity'],
                    'unit' => $equipment->unit ?: 'Pza',
                    'description' => $equipment->description ?: 'Equipo operativo vinculado.',
                ];
            })
            ->filter();

        return $this->mergeRowsByQuantity($persistedRows, $pendingRows);
    }

    private function buildSummary(): array
    {
        $materialRows = $this->buildMaterialRows();
        $equipmentRows = $this->buildEquipmentRows();

        return [
            'name' => $this->name !== '' ? $this->name : 'Sin nombre',
            'materialCount' => $materialRows->count(),
            'materialUnits' => $materialRows->sum('quantity'),
            'equipmentCount' => $equipmentRows->count(),
            'equipmentUnits' => $equipmentRows->sum('quantity'),
            'formattedPrice' => $this->price !== '' ? $this->formatCurrency($this->normalizedPrice()) : '$0.00',
            'status' => $this->buildStatusMeta($this->package?->status ?: 'draft')['label'],
        ];
    }

    private function buildValidationItems(array $summary): array
    {
        return [
            [
                'label' => 'Datos generales completos',
                'passed' => filled($this->name) && filled($this->description) && filled($this->duration),
            ],
            [
                'label' => 'Inventario asignado',
                'passed' => $summary['materialCount'] > 0,
            ],
            [
                'label' => 'Equipamiento técnico asignado',
                'passed' => $summary['equipmentCount'] > 0,
            ],
            [
                'label' => 'Nivel de experiencia definido',
                'passed' => filled($this->experience_id),
            ],
            [
                'label' => 'Precio y vigencia válidos',
                'passed' => filled($this->price) && filled($this->valid_from) && filled($this->valid_until),
            ],
        ];
    }

    private function buildPriceHistoryRows(string $status): array
    {
        if ($this->price === '') {
            return [];
        }

        $validityLabel = match (true) {
            $this->valid_from && $this->valid_until => $this->formatDate($this->valid_from) . ' - ' . $this->formatDate($this->valid_until),
            $this->valid_from => 'Desde ' . $this->formatDate($this->valid_from),
            default => 'Sin vigencia definida',
        };

        return [[
            'version' => $this->package ? 'Actual' : 'Borrador',
            'price' => $this->formatCurrency($this->normalizedPrice()),
            'validity' => $validityLabel,
            'status' => $this->buildStatusMeta($status),
        ]];
    }

    private function buildStatusMeta(string $status): array
    {
        return match ($status) {
            'active' => [
                'label' => 'Activo',
                'classes' => 'border-secondary/30 bg-secondary/10 text-secondary',
            ],
            default => [
                'label' => 'Borrador',
                'classes' => 'border-warning/30 bg-warning/10 text-warning',
            ],
        };
    }

    private function normalizedPrice(): float
    {
        $amount = preg_replace('/[^\d.]/', '', $this->price);

        return (float) $amount;
    }

    private function formatCurrency(float|int|string|null $amount): string
    {
        return '$' . number_format((float) $amount, 2);
    }

    private function formatDate(string $date): string
    {
        return date('d/m/y', strtotime($date));
    }

    private function setFeedback(string $tone, string $title, string $text): void
    {
        $this->feedback = [
            'tone' => $tone,
            'title' => $title,
            'text' => $text,
        ];
    }

    private function addPendingMaterial(int $materialId, float $quantity): void
    {
        $currentQuantity = (float) ($this->pendingMaterials[$materialId]['quantity'] ?? 0);

        $this->pendingMaterials[$materialId] = [
            'id' => $materialId,
            'quantity' => $currentQuantity + $quantity,
        ];
    }

    private function addPendingEquipment(int $equipmentId, float $quantity): void
    {
        $currentQuantity = (float) ($this->pendingEquipments[$equipmentId]['quantity'] ?? 0);

        $this->pendingEquipments[$equipmentId] = [
            'id' => $equipmentId,
            'quantity' => $currentQuantity + $quantity,
        ];
    }

    private function syncPendingRelations(): void
    {
        if (! $this->package) {
            return;
        }

        foreach ($this->pendingMaterials as $pendingMaterial) {
            $materialId = (int) $pendingMaterial['id'];
            $quantity = (float) $pendingMaterial['quantity'];
            $existingMaterial = $this->package->materials->firstWhere('id', $materialId);

            if ($existingMaterial) {
                $this->package->materials()->updateExistingPivot($materialId, [
                    'quantity' => (float) $existingMaterial->pivot->quantity + $quantity,
                ]);
            } else {
                $this->package->materials()->attach($materialId, [
                    'quantity' => $quantity,
                    'price' => 0,
                ]);
            }
        }

        foreach ($this->pendingEquipments as $pendingEquipment) {
            $equipmentId = (int) $pendingEquipment['id'];
            $quantity = (float) $pendingEquipment['quantity'];
            $existingEquipment = $this->package->equipments->firstWhere('id', $equipmentId);

            if ($existingEquipment) {
                $this->package->equipments()->updateExistingPivot($equipmentId, [
                    'quantity' => (float) $existingEquipment->pivot->quantity + $quantity,
                ]);
            } else {
                $this->package->equipments()->attach($equipmentId, [
                    'quantity' => $quantity,
                ]);
            }
        }

        $this->pendingMaterials = [];
        $this->pendingEquipments = [];
    }

    private function mergeRowsByQuantity(Collection $persistedRows, Collection $pendingRows): Collection
    {
        $merged = $persistedRows->keyBy('id');

        foreach ($pendingRows as $pendingRow) {
            $rowId = $pendingRow['id'];

            if ($merged->has($rowId)) {
                $existingRow = $merged->get($rowId);
                $existingRow['quantity'] = (float) $existingRow['quantity'] + (float) $pendingRow['quantity'];
                $merged->put($rowId, $existingRow);

                continue;
            }

            $merged->put($rowId, $pendingRow);
        }

        return $merged->values();
    }
}

<?php

namespace App\Livewire\Panel\Events;

use App\Helper\Reminder;
use App\Models\Employee;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class EventForm extends Component
{
    public $event;

    public $packages;

    public $employees;

    public $eventTypes;

    public $products = [];

    public $date;

    public $phone;

    public $client_name;

    public $client_address;

    public $event_address;

    public $event_date;

    public $event_time;

    public $event_type_id = 1;

    public $packageMode = 'registered';

    public $package_id = [];

    public $employee_id = [];

    public $customProductSearch = '';

    public $customProductQuantity = 1;

    public $customProducts = [];

    public $discountString = '';

    public $discount = 0;

    public $deposit = 0;

    public $viatic = 0;

    public $price = 0;

    public $notes = '';

    public $radioSelected = [];

    public $showAlert = false;

    public $enableSave = true;

    public $isEditMode = false;

    public $errorMessage = '';

    public $countPackageInputs = 1;

    public $countEmployeeInputs = 1;

    protected $rules = [
        'date' => 'required',
    ];

    public function updatedPackageMode(): void
    {
        $this->showAlert = false;
        $this->enableSave = true;
        $this->errorMessage = '';
        $this->resetValidation(['package_id', 'customProducts', 'price']);
        $this->refreshPackageProducts();
    }

    public function updatedPackageId($packageId, $key = null): void
    {
        if ((int) $packageId === -1) {
            if ($key !== null) {
                $this->package_id[$key] = '';
            }

            $this->dispatch('openModal', ['id' => 'new-package']);
        }
    }

    public function updatedEmployeeId($employeeId, $key = null): void
    {
        if ((int) $employeeId === -1) {
            if ($key !== null) {
                $this->employee_id[$key] = '';
            }

            $this->dispatch('openModal', ['id' => 'new-employee']);
        }
    }

    public function mount($event = null)
    {
        $this->packages = Package::all();
        $this->eventTypes = EventType::all();
        $this->employees = Employee::all();
        $this->packageMode = $this->packages->isEmpty() ? 'custom' : 'registered';
        $this->isEditMode = $event != null;

        if ($this->isEditMode) {
            $this->event = $event;
            $this->loadEventInputs();

            return;
        }

        $this->date = Carbon::now()->format('Y-m-d');
    }

    #[On('packageCreated')]
    public function savePackageAndUpdate($package): void
    {
        $this->packages = Package::all();
        $this->dispatch('closeModal', ['id' => 'new-package']);
    }

    #[On('employeeCreated')]
    public function saveEmployeeAndUpdate($employee): void
    {
        $this->employees = Employee::all();
        $this->dispatch('closeModal', ['id' => 'new-employee']);
    }

    public function render()
    {
        $this->refreshPackageProducts();

        return view('livewire.panel.events.event-form', [
            'products' => $this->products,
            'customCatalogProducts' => $this->customCatalogProducts(),
            'customSelectionItems' => $this->customSelectionItems(),
            'customSelectedIndex' => $this->selectedCustomProducts()
                ->mapWithKeys(fn ($row) => [$row['product_id'] => $row['quantity']])
                ->all(),
        ]);
    }

    public function addPackageInput(): void
    {
        $this->package_id[] = '';
        $this->countPackageInputs += 1;
    }

    public function removePackageInput($index): void
    {
        if ($this->countPackageInputs <= 1) {
            return;
        }

        unset($this->package_id[$index]);
        $this->package_id = array_values($this->package_id);
        $this->countPackageInputs = max(1, $this->countPackageInputs - 1);
    }

    public function addEmployeeInput(): void
    {
        $this->employee_id[] = '';
        $this->countEmployeeInputs += 1;
    }

    public function removeEmployeeInput($index): void
    {
        if ($this->countEmployeeInputs <= 1) {
            return;
        }

        unset($this->employee_id[$index]);
        $this->employee_id = array_values($this->employee_id);
        $this->countEmployeeInputs = max(1, $this->countEmployeeInputs - 1);
    }

    public function addCustomProduct(int $productId): void
    {
        $product = Product::where('product_role_id', '!=', 3)->find($productId);

        if (! $product) {
            return;
        }

        $quantity = max((int) $this->customProductQuantity, 1);
        $existingIndex = collect($this->customProducts)
            ->search(fn ($item) => (int) ($item['product_id'] ?? 0) === $productId);

        if ($existingIndex !== false) {
            $this->customProducts[$existingIndex]['quantity'] = max(
                (int) ($this->customProducts[$existingIndex]['quantity'] ?? 0) + $quantity,
                1
            );
        } else {
            $this->customProducts[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
            ];
        }

        $this->customProductQuantity = 1;
        $this->showAlert = false;
        $this->enableSave = true;
        $this->errorMessage = '';
        $this->resetValidation(['customProducts']);
    }

    public function removeCustomProduct(int $index): void
    {
        unset($this->customProducts[$index]);
        $this->customProducts = array_values($this->customProducts);
    }

    private function loadEventInputs(): void
    {
        $this->date = $this->event->date;
        $this->phone = $this->event->phone;
        $this->client_name = $this->event->client_name;
        $this->client_address = $this->event->client_address;
        $this->event_address = $this->event->event_address;
        $this->event_date = substr($this->event->event_date, 0, 10);
        $this->event_time = substr($this->event->event_date, 11, 5);
        $this->event_type_id = $this->event->event_type_id;
        $this->package_id = $this->event->packages->pluck('id')->toArray();
        $this->employee_id = $this->event->employees->pluck('id')->toArray();
        $this->countPackageInputs = max($this->event->packages->count(), 1);
        $this->countEmployeeInputs = max($this->event->employees->count(), 1);
        $this->discount = $this->event->discount;
        $this->discountString = $this->event->discount * 100 . '%';
        $this->deposit = $this->event->advance;
        $this->viatic = $this->event->travel_expenses;
        $this->notes = $this->event->notes;
        $this->price = $this->event->price;
        $this->packageMode = $this->event->packages->isNotEmpty() ? 'registered' : 'custom';

        if ($this->packageMode === 'custom') {
            $this->customProducts = $this->event->products
                ->map(fn ($product) => [
                    'product_id' => $product->id,
                    'quantity' => (int) ($product->pivot->quantity ?? 1),
                ])
                ->values()
                ->toArray();
        }
    }

    private function validateStock(): bool
    {
        $plannedProducts = $this->plannedEventProducts();

        if ($plannedProducts->isEmpty()) {
            $this->errorMessage = '';

            return true;
        }

        $lowInventoryProducts = Product::with('inventories')
            ->whereIn('id', $plannedProducts->pluck('product_id'))
            ->where(function ($query) {
                $query->whereDoesntHave('inventories')
                    ->orWhereHas('inventories', function ($inventoryQuery) {
                        $inventoryQuery->where('quantity', '<=', Inventory::MIN_STOCK)
                            ->orWhereNull('quantity');
                    });
            })
            ->get();

        if ($lowInventoryProducts->isEmpty()) {
            $this->errorMessage = '';

            return true;
        }

        $visibleNames = $lowInventoryProducts->pluck('name')->take(4)->implode(', ');
        $remaining = $lowInventoryProducts->count() - min($lowInventoryProducts->count(), 4);
        $suffix = $remaining > 0 ? ' y '.$remaining.' más' : '';

        $this->errorMessage = 'Inventario bajo detectado en: '.$visibleNames.$suffix.'. Puedes revisar la selección o continuar de todos modos.';

        return false;
    }

    private function parse_user_amount(string $input): float
    {
        $value = trim($input);
        $isPercent = str_contains($value, '%');
        $clean = preg_replace('/[^0-9\-\.,]/', '', $value);

        if ($clean === '' || $clean === '-') {
            return 0.0;
        }

        $clean = str_replace(',', '', $clean);
        $number = (float) $clean;

        return $isPercent ? ($number / 100) : $number;
    }

    private function saveEvent(): Event
    {
        $event = $this->isEditMode ? Event::find($this->event->id) : new Event;
        $addEmployee = false;
        $selectedPackageIds = $this->selectedPackageIds();
        $selectedEmployeeIds = $this->selectedEmployeeIds();
        $existingEmployeeIds = $event->exists ? $event->employees->pluck('id')->toArray() : [];
        $newEmployees = array_diff($selectedEmployeeIds, $existingEmployeeIds);

        if ($this->isEditMode && count($existingEmployeeIds) !== count($selectedEmployeeIds)) {
            $addEmployee = true;
        }

        $event->fill([
            'date' => $this->date,
            'phone' => $this->phone,
            'client_name' => $this->client_name,
            'client_address' => $this->client_address,
            'event_address' => $this->event_address,
            'event_date' => $this->event_date . ' ' . $this->event_time,
            'event_type_id' => $this->event_type_id,
            'discount' => $this->parse_user_amount((string) $this->discountString),
            'advance' => $this->parse_user_amount((string) $this->deposit),
            'travel_expenses' => $this->formatViatic($this->viatic),
            'notes' => $this->notes,
            'price' => $this->parse_user_amount((string) $this->price),
        ]);

        if (! empty($selectedPackageIds)) {
            $event->package()->associate($selectedPackageIds[0]);
        } else {
            $event->package()->dissociate();
        }

        $event->save();

        $this->syncEmployees($event, $selectedEmployeeIds);
        $this->syncPackages($event, $selectedPackageIds);

        if ($addEmployee) {
            $event->employees = $event->employees->whereIn('id', $newEmployees);
        }

        $this->sendReminders($event);

        return $event;
    }

    private function formatViatic($viatic): string
    {
        $amount = $this->parse_user_amount((string) $viatic);

        return number_format($amount, 2, '.', '');
    }

    private function syncEmployees(Event $event, array $selectedEmployeeIds): void
    {
        $event->employees()->sync($selectedEmployeeIds);
    }

    private function syncPackages(Event $event, array $selectedPackageIds): void
    {
        if (empty($selectedPackageIds)) {
            $event->packages()->detach();

            return;
        }

        $packages = Package::whereIn('id', $selectedPackageIds)
            ->get()
            ->keyBy('id');

        $payload = collect($selectedPackageIds)
            ->mapWithKeys(function (int $packageId) use ($packages) {
                $package = $packages->get($packageId);

                if (! $package) {
                    return [];
                }

                return [
                    $packageId => [
                        'quantity' => 1,
                        'price' => (float) $package->price,
                    ],
                ];
            })
            ->all();

        $event->packages()->sync($payload);
    }

    private function sendReminders(Event $event): void
    {
        if (! $this->isEditMode) {
            Reminder::send($event, 'pushNotification', 4, true);
        }

        if ($event->employees->count() > 0) {
            Reminder::send($event, 'pushNotification', 3);
        }
    }

    private function saveProductsInEvent(Event $event): Event
    {
        $payload = $this->plannedEventProducts()
            ->mapWithKeys(fn ($item) => [
                $item['product_id'] => [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] ?? 0,
                    'check_employee' => $this->existingProductFlag($event, $item['product_id'], 'check_employee'),
                    'check_almacen' => $this->existingProductFlag($event, $item['product_id'], 'check_almacen'),
                ],
            ])
            ->all();

        $event->products()->sync($payload);

        return $event;
    }

    public function save()
    {
        $this->processDiscount();

        if (! $this->validateEventComposition()) {
            return;
        }

        if (! $this->validateStock()) {
            $this->showAlert = true;
            $this->enableSave = false;

            return;
        }

        $this->validate();
        $event = $this->saveEvent();
        $this->saveProductsInEvent($event);
        $this->syncEventEquipments($event);
        $this->reset();

        return redirect()->route('events.index');
    }

    private function processDiscount(): void
    {
        $discountString = str_replace(['$', '%'], '', $this->discountString);

        if ($this->discountString == '') {
            $this->discount = 0;
        } elseif (is_numeric($discountString)) {
            $this->discount = strpos($this->discountString, '%') !== false ? $discountString / 100 : $discountString;
        } else {
            $this->discount = 0;
        }
    }

    public function closeAlert(): void
    {
        $this->showAlert = false;
        $this->enableSave = true;
        $this->errorMessage = '';
        $this->refreshPackageProducts();
    }

    public function saveAndContinue()
    {
        $this->processDiscount();

        if (! $this->validateEventComposition()) {
            $this->showAlert = false;
            $this->enableSave = true;

            return null;
        }

        $this->validate();
        $event = $this->saveEvent();
        $this->saveProductsInEvent($event);
        $this->syncEventEquipments($event);
        $this->reset();
        $this->showAlert = false;

        return redirect()->route('events.index');
    }

    private function validateEventComposition(): bool
    {
        $this->resetValidation(['package_id', 'customProducts', 'price']);

        if ($this->packageMode === 'registered') {
            if (! empty($this->selectedPackageIds())) {
                return true;
            }

            $this->addError('package_id', 'Selecciona al menos un paquete registrado o cambia a modo personalizado.');

            return false;
        }

        if ($this->selectedCustomProducts()->isEmpty()) {
            $this->addError('customProducts', 'Agrega al menos un material o producto al paquete personalizado.');

            return false;
        }

        if ($this->parse_user_amount((string) $this->price) <= 0) {
            $this->addError('price', 'Captura el precio final del evento para un paquete personalizado.');

            return false;
        }

        return true;
    }

    private function selectedPackageIds(): array
    {
        if ($this->packageMode !== 'registered') {
            return [];
        }

        return collect($this->package_id)
            ->filter(fn ($id) => filled($id) && (int) $id > 0)
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    private function selectedEmployeeIds(): array
    {
        return collect($this->employee_id)
            ->filter(fn ($id) => filled($id) && (int) $id > 0)
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    private function selectedCustomProducts(): Collection
    {
        if ($this->packageMode !== 'custom') {
            return collect();
        }

        $rows = collect($this->customProducts)
            ->map(function ($row) {
                return [
                    'product_id' => (int) ($row['product_id'] ?? 0),
                    'quantity' => max((int) ($row['quantity'] ?? 0), 0),
                ];
            })
            ->filter(fn ($row) => $row['product_id'] > 0 && $row['quantity'] > 0);

        $prices = Product::with('inventories')
            ->whereIn('id', $rows->pluck('product_id')->all())
            ->get()
            ->mapWithKeys(fn ($product) => [
                $product->id => (float) ($product->inventories->first()?->pivot?->price ?? 0),
            ]);

        return $rows
            ->groupBy('product_id')
            ->map(fn ($groupedRows, $productId) => [
                'product_id' => (int) $productId,
                'quantity' => $groupedRows->sum('quantity'),
                'price' => (float) ($prices->get((int) $productId) ?? 0),
            ])
            ->values();
    }

    private function customCatalogProducts(): Collection
    {
        return Product::with('inventories')
            ->where('product_role_id', '!=', 3)
            ->when($this->customProductSearch !== '', function ($query) {
                $query->where('name', 'like', '%' . trim($this->customProductSearch) . '%');
            })
            ->orderBy('name', 'ASC')
            ->limit(30)
            ->get();
    }

    private function customSelectionItems(): Collection
    {
        $rows = collect($this->customProducts)->values();
        $products = Product::with('inventories')
            ->whereIn('id', $rows->pluck('product_id')->filter()->map(fn ($id) => (int) $id)->all())
            ->get()
            ->keyBy('id');

        return $rows
            ->map(function ($row, $index) use ($products) {
                $productId = (int) ($row['product_id'] ?? 0);
                $quantity = max((int) ($row['quantity'] ?? 1), 1);
                $product = $products->get($productId);

                if (! $product) {
                    return null;
                }

                return [
                    'index' => $index,
                    'id' => $product->id,
                    'name' => $product->name,
                    'descriptor' => $this->productDescriptor($product),
                    'quantity' => $quantity,
                    'stock' => (int) ($product->inventories->first()->pivot->quantity ?? 0),
                ];
            })
            ->filter()
            ->values();
    }

    private function plannedEventProducts(): Collection
    {
        if ($this->packageMode === 'custom') {
            return $this->selectedCustomProducts();
        }

        $selectedPackageIds = $this->selectedPackageIds();

        if (empty($selectedPackageIds)) {
            return collect();
        }

        $packages = Package::with(['materials', 'materials.products.inventories', 'materials.inventories'])
            ->whereIn('id', $selectedPackageIds)
            ->get();

        $fixedProducts = $packages
            ->flatMap(function ($package) {
                return $package->materials
                    ->map(fn ($material) => [
                        'product_id' => $material->id,
                        'quantity' => (int) ($material->pivot->quantity ?? 1),
                        'price' => $this->resolveProductSnapshotPrice($material),
                    ]);
            });

        $selectedVariableProducts = collect($this->radioSelected)
            ->filter(fn ($productId) => filled($productId) && (int) $productId > 0)
            ->map(fn ($productId) => [
                'product_id' => (int) $productId,
                'quantity' => 1,
                'price' => $this->resolveVariableProductSnapshotPrice((int) $productId),
            ]);

        return $fixedProducts
            ->merge($selectedVariableProducts)
            ->groupBy('product_id')
            ->map(fn ($rows, $productId) => [
                'product_id' => (int) $productId,
                'quantity' => $rows->sum('quantity'),
                'price' => (float) ($rows->first()['price'] ?? 0),
            ])
            ->values();
    }

    private function refreshPackageProducts(): void
    {
        if ($this->packageMode !== 'registered') {
            $this->products = [];

            return;
        }

        $selectedPackageIds = $this->selectedPackageIds();

        if (empty($selectedPackageIds)) {
            $this->products = [];

            return;
        }

        $packages = Package::with(['materials', 'materials.products', 'materials.products.inventories', 'materials.inventories'])
            ->whereIn('id', $selectedPackageIds)
            ->get();

        $this->products = $packages
            ->flatMap(fn ($package) => $package->materials->where('product_role_id', 2)->values())
            ->values()
            ->all();
    }

    private function productDescriptor(Product $product): string
    {
        return collect([
            $product->caliber ? $product->caliber . '"' : null,
            $product->shots ? $product->shots . ' tiros' : null,
            $product->shape ?: null,
            $product->unit ?: null,
        ])->filter()->implode(' · ');
    }

    private function syncEventEquipments(Event $event): void
    {
        $payload = $this->plannedEventEquipments($event)
            ->mapWithKeys(fn ($item) => [
                $item['equipment_id'] => [
                    'quantity' => $item['quantity'],
                    'check_employee' => $this->existingEquipmentFlag($event, $item['equipment_id'], 'check_employee'),
                    'check_almacen' => $this->existingEquipmentFlag($event, $item['equipment_id'], 'check_almacen'),
                ],
            ])
            ->all();

        $event->equipments()->sync($payload);
    }

    private function plannedEventEquipments(Event $event): Collection
    {
        if ($this->packageMode !== 'registered') {
            return collect();
        }

        $selectedPackageIds = $this->selectedPackageIds();

        if (empty($selectedPackageIds)) {
            return collect();
        }

        return Package::with('equipments')
            ->whereIn('id', $selectedPackageIds)
            ->get()
            ->flatMap(fn ($package) => $package->equipments->map(fn ($equipment) => [
                'equipment_id' => (int) $equipment->id,
                'quantity' => max((int) ($equipment->pivot->quantity ?? 1), 1),
            ]))
            ->groupBy('equipment_id')
            ->map(fn ($rows, $equipmentId) => [
                'equipment_id' => (int) $equipmentId,
                'quantity' => $rows->sum('quantity'),
            ])
            ->values();
    }

    private function existingProductFlag(Event $event, int $productId, string $flag): bool
    {
        if (! $event->exists) {
            return false;
        }

        $existingProduct = $event->products()->where('products.id', $productId)->first();

        return (bool) ($existingProduct?->pivot?->{$flag} ?? false);
    }

    private function existingEquipmentFlag(Event $event, int $equipmentId, string $flag): bool
    {
        if (! $event->exists) {
            return false;
        }

        $existingEquipment = $event->equipments()->where('equipments.id', $equipmentId)->first();

        return (bool) ($existingEquipment?->pivot?->{$flag} ?? false);
    }

    private function resolveProductSnapshotPrice(Product $product): float
    {
        $pivotPrice = (float) ($product->pivot->price ?? 0);

        if ($pivotPrice > 0) {
            return $pivotPrice;
        }

        return (float) ($product->inventories->first()?->pivot?->price ?? 0);
    }

    private function resolveVariableProductSnapshotPrice(int $productId): float
    {
        $product = Product::with('inventories')->find($productId);

        return (float) ($product?->inventories->first()?->pivot?->price ?? 0);
    }
}

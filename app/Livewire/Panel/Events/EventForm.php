<?php

namespace App\Livewire\Panel\Events;

use App\Helper\Reminder;
use App\Jobs\SendReminder;
use App\Jobs\UpdateInventory;
use App\Models\Employee;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Livewire;

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
    public $package_id = [];
    public $employee_id = [];
    public $discountString = '';
    public $discount = 0;
    public $deposit = 0;
    public $viatic = 0;
    public $notes = "";
    public $radioSelected = [];
    public $showAlert = false;
    public $enableSave = true;
    public $isEditMode = false;
    public $countPackageInputs = 1;
    public $countEmployeeInputs = 1;

    protected $rules = [
        'date' => 'required'
    ];

    public function updatedPackageId($packageId)
    {
        if ($packageId == -1) {
            $this->dispatch('openModal', ['id' => 'new-package']);
        }
    }

    public function updatedEmployeeId($employeeId)
    {
        if ($employeeId == -1) {
            $this->dispatch('openModal', ['id' => 'new-employee']);
            return;
        }
        $employee = Employee::find($employeeId);
    }

    public function mount($event = null)
    {
        $this->packages = Package::all();
        $this->eventTypes = EventType::all();
        $this->employees = Employee::all();
        $this->isEditMode = $event != null;
        if ($this->isEditMode) {
            $this->event = $event;
            $this->loadEventInputs();
        } else {
            $this->date = Carbon::now()->format('Y-m-d');
            if ($this->packages->count() == 0) {
                return redirect()->route('packages.create');
            }
        }
    }

    #[On('packageCreated')]
    public function savePackageAndUpdate($package)
    {
        $this->packages = Package::all();
        $this->dispatch('closeModal', ['id' => 'new-package']);
    }

    #[On('employeeCreated')]
    public function saveEmployeeAndUpdate($employee)
    {
        $this->employees = Employee::all();
        $this->dispatch('closeModal', ['id' => 'new-employee']);
    }

    public function render()
    {
        $query = Package::with(['materials', 'materials.products', 'materials.products.inventories', 'materials.inventories'])
            ->whereIn('id', $this->package_id)
            ->first();
        if ($query) {
            $this->products = $query->materials->where('product_role_id', 2) ?? [];
        }

        return view('livewire.panel.events.event-form', ["products" => $this->products]);
    }

    public function addPackageInput()
    {
        $this->package_id[] = '';
        $this->countPackageInputs += 1;
    }

    public function removePackageInput($index)
    {
        unset($this->package_id[$index]);
        $this->package_id = array_values($this->package_id);
        $this->countPackageInputs -= 1;
    }

    public function addEmployeeInput()
    {
        $this->employee_id[] = '';
        $this->countEmployeeInputs += 1;
    }

    public function removeEmployeeInput($index)
    {
        unset($this->employee_id[$index]);
        $this->employee_id = array_values($this->employee_id);
        $this->countEmployeeInputs -= 1;
    }

    private function loadEventInputs()
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
        $this->countPackageInputs = $this->event->packages->count();
        $this->countEmployeeInputs = $this->event->employees->count() > 0 ? $this->event->employees->count() : 1;
        $this->discount = $this->event->discount;
        $this->discountString = $this->event->discount * 100 . '%';
        $this->deposit = $this->event->advance;
        $this->viatic = $this->event->travel_expenses;
        $this->notes = $this->event->notes;
    }

    private function getProductsLowInventory($packageId)
    {
        $package = Package::with('materials')->whereIn('id', $packageId)->get();

        if (!$package) {
            return collect();
        }

        $productIds = $package->map(function ($item) {
            return $item->materials->where('product_role_id', 2)->pluck('id')->toArray();
        })->flatten()->toArray();

        $products = Product::with('inventories')
            ->whereIn('id', $productIds)
            ->whereHas('inventories', function ($query) {
                $query->where('quantity', '<=', Inventory::MIN_STOCK)
                    ->orWhereNull('quantity');
            })
            ->get();

        return $products;
    }

    private function validateStock(): bool
    {
        $productsLowInventory = $this->getProductsLowInventory($this->package_id);

        $lowInventoryProductIds = $productsLowInventory->pluck('id')->toArray();
        $productsDiff = array_diff($this->radioSelected, $lowInventoryProductIds);

        return empty($productsDiff);
    }

    private function saveEvent(): Event
    {
        $event = $this->isEditMode ? Event::find($this->event->id) : new Event();
        $addEmployee = false;
        $newEmployees = [];

        if ($this->isEditMode && $event->employees->count() != count($this->employee_id)) {
            $addEmployee = true;
            $newEmployees = array_diff($this->employee_id, $event->employees->pluck('id')->toArray());
        }

        $event->fill([
            'date' => $this->date,
            'phone' => $this->phone,
            'client_name' => $this->client_name,
            'client_address' => $this->client_address,
            'event_address' => $this->event_address,
            'event_date' => $this->event_date . ' ' . $this->event_time,
            'event_type_id' => $this->event_type_id,
            'discount' => $this->discount,
            'advance' => $this->deposit,
            'travel_expenses' => $this->formatViatic($this->viatic),
            'notes' => $this->notes,
        ]);

        if (!empty($this->package_id)) {
            $event->package()->associate($this->package_id[0]);
        }

        $event->save();

        $this->syncEmployees($event);
        $this->syncPackages($event);

        if ($addEmployee) {
            $event->employees = $event->employees->whereIn('id', $newEmployees);
        }

        $this->sendReminders($event);

        return $event;
    }

    private function formatViatic($viatic): string
    {
        $viatic = str_replace(['$', ','], '', $viatic);
        return number_format(empty($viatic) ? 0 : $viatic, 2, '.', '');
    }

    private function syncEmployees(Event $event)
    {
        if (!empty($this->employee_id)) {
            $event->employees()->sync(array_unique($this->employee_id));
        }
    }

    private function syncPackages(Event $event)
    {
        if (!empty($this->package_id)) {
            $event->packages()->sync(array_unique($this->package_id));
        }
    }

    private function sendReminders(Event $event)
    {
        // if (!$this->isEditMode) {
        //     Reminder::send($event, 'whatsapp', 4, true);
        // }

        // if ($event->employees->count() > 0) {
        //     Reminder::send($event, 'whatsapp', 3);
        // }
    }

    private function saveProductsInEvent(Event $event): Event
    {
        $event->products()->detach();
        $packages = Package::with(['materials', 'materials.inventories', 'materials.products.inventories'])
            ->whereIn('id', $this->package_id)
            ->get();
        $selectedProducts = collect($this->radioSelected);

        foreach ($packages as $package) {
            foreach ($package->materials as $product) {
                if ($product->product_role_id == 2) {
                    $this->attachSelectedProducts($event, $selectedProducts, $product);
                } else {
                    $this->attachProduct($event, $product);
                }
            }
        }

        return $event;
    }

    private function attachSelectedProducts(Event $event, $selectedProducts, $product)
    {
        foreach ($selectedProducts as $selectedProduct) {
            $existingProduct = $event->products()->where('product_id', $selectedProduct)->first();
            if ($existingProduct) {
                $event->products()->updateExistingPivot($selectedProduct, [
                    'quantity' => $existingProduct->pivot->quantity + $product->pivot->quantity
                ]);
            } else {
                $event->products()->attach($selectedProduct, [
                    'quantity' => $product->pivot->quantity,
                    'price' => 0
                ]);
            }
        }
    }

    private function attachProduct(Event $event, $product)
    {
        $existingProduct = $event->products()->where('product_id', $product->id)->first();
        if ($existingProduct) {
            $event->products()->updateExistingPivot($product->id, [
                'quantity' => $existingProduct->pivot->quantity + $product->pivot->quantity
            ]);
        } else {
            $event->products()->attach($product->id, [
                'quantity' => $product->pivot->quantity,
                'price' => 0
            ]);
        }
    }

    public function save()
    {
        $this->processDiscount();

        if (!$this->validateStock()) {
            $this->showAlert = true;
            $this->enableSave = false;
            return;
        }

        $this->validate();
        $event = $this->saveEvent();
        $this->saveProductsInEvent($event);
        $this->reset();

        return redirect()->route('events.index');
    }

    private function processDiscount()
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

    public function closeAlert()
    {
        $this->showAlert = false;
        $this->enableSave = true;
        $package = Package::with(['materials', 'materials.products', 'materials.products.inventories', 'materials.inventories'])
            ->where('id', $this->package_id)
            ->first();
        $this->products = $package->materials->where('product_role_id', 2) ?? [];
    }

    public function saveAndContinue()
    {
        $this->validate();
        $event = $this->saveEvent();
        $this->saveProductsInEvent($event);
        $this->reset();
        $this->showAlert = false;
        return redirect()->route('events.index');
    }
}
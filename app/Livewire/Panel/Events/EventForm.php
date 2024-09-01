<?php

namespace App\Livewire\Panel\Events;

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


    //Reglas
    protected $rules = [
        'date' => 'required'
    ];

    public function updatedPackageId($packageId)
    {
        $this->products = Package::with(['materials', 'materials.products', 'materials.products.inventories', 'materials.inventories'])
            ->where('id', $packageId)
            ->first()
            ->materials->where('product_role_id', 2) ?? [];
    }

    public function updatedEmployeeId($employeeId)
    {
        $employee = Employee::find($employeeId);
        //Validate if employe has a experience in the event by packages
        //$maxExperience = Package::whereIn('id', $this->package_id)->where('experience_level_id', $employee->experience_level_id)->count();
    }

    public function mount($event = null)
    {
        $this->packages = Package::all();
        $this->eventTypes = EventType::all();
        $this->employees = Employee::all();
        // if event == null date now in format Y-m-d to utc    
        $this->isEditMode = $event != null;
        if ($this->isEditMode) {
            $this->event = $event;
            $this->loadEventInputs();
        } else {

            $this->date = Carbon::now()->format('Y-m-d');
            if ($this->packages->count() == 0) {
                // Redirect to create package
                return redirect()->route('packages.create');
            }
        }
    }

    public function render()
    {
        return view('livewire.panel.events.event-form');
    }

    public function addPackageInput()
    {
        $this->package_id[] = '';
        $this->countPackageInputs += 1;
    }

    public function removePackageInput($index)
    {
        unset($this->package_id[$index]);
        $this->package_id = array_values($this->package_id); // Reindexar el array
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
        $this->employee_id = array_values($this->employee_id); // Reindexar el array
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
        $this->countEmployeeInputs =  $this->event->employees->count();
        $this->discount = $this->event->discount;
        $this->discountString = $this->event->discount * 100 . '%';
        $this->deposit = $this->event->advance;
        $this->viatic = $this->event->travel_expenses;
        $this->notes = $this->event->notes;
    }


    private function getProductsLowInventory($packageId)
    {
        $package = Package::with(['materials'])->where('id', $packageId)->get()->first();
        $products  = Product::with(['inventories']);
        $products = $products->where(function ($query) use ($package) {
            $query = $query->WhereIn('id', $package->materials->where('product_role_id', 1)->pluck('id'));
            $products = $package->materials->where('product_role_id', 2);
            foreach ($products as $product) {
                $query->orWhereIn('id', $product->products->pluck('id'));
            }
        });
        $products = $products->where(function (Builder $query) {
            $query->whereHas('inventories', function ($query) {
                $query->where('quantity', '<=', Inventory::MIN_STOCK)->orWhereNull('quantity');
            });
        });
        return $products->get();
    }

    private function validateStock(): bool
    {
        $productsLowInventory = $this->getProductsLowInventory($this->package_id);
        // Verify if radio selected products are in low inventory
        $productsDiff = array_diff($this->radioSelected, $productsLowInventory->pluck('id')->toArray());
        return count($productsDiff) > 0;
    }

    private function saveEvent(): Event
    {
        $addEmployee = false;
        $newEmployees = [];
        if ($this->isEditMode) {
            $event = Event::find($this->event->id);

            if ($event->employees->count() != count($this->employee_id)) {
                $addEmployee = true;
                // get new employees
                $newEmployees = array_diff($this->employee_id, $event->employees->pluck('id')->toArray());
                // if event date is less than 3 days send reminder now else send reminder 3 days before
            }
        } else {
            $event = new Event();
        }
        $event->date = $this->date;
        $event->phone = $this->phone;
        $event->client_name = $this->client_name;
        $event->client_address = $this->client_address;
        $event->event_address = $this->event_address;
        $event->event_date = $this->event_date . ' ' . $this->event_time;
        $event->event_type_id = $this->event_type_id;
        // Verify package_id is one or more
        $event->discount = $this->discount;
        $event->advance = $this->deposit;
        $event->travel_expenses = $this->viatic;
        $event->notes = $this->notes;
        $event->save();

        if (count($this->employee_id) >= 1) {
            // Detach all employees
            $event->employees()->detach();
            // Verify duplicate employees
            $this->employee_id = array_unique($this->employee_id);
            // Attach employees
            $event->employees()->attach($this->employee_id);
        }

        if (is_array($this->package_id) && count($this->package_id) >= 1) {
            // Detach all packages
            $event->packages()->detach();
            // Verify duplicate packages
            $this->package_id = array_unique($this->package_id);
            // Attach packages
            $event->packages()->attach($this->package_id);
        }

        if ($addEmployee) {
            // if event date is less than 3 days send reminder now only new employees else send reminder 3 days before only new employees
            $event->employees = $event->employees->whereIn('id', $newEmployees);
        }

        // update inventory
        UpdateInventory::dispatch($event);
        // event date - 4 days send admin reminder
        if (!$this->isEditMode) {
            if (Date::parse($event->event_date)->diffInDays() < 4) {
                SendReminder::dispatch('whatsapp', $event, true);
            } else {
                SendReminder::dispatch('whatsapp', $event, true)->delay(Date::parse($event->event_date)->subDays(4));
            }
        }
        // event date - 3 days send to employee reminder
        if ($event->employees->count() > 0) {
            if (Date::parse($event->event_date)->diffInDays() < 3) {
                // hide employees that are not new
                SendReminder::dispatch('whatsapp', $event);
            } else {
                SendReminder::dispatch('whatsapp', $event)->delay(Date::parse($event->event_date)->subDays(3));
            }
        }

        return $event;
    }

    private function saveProductsInEvent(Event $event): Event
    {
        // reset Products
        $event->products()->detach();
        $packages = Package::with(['materials', 'materials.inventories', 'materials.products.inventories'])->whereIn('id', $this->package_id)->get();
        $selectedProducts = collect($this->radioSelected);
        foreach ($packages as $package) {
            foreach ($package->materials as $product) {
                if ($product->product_role_id == 2) {
                    foreach ($selectedProducts as $i => $selectedProduct) {
                        //Verificar si el producto ya fue agregado
                        $existingProduct = $event->products()->where('product_id', $selectedProduct)->first();
                        if ($existingProduct) {
                            $event->products()->updateExistingPivot($selectedProduct, ['quantity' => $existingProduct->pivot->quantity + $product->pivot->quantity]);
                        } else {
                            $event->products()->attach($selectedProduct, ['quantity' => $product->pivot->quantity, 'price' => 0]);
                        }
                    }
                } else {
                    //Verificar si el producto ya fue agregado
                    $existingProduct = $event->products()->where('product_id', $product->id)->first();
                    if ($existingProduct) {
                        $event->products()->updateExistingPivot($product->id, ['quantity' => $existingProduct->pivot->quantity + $product->pivot->quantity]);
                    } else {
                        $event->products()->attach($product->id, ['quantity' => $product->pivot->quantity, 'price' => 0]);
                    }
                }
            }
        }

        return $event;
    }

    public function save()
    {
        $this->discount = str_replace('%', '', $this->discountString) / 100;

        //Verificar existencia de productos en inventario
        if (!$this->validateStock()) {
            //show alert
            $this->showAlert = true;
            $this->enableSave = false;
            return;
        }
        $this->validate();
        $event = $this->saveEvent();
        $event = $this->saveProductsInEvent($event);
        $this->reset();

        return redirect()->route('events.index');
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
        //Verificar existencia de productos en inventario
        $this->validate();
        $event = $this->saveEvent();
        $event = $this->saveProductsInEvent($event);
        $this->reset();
        $this->showAlert = false;
        return redirect()->route('events.index');
    }
}
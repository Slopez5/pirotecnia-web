<?php

namespace App\Livewire\Panel\Events\Create;

use App\Jobs\SendReminder;
use App\Models\Event;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class EventForm extends Component
{

    public $packages;
    public $products = [];
    public $package_id;
    public $date;
    public $phone;
    public $client_name;
    public $client_address;
    public $event_address;
    public $event_datetime;
    public $event_type = "Boda";
    public $radioSelected = [];
    public $showAlert = false;
    public $enableSave = true;

    //Reglas
    protected $rules = [
        'date' => 'required',
        'phone' => 'required',
        'client_name' => 'required',
        'client_address' => 'required',
        'event_address' => 'required',
        'event_datetime' => 'required',
        'event_type' => 'required',
        'package_id' => 'required',
    ];

    public function updatedRadioSelected()
    {
        $package = Package::with(['materials', 'materials.inventories', 'materials.products.inventories'])->where('id', $this->package_id)->first();
        $selectedProducts = collect($this->radioSelected);
        $products = Product::with('inventories')->whereIn('id', $selectedProducts)->get();
        foreach ($package->materials as $material) {
            if ($material->product_role_id == 2) {
                //$selectedProductsExample [53,52,52]
                foreach ($products as $product) {
                    //si product->id esta en selectedProducts restar 1 al inventario
                    $productCount = $selectedProducts->filter(function ($selectedProduct) use ($product) {
                        return $product->id == $selectedProduct;
                    })->count();
                    if ($product->inventories->first()) {
                        $product->inventories->first()->pivot->quantity -=  $productCount;
                    }
                }
            } else {
                logger($material);
                if ($material->inventories->first()) {
                    $material->inventories->first()->pivot->quantity -= $material->pivot->quantity;
                }
            }
        }
        $this->products = $package->materials->where('product_role_id', 2) ?? [];
    }

    public function updatedPackageId()
    {
        $package = Package::with(['materials', 'materials.products', 'materials.products.inventories', 'materials.inventories'])
            ->where('id', $this->package_id)
            ->first();
        $this->products = $package->materials->where('product_role_id', 2) ?? [];
    }

    public function mount($packages)
    {
        // date now in format Y-m-d to utc
        $this->date = Carbon::now()->setTimezone('America/Mexico_City')->format('Y-m-d');
        $this->packages = $packages;
        if ($packages->count() > 0) {

            $this->package_id = $packages->first()->id;
        } else {
            redirect()->route('packages.create');
        }
    }

    public function render()
    {
        return view('livewire.panel.events.create.event-form');
    }

    private function validateStock(): bool
    {
        $package = Package::with(['materials', 'materials.inventories', 'materials.products.inventories'])->where('id', $this->package_id)->first();
        $selectedProducts = collect($this->radioSelected);
        $products = Product::with('inventories')->whereIn('id', $selectedProducts)->get();
        foreach ($package->materials as $material) {
            if ($material->product_role_id == 2) {
                //$selectedProductsExample [53,52,52]
                foreach ($products as $product) {
                    //si product->id esta en selectedProducts restar 1 al inventario
                    $productCount = $selectedProducts->filter(function ($selectedProduct) use ($product) {
                        return $product->id == $selectedProduct;
                    })->count();
                    if ($material->inventories->first()) {
                        $product->inventories->first()->pivot->quantity -=  $productCount;
                    }
                }
            } else {
                if ($material->inventories->first()) {
                    $material->inventories->first()->pivot->quantity -= $material->pivot->quantity;
                }
            }
        }
        $materialsLowInventory = $package->materials->filter(function ($material) {
            if ($material->inventories->first()) {
                return $material->product_role_id == 1 && ($material->inventories->first()->pivot->quantity <= Inventory::MIN_STOCK);
            }
        });
        $productsLowInventory = $products->filter(function ($product) {
            if ($product->inventories->first()) {
                return $product->inventories->first()->pivot->quantity <= Inventory::MIN_STOCK;
            }
        });
        if ($materialsLowInventory->count() > 0 || $productsLowInventory->count() > 0) {
            return false;
        }
        return true;
    }

    private function saveEvent(): Event
    {
        $event = new Event();
        $event->date = $this->date;
        $event->phone = $this->phone;
        $event->client_name = $this->client_name;
        $event->client_address = $this->client_address;
        $event->event_address = $this->event_address;
        $event->event_date = $this->event_datetime;
        $event->event_type = $this->event_type;
        $event->package()->associate($this->package_id);
        $event->save();
        SendReminder::dispatch('whatsapp', $event)->delay(now()->addMinutes(1));
        return $event;
    }

    private function saveProductsInEvent(Event $event): Event
    {
        $package = Package::with(['materials', 'materials.inventories', 'materials.products.inventories'])->where('id', $this->package_id)->first();
        $selectedProducts = collect($this->radioSelected);
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

        return $event;
    }

    public function save()
    {
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
    }
}

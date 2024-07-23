<?php

namespace App\Livewire\Panel\Events\Create;

use App\Models\Event;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
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
        logger($this->radioSelected);
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
                    $product->inventories->first()->pivot->quantity -=  $productCount;
                }
            } else {
                $material->inventories->first()->pivot->quantity -= $material->pivot->quantity;
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
                    $product->inventories->first()->pivot->quantity -=  $productCount;
                }
            } else {
                $material->inventories->first()->pivot->quantity -= $material->pivot->quantity;
            }
        }
        $materialsLowInventory = $package->materials->filter(function ($material) {
            return $material->product_role_id == 1 && ($material->inventories->first()->pivot->quantity <= Inventory::MIN_STOCK);
        });
        $productsLowInventory = $products->filter(function ($product) {
            return $product->inventories->first()->pivot->quantity <= Inventory::MIN_STOCK;
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
                        $event->products()->updateExistingPivot($selectedProduct, ['quantity' => $existingProduct->pivot->quantity + 1]);
                    } else {
                        $event->products()->attach($selectedProduct, ['quantity' => 1, 'price' => 0]);
                    }
                }
            } else {
                //Verificar si el producto ya fue agregado
                $existingProduct = $event->products()->where('product_id', $product->id)->first();
                if ($existingProduct) {
                    $event->products()->updateExistingPivot($product->id, ['quantity' => $existingProduct->pivot->quantity + 1]);
                } else {
                    $event->products()->attach($product->id, ['quantity' => 1, 'price' => 0]);
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
            logger('No hay stock suficiente');
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

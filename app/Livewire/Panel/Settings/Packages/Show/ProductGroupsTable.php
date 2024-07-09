<?php

namespace App\Livewire\Panel\Settings\Packages\Show;

use App\Models\Package;
use App\Models\Product;
use App\Models\ProductGroup;
use Livewire\Component;

class ProductGroupsTable extends Component
{
    public $package;
    public $products;
    public $product_id;
    public $isAddProduct = false;
    public $product_id_selected;
    public $isEditMode = false;

    public $description;
    public $quantity;
    public $unit;
    public $price;


    public function mount($package)
    {
        $this->package = $package;
        
        $this->products = ProductGroup::all();
    }

    public function render()
    {
        return view('livewire.panel.settings.packages.show.product-groups-table');
    }

    public function editProduct($id)
    {
        if ($this->isEditMode) {
            $this->package->productGroups()->updateExistingPivot($id, [
                'quantity' => $this->quantity,
            ]);
            $this->product_id_selected = null;
            $this->description = null;
            $this->quantity = null;
            $this->unit = null;
        } else {
            $this->product_id_selected = $id;
            $productAux = $this->package->productGroups()->where('id',$id)->first();
            $this->description = $productAux->name;
            $this->quantity = $productAux->pivot->quantity;
            $this->unit = $productAux->unit;
            
        }
        $this->isEditMode = !$this->isEditMode;
    }

    public function cancelEdit()
    {
        $this->isEditMode = false;
        $this->product_id_selected = null;
        $this->description = null;
        $this->quantity = null;
        $this->unit = null;
        $this->price = null;
    }

    public function deleteProduct($id)
    {
        $this->package->productGroups()->detach($id);
    }

    public function addProduct() {
        $this->isAddProduct = !$this->isAddProduct;
    }

    public function saveProduct() {
        $this->package->productGroups()->attach($this->product_id, [
            'quantity' => $this->quantity,
        ]);
        $this->isAddProduct = false;
        $this->product_id = null;
        $this->quantity = null;

    }

    public function cancelAddProduct() {
        $this->isAddProduct = false;
        $this->product_id = null;
        $this->quantity = null;
    }
}

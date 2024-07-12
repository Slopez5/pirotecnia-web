<?php

namespace App\Livewire\Panel\Settings\Packages\Show;

use App\Models\Product;
use Livewire\Component;

class ProductsTable extends Component
{


    public $package;
    public $products;
    public $isEditMode = false;
    public $isAddProduct = false;
    public $product_id;
    public $product_id_selected;
    public $description;
    public $quantity;
    public $unit;

    public function mount($package)
    {
        $this->package = $package;
        $this->products = Product::where('product_role_id','!=',3)->get();
    }

    public function render()
    {
        return view('livewire.panel.settings.packages.show.products-table');
    }

    public function editProduct($id)
    {
        if ($this->isEditMode) {
            $this->package->materials()->updateExistingPivot($id, [
                'quantity' => $this->quantity,
            ]);
            $this->product_id_selected = null;
            $this->description = null;
            $this->quantity = null;
            $this->unit = null;
        } else {
            $this->product_id_selected = $id;
            $productAux = $this->package->materials()->where('id',$id)->first();
            $this->description = $productAux->name;
            $this->quantity = $productAux->pivot->quantity;
            $this->unit = $productAux->unit;
            
        }
        $this->isEditMode = !$this->isEditMode;
    }

    public function cancelEdit()
    {
        $this->isEditMode = false;
    }

    public function addProduct()
    {
        $this->isAddProduct = !$this->isAddProduct;
    }

    public function saveProduct()
    {
        logger("agregare $this->product_id");
        $this->package->materials()->attach($this->product_id, ['quantity' => $this->quantity]);
        $this->product_id = null;
        $this->description = null;
        $this->quantity = null;
        $this->unit = null;
    }

    public function removeProduct($id)
    {
        $this->package->materials()->detach($id);
    }

    public function cancelAddProduct()
    {
        $this->product_id = null;
        $this->description = null;
        $this->quantity = null;
        $this->unit = null;
        $this->isAddProduct = !$this->isAddProduct;
    }


}

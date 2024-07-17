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

    public $isAddProduct = false;
    public $isAddNewProduct = false;
    public $isEditMode = false;

    //form data
    public $productId;
    public $product;
    public $quantity;
    public $price;
    public $unit;

    public function updatedProductId()
    {
        logger('updatedProductId');
        if ($this->productId == 0) {
            $this->switchToAddNewProductMode();
        } else {
            $this->switchToAddNewProductMode(false);
        }
    }

    public function mount($package)
    {
        $this->package = $package;
        $this->products = Product::where('product_role_id', 3)->get();
    }

    public function render()
    {
        return view('livewire.panel.settings.packages.show.product-groups-table');
    }

    //switch to add product mode
    public function switchToAddProductMode()
    {
        logger('switchToAddProductMode');
        $this->isAddProduct = !$this->isAddProduct;
    }

    //switch to add new product mode
    public function switchToAddNewProductMode($value = true)
    {
        logger('switchToAddNewProductMode');
        if (!$value) {
            $this->isAddNewProduct = $value;
        } else {
            $this->isAddNewProduct = !$this->isAddNewProduct;
        }
    }

    //switch to edit mode
    public function switchToEditMode($productId)
    {
        logger('switchToEditMode');
        $this->productId = $productId;
        $this->quantity = $this->package->productGroups()->where('id', $productId)->first()->pivot->quantity;
        $this->isEditMode = !$this->isEditMode;
    }

    //add product to package
    public function addProductToPackage()
    {
        logger('addProductToPackage');
        if ($this->isAddNewProduct) {
            $this->addNewProductToPackage();
            return;
        }
        $this->package->productGroups()->attach($this->productId, [
            'quantity' => $this->quantity,
        ]);

        $this->isAddProduct = false;

        $this->clearNewProductForm();
    }

    //remove product from package
    public function removeProductFromPackage($productId)
    {
        logger($productId);
        $this->package->productGroups()->detach($productId);
    }

    //edit product in package
    public function editProductInPackage($productId)
    {
        logger($productId);
        $this->package->productGroups()->updateExistingPivot($productId, [
            'quantity' => $this->quantity,
        ]);

        $this->isEditMode = false;
        $this->clearNewProductForm();
    }

    //add new product to package
    public function addNewProductToPackage()
    {
        logger($this->product);
        $product = new Product();
        $product->name = $this->product;
        $product->description = $this->product;
        $product->product_role_id = 3;
        $product->unit = 'pz';
        $product->save();

        $this->products = Product::all();
        $this->package->productGroups()->attach($product->id, [
            'quantity' => $this->quantity,
        ]);

        $this->isAddNewProduct = false;
        $this->clearNewProductForm();
    }

    //cancel add product
    public function cancelAddProduct()
    {
        $this->isAddProduct = false;
        $this->isAddNewProduct = false;
        $this->clearNewProductForm();
    }

    //cancel edit product
    public function cancelEditProduct()
    {
        $this->isEditMode = false;
        $this->clearNewProductForm();
    }

    //clear new product form
    public function clearNewProductForm()
    {
        logger('clearNewProductForm');
        $this->productId = '';
        $this->product = '';
        $this->quantity = '';
        $this->price = '';
        $this->unit = '';
    }
}

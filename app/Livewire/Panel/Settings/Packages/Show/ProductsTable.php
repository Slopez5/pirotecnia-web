<?php

namespace App\Livewire\Panel\Settings\Packages\Show;

use App\Models\Product;
use Livewire\Component;

class ProductsTable extends Component
{


    public $package;
    public $materials;

    public $isAddMaterial = false;
    public $isAddNewMaterial = false;
    public $isEditMode = false;

    //form data
    public $materialId;
    public $material;
    public $quantity;
    public $price;
    public $unit;

    protected $rules = [
        'materialId' => 'required|integer',
        'quantity' => 'required|integer|min:1',
        'material' => 'required_if:isAddNewProduct,true|string',
    ];

    public function mount($package)
    {
        $this->package = $package;
        $this->materials = Product::where('product_role_id','!=',3)->get();
    }

    public function render()
    {
        return view('livewire.panel.settings.packages.show.products-table');
    }

    //switch to add product mode
    public function switchToAddMaterialMode()
    {
        $this->isAddMaterial = !$this->isAddMaterial;
    }

    //switch to add new product mode
    public function switchToAddNewMaterialMode($value = true)
    {
        if (!$value) {
            $this->isAddNewMaterial = $value;
        } else {
            $this->isAddNewMaterial = !$this->isAddNewMaterial;
        }
    }

    //switch to edit mode
    public function switchToEditMode($materialId)
    {
        $this->materialId = $materialId;
        $this->quantity = $this->package->materials()->where('id', $materialId)->first()->pivot->quantity;
        $this->isEditMode = !$this->isEditMode;
    }

    //add product to package
    public function addMaterialToPackage()
    {
        $this->validate();

        if ($this->isAddNewMaterial) {
            $this->addNewMaterialToPackage();
            return;
        }
        //Verify if the product is already in the package
        $material = $this->package->materials()->where('id', $this->materialId)->first();
        if ($material) {
            $this->quantity += $material->pivot->quantity;
            $this->editMaterialInPackage($this->materialId);
            return;
        }
        $this->package->materials()->attach($this->materialId, [
            'quantity' => $this->quantity,
        ]);

        $this->isAddMaterial = false;

        $this->clearNewMaterialForm();
    }

    //remove product from package
    public function removeMaterialFromPackage($materialId)
    {
        $this->package->materials()->detach($materialId);
    }

    //edit product in package
    public function editMaterialInPackage($materialId)
    {
        $this->package->materials()->updateExistingPivot($materialId, [
            'quantity' => $this->quantity,
        ]);

        $this->isEditMode = false;
        $this->clearNewMaterialForm();
    }

    //add new product to package
    public function addNewMaterialToPackage()
    {
        $material = new Product();
        $material->name = $this->product;
        $material->description = $this->product;
        $material->product_role_id = 3;
        $material->unit = 'pz';
        $material->save();

        $this->materials = Product::all();
        $this->package->materials()->attach($material->id, [
            'quantity' => $this->quantity,
        ]);

        $this->isAddNewMaterial = false;
        $this->clearNewMaterialForm();
    }

    //cancel add product
    public function cancelAddMaterial()
    {
        $this->isAddMaterial = false;
        $this->isAddNewMaterial = false;
        $this->clearNewMaterialForm();
    }

    //cancel edit product
    public function cancelEditMaterial()
    {
        $this->isEditMode = false;
        $this->clearNewMaterialForm();
    }

    //clear new product form
    public function clearNewMaterialForm()
    {
        $this->materialId = '';
        $this->material = '';
        $this->quantity = '';
        $this->price = '';
        $this->unit = '';
    }

}

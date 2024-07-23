<?php

namespace App\Livewire\Panel\Settings\Packages\Show;

use App\Models\Equipament;
use Livewire\Component;

class EquipamentsTable extends Component
{
    public $isAddEquipament = false;
    public $isAddNewEquipament = false;
    public $isEditMode = false;
    public $package;
    public $equipaments;
    public $equipamentId;
    public $equipament_id_selected;
    public $equipament;
    public $quantity;
    public $unit;


    protected $rules = [
        'equipamentId' => 'required|integer',
        'quantity' => 'required|integer|min:1',
        'equipament' => 'required_if:isAddNewEquipament,true|string',
    ];

    public function mount($package)
    {
        $this->package = $package;

        $this->equipaments = Equipament::all();
    }

    public function render()
    {
        return view('livewire.panel.settings.packages.show.equipaments-table');
    }

    //switch to add product mode
    public function switchToAddEquipamentMode()
    {
        $this->isAddEquipament = !$this->isAddEquipament;
    }

    //switch to add new product mode
    public function switchToAddNewEquipamentMode($value = true)
    {
        if (!$value) {
            $this->isAddNewEquipament = $value;
        } else {
            $this->isAddNewEquipament = !$this->isAddNewEquipament;
        }
    }

    //switch to edit mode
    public function switchToEditMode($equipamentId)
    {
        $this->equipamentId = $equipamentId;
        $this->quantity = $this->package->equipaments()->where('id', $equipamentId)->first()->pivot->quantity;
        $this->isEditMode = !$this->isEditMode;
    }

    //add product to package
    public function addEquipamentToPackage()
    {
        $this->validate();

        if ($this->isAddNewMaterial) {
            $this->addNewEquipamentToPackage();
            return;
        }
        //Verify if the product is already in the package
        $material = $this->package->equipaments()->where('id', $this->materialId)->first();
        if ($material) {
            $this->quantity += $material->pivot->quantity;
            $this->editEquipamentInPackage($this->materialId);
            return;
        }
        $this->package->equipaments()->attach($this->materialId, [
            'quantity' => $this->quantity,
        ]);

        $this->isAddEquipament = false;

        $this->clearNewMaterialForm();
    }

    //remove product from package
    public function removeEquipamentFromPackage($materialId)
    {
        $this->package->equipaments()->detach($materialId);
    }

    //edit product in package
    public function editEquipamentInPackage($materialId)
    {
        $this->validate();
        
        $this->package->equipaments()->updateExistingPivot($materialId, [
            'quantity' => $this->quantity,
        ]);

        $this->isEditMode = false;
        $this->clearNewEquipamentForm();
    }

    //add new product to package
    public function addNewEquipamentToPackage()
    {
        $material = new Equipament();
        $material->name = $this->material;
        $material->description = $this->material;
        $material->product_role_id = 3;
        $material->unit = 'pz';
        $material->save();

        $this->equipaments = Equipament::all();
        $this->package->equipaments()->attach($material->id, [
            'quantity' => $this->quantity,
        ]);

        $this->isAddNewEquipament = false;
        $this->clearNewEquipamentForm();
    }

    //cancel add product
    public function cancelAddEquipament()
    {
        $this->isAddEquipament = false;
        $this->isAddNewEquipament= false;
        $this->clearNewEquipamentForm();
    }

    //cancel edit product
    public function cancelEditEquipament()
    {
        $this->isEditMode = false;
        $this->clearNewEquipamentForm();
    }

    //clear new product form
    public function clearNewEquipamentForm()
    {
        $this->equipamentId = '';
        $this->equipament = '';
        $this->quantity = '';
        $this->unit = '';
    }
}

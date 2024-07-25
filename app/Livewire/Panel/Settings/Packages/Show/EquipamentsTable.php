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
        $this->isEditMode = false;
        $this->clearNewEquipamentForm();
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
        $this->isAddEquipament = false;
        $this->equipamentId = $equipamentId;
        $this->quantity = $this->package->equipaments()->where('id', $equipamentId)->first()->pivot->quantity;
        $this->isEditMode = !$this->isEditMode;
    }

    //add product to package
    public function addEquipamentToPackage()
    {
        logger("addEquipamentToPackage");
        $this->validate();

        //Verify if the product is already in the package
        $equipament = $this->package->equipaments()->where('id', $this->equipamentId)->first();
        if ($equipament) {
            $this->quantity += $equipament->pivot->quantity;
            $this->editEquipamentInPackage($this->equipamentId);
            return;
        }
        $this->package->equipaments()->attach($this->equipamentId, [
            'quantity' => $this->quantity,
        ]);

        $this->isAddEquipament = false;

        $this->clearNewEquipamentForm();
    }

    //remove product from package
    public function removeEquipamentFromPackage($equipamentId)
    {
        $this->package->equipaments()->detach($equipamentId);
    }

    //edit product in package
    public function editEquipamentInPackage($equipamentId)
    {
        $this->validate();
        
        $this->package->equipaments()->updateExistingPivot($equipamentId, [
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

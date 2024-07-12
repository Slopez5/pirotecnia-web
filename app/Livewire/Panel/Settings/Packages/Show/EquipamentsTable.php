<?php

namespace App\Livewire\Panel\Settings\Packages\Show;

use App\Models\Equipament;
use Livewire\Component;

class EquipamentsTable extends Component
{
    public $isAddEquipament = false;
    public $isEditMode = false;
    public $package;
    public $equipaments;
    public $equipament_id;
    public $equipament_id_selected;
    public $description;
    public $quantity;
    public $unit;


    public function mount($package)
    {
        $this->package = $package;

        $this->equipaments = Equipament::all();
    }

    public function render()
    {
        return view('livewire.panel.settings.packages.show.equipaments-table');
    }

    public function editEquipament($id)
    {
        if ($this->isEditMode) {
            $this->package->equipaments()->updateExistingPivot($id, [
                'quantity' => $this->quantity,
            ]);
            $this->equipament_id_selected = null;
            $this->description = null;
            $this->quantity = null;
            $this->unit = null;
        } else {
            $this->equipament_id_selected = $id;
            $equipamentAux = $this->package->equipaments()->where('id',$id)->first();
            $this->description = $equipamentAux->name;
            $this->quantity = $equipamentAux->pivot->quantity;
            $this->unit = $equipamentAux->unit;
            
        }
        $this->isEditMode = !$this->isEditMode;
    }

    public function cancelEdit()
    {
        $this->isEditMode = false;
    }

    public function addEquipament()
    {
        $this->isAddEquipament = !$this->isAddEquipament;
    }

    public function saveEquipament()
    {
        $this->package->equipaments()->attach($this->equipament_id, [
            'quantity' => $this->quantity,
        ]);
        $this->isAddEquipament = false;
        $this->equipament_id = null;
        $this->description = null;
        $this->quantity = null;
        $this->unit = null;
    }

    public function deleteEquipament($id)
    {
        $this->package->equipaments()->detach($id);
    }

    public function cancelAddEquipament()
    {
        $this->isAddEquipament = false;
        $this->equipament_id = null;
        $this->description = null;
        $this->quantity = null;
        $this->unit = null;
    }
}

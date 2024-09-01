<?php

namespace App\Livewire\Panel\Settings\Packages;

use App\Models\equipment;
use App\Models\Package;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class equipmentInPackageForm extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $package;
    public $equipments;
    public $equipment_id;
    public $quantity = 1;
    public $perPage = 10;

    public function mount($package = null)
    {
        $this->package = $package;
        $this->equipments = equipment::all()->sortBy('name', SORT_NATURAL);
    }

    public function render()
    {
        $equipmentsInPackage = null;
        if ($this->package != null) {
            $equipmentsInPackage = $this->package->equipments()->orderBy('name', 'ASC')->paginate($this->perPage);
        }
        return view('livewire.panel.settings.packages.equipment-in-package-form',
            [
                'package' => $this->package,
                'equipmentsInPackage' => $equipmentsInPackage,
            ]
        );
    }

    public function save()
    {
        // if exists update, else create
        if ($this->package->equipments->contains($this->equipment_id)) {
            $newQuantity = $this->package->equipments->find($this->equipment_id)->pivot->quantity + $this->quantity;
            $this->package->equipments()->updateExistingPivot($this->equipment_id, ['quantity' => $newQuantity]);
        } else {
            $this->package->equipments()->attach($this->equipment_id, ['quantity' => $this->quantity]);
        }
        $this->package->load('equipments');
        $this->reset(['equipment_id', 'quantity']);
    }

    #[On('deleteequipment')]
    public function deleteequipment($equipmentId)
    {
        $this->package->equipments()->detach($equipmentId);
        $this->package->load('equipments');
    }

    #[On('packageCreated')]
    public function packageCreated($package)
    {
        $this->package = Package::find($package['id']);
        $this->package->load('materials');
    }

    public function removeequipment($equipment_id)
    {

        $equipment = $this->package->equipments()->where('equipment_id', $equipment_id)->first();
        $this->dispatch('confirmDeleteequipment', name: $equipment->name, id: $equipment->id);
    }

    public function finish()
    {
        //Redirect to index
        return redirect()->route('settings.packages.index');
    }
}

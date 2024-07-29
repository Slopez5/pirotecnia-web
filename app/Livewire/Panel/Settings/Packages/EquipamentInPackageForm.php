<?php

namespace App\Livewire\Panel\Settings\Packages;

use App\Models\Equipament;
use App\Models\Package;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class EquipamentInPackageForm extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $package;
    public $equipaments;
    public $equipament_id;
    public $quantity = 1;
    public $perPage = 2;

    public function mount($package = null)
    {
        $this->package = $package;
        $this->equipaments = Equipament::all()->sortBy('name', SORT_NATURAL);
    }

    public function render()
    {
        $equipamentsInPackage = null;
        if ($this->package != null) {
            $equipamentsInPackage = $this->package->equipaments()->orderBy('name', 'ASC')->paginate($this->perPage);
        }
        return view('livewire.panel.settings.packages.equipament-in-package-form',
            [
                'package' => $this->package,
                'equipamentsInPackage' => $equipamentsInPackage,
            ]
        );
    }

    public function save()
    {
        // if exists update, else create
        if ($this->package->equipaments->contains($this->equipament_id)) {
            $newQuantity = $this->package->equipaments->find($this->equipament_id)->pivot->quantity + $this->quantity;
            $this->package->equipaments()->updateExistingPivot($this->equipament_id, ['quantity' => $newQuantity]);
        } else {
            $this->package->equipaments()->attach($this->equipament_id, ['quantity' => $this->quantity]);
        }
        $this->package->load('equipaments');
        $this->reset(['equipament_id', 'quantity']);
    }

    #[On('deleteEquipament')]
    public function deleteEquipament($equipamentId)
    {
        $this->package->equipaments()->detach($equipamentId);
        $this->package->load('equipaments');
    }

    #[On('packageCreated')]
    public function packageCreated($package)
    {
        $this->package = Package::find($package['id']);
        $this->package->load('materials');
    }

    public function removeEquipament($equipament_id)
    {

        $equipament = $this->package->equipaments()->where('equipament_id', $equipament_id)->first();
        $this->dispatch('confirmDeleteEquipament', name: $equipament->name, id: $equipament->id);
    }

    public function finish()
    {
        //Redirect to index
        return redirect()->route('settings.packages.index');
    }
}

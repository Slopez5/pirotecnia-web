<?php

namespace App\Livewire\Panel\Settings\Packages;

use App\Models\Package;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MaterialInPackageForm extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $package;
    public $materials;
    public $material_id;
    public $quantity = 1;
    public $perPage = 10;


    public function mount($package = null)
    {
        $this->materials = Product::where('product_role_id','!=' , 3)->orderBy('name', 'ASC')->get();
        $this->package = $package;
    }

    public function render()
    {
        $materialsInPackage = null;
        if ($this->package != null) {
            $materialsInPackage = $this->package->materials()->orderBy('name', 'ASC')->paginate($this->perPage);
        }
        return view('livewire.panel.settings.packages.material-in-package-form', [
            'package' => $this->package,
            'materialsInPackage' => $materialsInPackage,
        ]);
    }

    public function save()
    {
        // if exists update, else create
        if ($this->package->materials->contains($this->material_id)) {
            $newQuantity = $this->package->materials->find($this->material_id)->pivot->quantity + $this->quantity;
            $this->package->materials()->updateExistingPivot($this->material_id, ['quantity' => $newQuantity]);
        } else {
            $this->package->materials()->attach($this->material_id, ['quantity' => $this->quantity, 'price' => 0]);
        }
        $this->package->load('materials');
        $this->reset(['material_id', 'quantity']);
    }

    #[On('deleteMaterial')]
    public function deleteMaterial($materialId)
    {
        $this->package->materials()->detach($materialId);
        $this->package->load('materials');
    }

    #[On('packageCreated')]
    public function packageCreated($package)
    {
        $this->package = Package::find($package['id']);
        $this->package->load('materials');
    }

    public function removeMaterial($material_id)
    {
        //show alert to confirm
        $material = $this->materials->where('id', $material_id)->first();
        $this->dispatch('confirmDeleteMaterial', name: $material->name, id: $material_id);
    }

    public function nextTab()
    {
        $this->dispatch('nextToEquipaments');
    }
}

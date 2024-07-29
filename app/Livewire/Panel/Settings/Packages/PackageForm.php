<?php

namespace App\Livewire\Panel\Settings\Packages;

use App\Models\Package;
use Livewire\Component;

class PackageForm extends Component
{
    public $name;
    public $price;
    public $duration;
    public $description;
    public $package;
    public $enableNextTab = false;

    //packege is optional

    public function mount($package = null)
    {
        if ($package == null) {
            
            return;
        } 
        $this->package = $package;
        $this->name = $package->name;
        $this->price = $package->price;
        $this->duration = $package->duration;
        $this->description = $package->description;
    }


    public function render()
    {
        return view('livewire.panel.settings.packages.package-form');
    }

    public function save() {
        
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'description' => 'required',
        ]);

        if ($this->package == null) {
            $this->package = Package::create([
                'name' => $this->name,
                'price' => $this->price,
                'duration' => $this->duration,
                'description' => $this->description,
            ]);
            $this->dispatch('packageCreated', $this->package);
            $this->enableNextTab = true;
            return;
        }

        $this->package->update([
            'name' => $this->name,
            'price' => $this->price,
            'duration' => $this->duration,
            'description' => $this->description,
        ]);
        $this->dispatch('packageUpdated');
    }

    public function nextTab() {
        $this->dispatch('nextToMaterials');
    }
}

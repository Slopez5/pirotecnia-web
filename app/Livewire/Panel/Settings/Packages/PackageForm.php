<?php

namespace App\Livewire\Panel\Settings\Packages;

use App\Models\ExperienceLevel;
use App\Models\Package;
use Livewire\Component;

class PackageForm extends Component
{


    public $name;
    public $description;
    public $price;
    public $duration;
    public $video_url;
    public $experience_id;

    public $experienceLevels;
    public $package;
    public $enableNextTab = false;

    public $isTabs = true;

    //packege is optional

    public function mount($package = null, $isTabs = true)
    {
        $this->isTabs = $isTabs;
        $this->experienceLevels = ExperienceLevel::all();
        if ($package == null) {
            return;
        }
        $this->package = $package;
        $this->name = $package->name;
        $this->price = $package->price;
        $this->duration = $package->duration;
        $this->description = $package->description;
        $this->experience_id = $package->experience_level_id;
        $this->video_url = $package->video_url;
    }


    public function render()
    {
        return view('livewire.panel.settings.packages.package-form');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'description' => 'required',
        ]);

        $amount = $this->price;
        $amount = preg_replace('/[^\d.]/', '', $amount);
        $amountDouble = (float) $amount;

        if ($this->package == null) {
            $this->package = new Package([
                'name' => $this->name,
                'price' => $amountDouble,
                'duration' => $this->duration,
                'description' => $this->description,
                'video_url' => $this->video_url,
            ]);
            $experience = ExperienceLevel::find($this->experience_id);
            $this->package->experienceLevel()->associate($experience);
            $this->package->save();
            $this->dispatch('packageCreated', $this->package);
            $this->enableNextTab = true;
            return;
        }

        $this->package->update([
            'name' => $this->name,
            'price' => $amountDouble,
            'duration' => $this->duration,
            'description' => $this->description,
        ]);
        $experience = ExperienceLevel::find($this->experience_id);
        $this->package->experienceLevel()->associate($experience);
        $this->package->save();
        $this->dispatch('packageUpdated');
    }

    public function nextTab()
    {
        $this->dispatch('nextToMaterials');
    }
}

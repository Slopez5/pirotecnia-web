<?php

namespace App\View\Components\Panel\Settings\Packages\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MaterialsTable extends Component
{

    public $materials;
    /**
     * Create a new component instance.
     */
    public function __construct($materials)
    {
        $this->materials = $materials;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.panel.settings.packages.show.materials-table');
    }
}

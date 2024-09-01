<?php

namespace App\View\Components\Panel\Settings\Packages\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class equipmentTable extends Component
{

    public $equipments;
    /**
     * Create a new component instance.
     */
    public function __construct($equipments)
    {
        $this->equipments = $equipments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.panel.settings.packages.show.equipment-table');
    }
}

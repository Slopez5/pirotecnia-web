<?php

namespace App\View\Components\Panel\Settings\Packages\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EquipamentTable extends Component
{

    public $equipaments;
    /**
     * Create a new component instance.
     */
    public function __construct($equipaments)
    {
        $this->equipaments = $equipaments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.panel.settings.packages.show.equipament-table');
    }
}

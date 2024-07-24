<?php

namespace App\View\Components;

use App\Models\Menu as ModelsMenu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public $items;
    public $itemActive;
    public $parentItemActive = null;
    /**
     * Create a new component instance.
     */
    public function __construct($itemActive = null, $parentItemActive = null)
    {
        $this->itemActive = $itemActive;
        $this->parentItemActive = $parentItemActive;
        $this->items = ModelsMenu::where('name','web')->first()->menuItems()->where('parent_id', null)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu');
    }
}

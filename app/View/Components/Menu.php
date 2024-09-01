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
        $this->items = ModelsMenu::with('menuItems')->where('name','web')->first()->menuItems()->where('active',1)->where('parent_id', null)->orderBy('order')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu');
    }
}

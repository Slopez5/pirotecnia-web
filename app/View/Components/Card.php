<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $isBorder;
    public $icon;
    public $title;
    public $tools;
    public $footer;
    /**
     * Create a new component instance.
     */
    public function __construct($isBorder = false, $icon = null, $title = '', $tools = null, $footer = null)
    {
        $this->isBorder = $isBorder;
        $this->icon = $icon;
        $this->title = $title;
        $this->tools = $tools;
        $this->footer = $footer;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}

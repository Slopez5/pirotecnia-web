<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SmallBox extends Component
{
    public $color;

    public $number;

    public $text;

    public $icon;

    public $url;

    public $footerText;

    /**
     * Create a new component instance.
     */
    public function __construct($color, $number, $text, $icon, $url, $footerText)
    {
        $this->color = $color;
        $this->number = $number;
        $this->text = $text;
        $this->icon = $icon;
        $this->url = $url;
        $this->footerText = $footerText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.small-box');
    }
}

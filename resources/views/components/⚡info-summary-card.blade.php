<?php

use Livewire\Component;

new class extends Component {
    public $icon;
    public $title;
    public $subtitle;
    public $value;
    public $subValue;
    public $color;
    public $colorClass;

    public function mount()
    {
        $this->colorClass = in_array($this->color, ['error', 'warning', 'secondary', 'accent', 'primary'], true)
            ? $this->color
            : 'secondary';
    }
};
?>
<div
    class="bg-primary-700/70 p-4 rounded-2xl flex items-center justify-between border-l-4 border-{{ $colorClass }}">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-primary-600/60 flex items-center justify-center">
            <span class="material-symbols-outlined text-primary-200">{{ $icon }}</span>
        </div>
        <div>
            <p class="text-sm font-semibold text-on-primary">{{ $title }}</p>
            <p class="text-xs text-primary-200">{{ $subtitle }}</p>
        </div>
    </div>
    <div class="text-right">
        <p class="text-{{ $colorClass }} font-bold">{{ $value }}</p>
        <p class="text-[10px] text-primary-200 uppercase">{{ $subValue }}</p>
    </div>
</div>

<?php

use Livewire\Component;

new class extends Component {
    public string $title;
    public string $icon;
    public string $backgroundColorIcon;
    public string $colorIcon;
    public string $value;
    public string $indicatorIcon;
    public string $indicatorLabel;
    public string $indicatorColor;
};
?>

<div class="bg-primary-800 p-6 rounded-2xl relative overflow-hidden group">
    <div
        class="absolute -right-4 -top-4 w-24 h-24 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-colors">
    </div>
    <div class="flex justify-between items-start mb-4">
        <div class="p-3 {{ $backgroundColorIcon }} {{ $colorIcon }} rounded-xl">
            <span class="material-symbols-outlined">{{ $icon }}</span>
        </div>
        <span class="text-xs font-bold {{ $indicatorColor }} flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">{{ $indicatorIcon }}</span> {{ $indicatorLabel }}
        </span>
    </div>
    <p class="text-primary-200 text-xs uppercase tracking-widest font-semibold">{{ $title }}
    </p>
    <h3 class="text-3xl font-extrabold text-on-primary mt-1">{{ $value }}</h3>
</div>

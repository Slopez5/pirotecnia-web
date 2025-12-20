@props([
    'image' => '',
    'category' => 'Life Style',
    'title' => 'Unique Blue Bag',
    'price' => 49.0,
    'oldPrice' => 99.0,
    'discount' => 50, // %
    'rating' => 4.5, // 0..5
])

@php
    $full = floor($rating);
    $half = $rating - $full >= 0.5;
    $empty = 5 - $full - ($half ? 1 : 0);
@endphp


<div class="rounded-2xl bg-white shadow-lg overflow-hidden relative">
    {{-- Badge --}}


    {{-- Image --}}
    <div class="p-10 pt-16 flex justify-center">
        <img src="{{ $image }}" alt="{{ $title }}" class="h-44 object-contain" />
    </div>

    {{-- Content --}}
    <div class="px-8 pb-8">
        <div class="flex items-start justify-between gap-6">
            <div class="space-y-3">
                <h3 class="text-emerald-300 text-2xl font-medium leading-tight">
                    {{ $title }}
                </h3>
            </div>

            <div class="text-right">
                <div class="flex items-end justify-end gap-3">
                    <span class="text-3xl font-semibold text-slate-800">
                        ${{ number_format($price, 2) }}
                    </span>

                </div>
            </div>
        </div>


    </div>
</div>

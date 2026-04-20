@props(['title' => ''])

<div {{ $attributes->merge(['class' => 'fixed inset-0 z-[80] hidden items-center justify-center bg-primary-900/75 p-4 backdrop-blur-sm']) }}
    aria-hidden="true" id="{{ $attributes['id'] }}" role="dialog" tabindex="-1"
    onclick="if (event.target === this) window.dispatchEvent(new CustomEvent('app-modal-close', { detail: { id: '{{ $attributes['id'] }}' } }));">
    <div class="w-full max-w-3xl overflow-hidden rounded-3xl border border-primary-600/50 bg-primary-800 shadow-2xl shadow-primary-900/40"
        onclick="event.stopPropagation()">
        @if (isset($header))
            <div class="border-b border-primary-700/60 px-6 py-5">
                {{ $header }}
            </div>
        @else
            <div class="flex items-center justify-between gap-4 border-b border-primary-700/60 px-6 py-5">
                <h4 class="text-xl font-bold text-on-primary">{{ $title }}</h4>
                <button
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary-700 text-on-primary transition-colors hover:bg-primary-600"
                    onclick="window.dispatchEvent(new CustomEvent('app-modal-close', { detail: { id: '{{ $attributes['id'] }}' } }));"
                    type="button">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        @endif

        @isset($body)
            <div {{ $body->attributes->merge(['class' => 'max-h-[75vh] overflow-y-auto px-6 py-6']) }}>
                {{ $body }}
            </div>
        @endisset

        @isset($footer)
            <div {{ $footer->attributes->merge(['class' => 'border-t border-primary-700/60 px-6 py-5']) }}>
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>

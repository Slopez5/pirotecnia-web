<div {{ $attributes->merge(['class' => 'modal fade']) }} tabindex="-1" aria-labelledby="{{ $attributes['id'] }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $attributes['id'] }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @isset($body)
                    {{ $body }}
                @endisset
            </div>
        </div>
    </div>
</div>

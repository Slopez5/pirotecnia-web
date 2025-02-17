<div {{ $attributes->merge(['class' => 'modal fade']) }} id="{{ $attributes['id'] }}">
    <div class="modal-dialog">
        <div class="modal-content">
            @if (isset($header))
                <div class="modal-header">
                    {{ $header }}
                </div>
            @else
                <div class="modal-header">
                    <h4 class="modal-title">{{ $title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @isset($body)
                <div {{ $body->attributes->merge(['class' => 'modal-body']) }}>
                    {{ $body }}
                </div>
            @endisset
            @isset($footer)
                <div {{ $footer->attributes->merge(['class' => 'modal-footer justify-content-between']) }}>
                    {{ $footer }}
                </div>
            @endisset
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

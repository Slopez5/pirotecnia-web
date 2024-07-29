<!-- resources/views/components/card.blade.php -->
<div {{ $attributes->merge(['class' => 'card']) }}>
    <div class="card-header {{ $isBorder ? 'border-0' : '' }}">

        @isset($header)
            {{ $header }}
        @endisset


        @isset($title)
            <h3 class="card-title">
                @isset($icon)
                    <i class="{{ $icon }} mr-1"></i>
                @endisset
                {{ $title }}
            </h3>
        @endisset

        @isset($tools)
            <div class="card-tools">
                {{ $tools }}
            </div>
        @endisset
    </div><!-- /.card-header -->
    @isset($body)
        <div {{ $body->attributes->merge(['class' => 'card-body']) }}>
            {{ $body }}
        </div><!-- /.card-body -->
    @endisset

    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div><!-- /.card-footer -->
    @endisset
</div>

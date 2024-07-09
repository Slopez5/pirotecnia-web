<!-- resources/views/components/small-box.blade.php -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box {{ $color }}">
        <div class="inner">
            <h3>{{ $number }}</h3>
            <p>{{ $text }}</p>
        </div>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
        <a href="{{ $url }}" class="small-box-footer">
            {{ $footerText }} <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

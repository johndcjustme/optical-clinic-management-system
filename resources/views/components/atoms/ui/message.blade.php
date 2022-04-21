@if (!empty($icon))
    <div {{ $attributes->merge(['class' => 'ui icon message transition']) }}>
        <i class="{{ $icon }} icon"></i>

        @if (!empty($close))
            <i class="icon close"></i>
        @endif
        <div class="content">
            <div class="header">
                {{ $header }}
            </div>
            <p>{{ $message }}</p>
        </div>
    </div>
@else
    <div id="message123" {{ $attributes->merge(['class' => 'ui message transition']) }} x-init="$('.message .close').on('click', function() { $(this).closest('.message').transition('fade'); });">
            @if (!empty($close))
                <i class="icon close"></i>
            @endif
            <div class="header">{{ $header }}</div>
            <p>{{ $message }}</p>
    </div>
@endif
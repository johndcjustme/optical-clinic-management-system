@if (!empty($icon))
    <div {{ $attributes->merge(['class' => 'flex justify-center gap-3']) }}>
        {{-- <div>
            <i class="{{ $icon ?? null }} icon"></i>
    
            @if (!empty($close))
                <i class="icon close"></i>
            @endif
        </div> --}}
        <div class="content text-center">
            <h4 class="font-bold">
                <i class="{{ $icon ?? null }} icon"></i>
                {{ $header }}
            </h4>
            <p class="opacity-50">{{ $message }}</p>
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
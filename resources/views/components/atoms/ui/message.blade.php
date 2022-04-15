@if (!empty($icon))
    <div {{ $attributes->merge(['class' => 'ui icon message']) }}>
        <i class="{{ $icon }} icon"></i>
        <div class="content">
            <div class="header">
                {{ $header }}
            </div>
            <p>{{ $message }}</p>
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => '']) }}>
        <div class="ui message">
            <div class="header">
                {{ $header }}
            </div>
            <p>{{ $message }}</p>
        </div>
    </div>
@endif
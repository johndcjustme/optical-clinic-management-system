@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'ui success message']) }}>
        <p>
            {{ $status }}
        </p>
    </div>
@endif

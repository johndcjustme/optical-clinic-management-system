<button {{ $attributes->merge(['type' => 'submit', 'class' => 'ui button secondary']) }}>
    {{ $slot }}
</button>

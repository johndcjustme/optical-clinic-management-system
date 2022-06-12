<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn w-full']) }}>
    {{ $slot }}
</button>

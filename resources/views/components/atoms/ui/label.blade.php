<label for="{{ $for }}" {{ $attributes->merge(['class' => ''])->merge(['style' => '']) }}>
    {{ $slot }}
</label>
<label for="{{ $for }}" {{ $attributes->merge(['class' => 'label'])->merge(['style' => ''])->merge(['for' => '']) }}>
    <span class="text-label">
        {{ $slot }}
    </span>
</label>
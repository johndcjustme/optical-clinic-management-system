<button wire:click.prevent="{{ $wireClick }}" {{ $attributes->merge(['class' => 'btn']) }}>
    {{ $slot }}
</button>
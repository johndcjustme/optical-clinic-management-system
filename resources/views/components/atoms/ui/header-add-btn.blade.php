<x-atoms.ui.button wire:click.prevent="{{ $wireClick }}" class="btn" {{ $attributes->merge(['style' => '']) }}>
    @if (!empty($icon))
        <i class="icon {{ $icon }}"></i> 
    @else
        <i class="fa-solid fa-plus mr-2"></i> 
    @endif
    {{ $label }}
</x-atoms.ui.button>
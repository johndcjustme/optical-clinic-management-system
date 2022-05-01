<x-atoms.ui.button wire:click.prevent="{{ $wireClick }}" class="tiny basic icon blue">
    @if (!empty($icon))
        <i class="icon {{ $icon }}"></i> 
    @else
        <i class="icon plus"></i> 
    @endif
    {{ $label }}
</x-atoms.ui.button>
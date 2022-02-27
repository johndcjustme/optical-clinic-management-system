<div wire:click.prevent="{{ $wireClick }}" class="pointer dark_200">
    {{ Str::title($colTitle) }}
    @if (!empty($wireClick))
        <i class="ml_4 fa-solid fa-caret-{{ $arrowDirection ? 'down' : 'up' }}"></i>
    @endif
</div>
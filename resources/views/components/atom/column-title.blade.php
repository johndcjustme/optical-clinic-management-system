<div wire:click.prevent="{{ $wireClick }}" title="Sort" class="pointer">
    {{ Str::title($colTitle) }}
    @if (!empty($wireClick))
        <i class="fa-solid fa-angle-{{ $arrowDirection ? 'down' : 'up' }}"></i>
    @endif
</div>
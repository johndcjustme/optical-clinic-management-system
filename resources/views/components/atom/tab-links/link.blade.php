<a href="#" wire:click.prevent="{{ $wireClick }}" class="relative underlined_item_links py_3 {{ $subPage ? "active" : '' }}
    nodecoration" href="">
    {{ $tabTitle }}
    {{ $slot }}    
</a>
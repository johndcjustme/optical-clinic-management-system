<a href="#" wire:click="{{ $wireClick }}" class="relative underlined_item_links py_3 {{ $subPage ? "active" : '' }}
    nodecoration" href="">
    {{ $tabTitle }}
    {{ $slot }}    
</a>
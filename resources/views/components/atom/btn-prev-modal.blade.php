<button class="mr_5 cancel btn_w_s" wire:click.prevent="{{ $wireClick }}"
    style="
        width: 3.5em;
        height: 3.5em;
        border-radius: 2em;
        padding: 0;
    "
>
    <i class="fa-solid fa-chevron-left"></i>
    {{ $slot }}
</button>

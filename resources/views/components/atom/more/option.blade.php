<style>
    div.option:hover {
        color: #000;
    }
    div.option:not(:last-child) {
        margin-bottom: 0.7em;
    }
</style>
<div class="option dark_200 fast full_w" wire:click.prevent="{{ $wireClick }}">{{ $optionName }}</div>
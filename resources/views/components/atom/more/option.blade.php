{{-- <style>
    div.option:hover {
        color: #000;
    }
    div.option:not(:last-child) {
        margin-bottom: 0.7em;
    }
</style> --}}

<div class="item" wire:click.prevent="{{ $wireClick }}">
    {{-- <div class="ui blue empty circular label"></div> --}}
    <span class="">
        {{ $optionName }}
    </span>
  </div>


{{-- <div class="option dark_200 fast full_w" wire:click.prevent="{{ $wireClick }}"><span class="">{{ $optionName }}</span></div> --}}
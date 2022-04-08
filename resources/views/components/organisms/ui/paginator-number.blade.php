{{-- <div class="flex flex_y_center flex_x_between" style="margin-top: 1em">
    <div>
        {{ $slot }}
    </div>
    <div>
        <select wire:model="{{ $wireModel }}"
        class="ui small compact selection dropdown dropdown-page-number"" id="search-select">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
</div>

 --}}

  <div wire:click.prevent="$set('pageNumber', 10)" class="item">
        10
    </div>
    <div wire:click.prevent="$set('pageNumber', 20)" class="item">
        20
    </div>
    <div wire:click.prevent="$set('pageNumber', 30)" class="item">

        30
    </div>
    <div wire:click.prevent="$set('pageNumber', 40)" class="item">

        40
    </div>
    <div wire:click.prevent="$set('pageNumber', 50)" class="item">

        50
    </div>
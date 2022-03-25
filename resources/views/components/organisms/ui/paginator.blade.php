<div class="flex flex_y_center flex_x_between" style="margin-top: 1em">
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


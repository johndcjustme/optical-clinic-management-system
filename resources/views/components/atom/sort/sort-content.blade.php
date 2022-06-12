<label for="{{ $for }}">
    <span>{{ $span }}</span>
    @if (!empty($for))
        <input wire:model.prevent="{{ $wireModel }}" id="{{ $for }}" type="radio" name="{{ $name }}" value="{{ $val }}">
    @endif
    @if ($span === 'Entries')
        <select wire:model.prevent="{{ $wireModel }}" class="input_small" style="width: 5em">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
    @endif

</label>
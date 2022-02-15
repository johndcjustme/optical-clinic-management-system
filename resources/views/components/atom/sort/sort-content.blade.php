<label for="{{ $for }}">
    <span>{{ $span }}</span>
    <input wire:model.prevent="{{ $wireModel }}" id="{{ $for }}" type="radio" name="{{ $name }}" value="{{ $val }}">
</label>
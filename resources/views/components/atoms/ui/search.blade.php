<div class="ui icon input tiny transparent">
    <input wire:model.debounce.500ms="{{ $wireModel }}" type="text" {{ $attributes->merge(['placehoder'=>''])}}>
    <i class="search icon"></i>
  </div>
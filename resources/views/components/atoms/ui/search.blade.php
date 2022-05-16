<div class="ui icon input tiny">
    <input wire:model.debounce.500ms="{{ $wireModel }}" type="text" {{ $attributes->merge(['placehoder'=>''])}}>
    <i class="search icon"></i>
</div>
{{-- <div class="ui action input tiny">
    <input wire:model.debounce.500ms="{{ $wireModel }}" type="text" {{ $attributes->merge(['placehoder' => '']) }}>
    <button class="ui icon button">
        <i class="search icon"></i>
    </button>
</div> --}}

<div {{ $attributes->merge(['class' => 'ui input'])->merge(['style'=>'']) }}>
    <input wire:model.defer="{{ $wireModel }}" placeholder="{{ $placeholder }}" {{ $attributes->merge(['type' => 'text', 'value' => '', 'readonly' => null]) }}>
</div>
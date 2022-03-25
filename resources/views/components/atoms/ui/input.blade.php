<div {{ $attributes->merge(['class' => 'ui input'])->merge(['style'=>'']) }}>
    <input wire:model.defer="{{ $wireModel }}" placeholder="{{ $placeholder }}" {{ $attributes->merge(['type' => 'text']) }}>
</div>
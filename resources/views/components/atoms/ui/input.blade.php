<div {{ $attributes->merge(['class' => 'ui input']) }}>
    <input wire:model.defer="{{ $wireModel }}" placeholder="{{ $placeholder }}" {{ $attributes->merge(['type' => 'text']) }}>
</div>
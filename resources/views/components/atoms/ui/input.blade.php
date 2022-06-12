{{-- <div {{ $attributes->merge(['class' => 'input'])->merge(['style'=>'']) }}> --}}
    <input wire:model.defer="{{ $wireModel }}" placeholder="{{ $placeholder }}" {{ $attributes->merge(['type' => 'text', 'value' => '', 'readonly' => null])->merge(['class' => 'input input-bordered w-full'])->merge(['style'=>'']) }}>
{{-- </div> --}}
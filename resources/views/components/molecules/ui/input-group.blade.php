<label {{ $attributes->merge(['class' => 'input-group']) }}>
    <span>{{ $slot }}</span>
    <input wire:model.defer="{{ $wireModel }}" class="input input-bordered w-full" {{ $attributes->merge(['type' => 'text'])->merge(['placeholder' => '']) }}/>
</label>


{{-- <input wire:model.defer="{{ $wireModel }}" placeholder="{{ $placeholder }}" {{ $attributes->merge(['type' => 'text', 'value' => '', 'readonly' => null])->merge(['class' => 'input input-bordered w-full'])->merge(['style'=>'']) }}> --}}

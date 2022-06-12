<button form="{{ $form }}" {{ $attributes->merge(['class' => 'btn'])->merge(['type'=>'button']) }}>{{ $slot }}</button>

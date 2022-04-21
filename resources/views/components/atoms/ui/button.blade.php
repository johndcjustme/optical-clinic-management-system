<button form="{{ $form }}" {{ $attributes->merge(['class' => 'ui button'])->merge(['type'=>'button']) }}>{{ $slot }}</button>

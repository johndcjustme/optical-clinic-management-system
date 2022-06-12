<select {{ $attributes->merge(['class' => 'input input-bordered w-full'])->merge(['style'=>'']) }}>
    {{ $slot }}
</select>



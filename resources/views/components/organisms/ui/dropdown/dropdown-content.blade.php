<ul tabindex="0" {{ $attributes->merge(['class' => 'dropdown-content menu p-2 shadow-xl bg-base-100 rounded-box w-52'])->merge(['style' => '']) }}>
    {{ $slot }}
</ul>
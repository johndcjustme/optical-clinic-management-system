<button  {{ $attributes->merge(['class' => 'circular ui icon button', 'form' => '']) }} type="submit">
    {{ $slot }}
</button>
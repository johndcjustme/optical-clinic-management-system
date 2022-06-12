<button  {{ $attributes->merge(['class' => 'btn btn-circle btn-sm', 'form' => '']) }} type="submit">
    {{ $slot }}
</button>
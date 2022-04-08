<select {{ $attributes->merge(['class' => 'ui dropdown selection select_dropdown_modal']) }} x-init="$('.select_dropdown_modal').dropdown();">
    {{ $slot }}
</select>



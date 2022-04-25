<select {{ $attributes->merge(['class' => 'ui dropdown selection select_dropdown_modal'])->merge(['style'=>'']) }} x-init="$('.select_dropdown_modal').dropdown();">
    {{ $slot }}
</select>



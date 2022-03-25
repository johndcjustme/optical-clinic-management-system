<select {{ $attributes->merge(['class' => 'ui dropdown selection select_dropdown_modal']) }}>
    {{ $slot }}
</select>

<script>
    $('.select_dropdown_modal').dropdown();
</script>



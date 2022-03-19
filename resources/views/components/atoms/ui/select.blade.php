<select {{ $attributes->merge(['class' => 'ui dropdown selection select-dropdown']) }}>
    {{ $slot }}
</select>

<script>
    $('.select-dropdown').dropdown();
</script>



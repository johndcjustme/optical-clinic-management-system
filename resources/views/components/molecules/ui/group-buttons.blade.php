<div>
    <div class="mini ui basic buttons">
        {{ $slot }}
    </div>
</div>

<script>
    $('.dropdown')
    .dropdown({
        // you can use any ui transition
        transition: 'drop'
    })
    ;
</script>
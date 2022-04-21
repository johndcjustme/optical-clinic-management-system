<th {{ $attributes->merge(['style'=>''])->merge(['colspan'=>'']) }}>
    @if (!empty($label))
        <span>{{ $label }}</span>
        @if (!empty($orderBy))
            <div class="ui top left pointing tiny dropdown header_sort_table_tiny">
                <i class="fa-solid fa-caret-down pointer mx_3" style="padding: 0.1em 0.2em;"></i>
                <div class="menu">
                    <div wire:click.prevent="orderBy('{{ $orderBy }}', 'asc')" class="item">Asc</div>
                    <div wire:click.prevent="orderBy('{{ $orderBy }}', 'desc')" class="item">Desc</div>
                </div>
            </div>
        @endif        
    @else
        {{ $slot }}
    @endif
</th>

{{-- 
<script>
</script> --}}



<th {{ $attributes->merge(['style'=>''])->merge(['colspan'=>''])->merge(['class' => '']) }}>
    @if (!empty($label))
        {{ $label }}
        {{-- @if (!empty($orderBy))
            <div class="dropdown">
                <label tabindex="0">
                    <i class="fa-solid fa-caret-down pointer"></i>
                </label>
                <ul tabindex="0" class="menu">
                    <li wire:click.prevent="orderBy('{{ $orderBy }}', 'asc')"><a>Asc</a></li>
                    <li wire:click.prevent="orderBy('{{ $orderBy }}', 'desc')"><a>Desc</a></li>
                </ul>
            </div>
        @endif         --}}
    @endif
    {{ $slot }}
</th>


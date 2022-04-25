<tr class="{{ $this->lowStocks($item->id) ? 'warning' : '' }}">
    <x-organisms.ui.table.td 
        checkbox="selectedItems" 
        checkbox-value="{{ $item->id }}"/>
    <x-organisms.ui.table.td 
        text="{{ $item->item_name }}"
        desc="{{ $item->item_size ? $item->item_size . ' • ' : '' }} {{ $item->item_desc }}" />
    <x-organisms.ui.table.td>
        <div>
            <div class="ui top left pointing dropdown table-inventory-dropdown-image">
                <div x-init="$('.ui.dropdown').dropdown();" style="color: {{ $this->itemColor($item->item_type) }}">{{ $item->category->name ?? '' }}</div>
                <div class="menu">
                    <div class="item massive" style="width:7em; height:7em; background:url('{{ storage('items', $item->item_image) }}') no-repeat center; background-size:7em 7em"></div>
                </div>
            </div>
        </div>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td 
        text="{{ $item->supplier->supplier_name ?? '' }}"
        desc="{{ $item->supplier->supplier_address ?? '' }}"
        desc-icon="{{ isset($item->supplier->supplier_address) ? 'fa-location-dot' : '' }}" /> 
    <x-organisms.ui.table.td 
        {{-- text="{{ $this->stocks($item->id) }}"  --}}
        text="{{ $item->item_qty ?? 0 }}" 
        desc="Low Level: {{ $item->item_buffer ?? 0 }}"/>
    <x-organisms.ui.table.td
        text="{{ number_format($item->item_price) }}" 
        desc="{{ isset($item->item_cost) ? 'Cost: ' . $item->item_cost : ''; }}"
        text-icon="fa-peso-sign" />
    <x-organisms.ui.table.td>
        @if ($this->lowStocks($item->id))
            <span class="ui text red">
                <i class="fa-solid fa-circle-exclamation"></i>
            </span>
        @endif
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td-more>
        <x-atom.more.option
            wire-click="showModal('update', {{ $item->id }})"
            option-name="Edit" />
        <x-atom.more.option 
            wire-click="deletingItem({{ $item->id }})"
            option-name="Delete" />
    </x-organisms.ui.table.td>
</tr>
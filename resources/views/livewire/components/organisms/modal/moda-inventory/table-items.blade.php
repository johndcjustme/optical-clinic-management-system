<tr>
    <x-organisms.ui.table.td 
        checkbox="selectedItems" 
        checkbox-value="{{ $item->id }}"/>
    <x-organisms.ui.table.td>
        <span 
            @if (!empty($item->item_image))
                wire:click.prevent="showImage('{{ $item->item_image }}', '{{ $item->item_name }}', '{{ $item->category->name }}')" 
            @endif
            data-tooltip="{{ !empty($item->item_image) ? 'View Photo' : 'No Photo' }}" 
            data-position="top center" 
            data-variation="mini"
            data-inverted=""> 
            <i class="icon blue image"></i> 
        </span>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td 
        avatar="{{ storage('items', $item->item_image) }}"
        text="{{ $item->item_name }}"
        desc="{{ $item->item_size ? $item->item_size . ' • ' : '' }} {{ $item->item_desc }}" />
    <x-organisms.ui.table.td>
        <div class="ui {{ $item->category->cname }} empty circular label"></div>
        <span class="ui text {{ $item->category->cname }}">{{ $item->category->name ?? '' }}</span>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td 
        text="{{ $item->supplier->supplier_name ?? '' }}"
        desc="{{ $item->supplier->supplier_address ?? '' }}"
        desc-icon="{{ isset($item->supplier->supplier_address) ? 'fa-location-dot' : '' }}" /> 
    {{-- <x-organisms.ui.table.td 
        text="{{ $item->item_qty ?? 0 }}" 
        desc="Reserved: {{ $item->item_buffer ?? 0 }}"/> --}}
    <x-organisms.ui.table.td>
        <div class="ui icon right pointing floating dropdown" margin-left:0; margin-right:0; padding-left:0; padding:right:0" x-init="$('.ui.top.icon').dropdown()">
            <i class="dropdown icon" style="margin-left:0;"></i>
            <span>
                {{ $item->item_qty ?? 0 }}
                @if ($this->lowStocks($item->id))
                    <span class="ui text red" style="margin-left: 0.3em;">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </span>
                @endif
            </span>
            <div class="menu" style="">
                <form wire:submit.prevent="inItem({{ $item->id }})" class="x-flex x-flex-column" style="padding:0.7em; gap:0.5em; max-width: 13em;">
                    <x-atoms.ui.label>In/<i>Add</i> Stocks</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="item.in" type="number" min="0" placeholder="Enter number..."/>
                    <x-atoms.ui.label>Reserved</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="item.buffer" type="number" min="0" placeholder="{{ $item->item_buffer ?? 0 }}" style="width: 100%"/>
                    <button type="submit" class="ui button tiny secondary fluid">OK</button>
                </form>
                <div class="menu" style="z-index: 2"><div class="item"></div></div>
            </div>
        </div><br>
        <small style="opacity: 0.6">Reserved: {{ $item->item_buffer ?? 0 }}</small>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td
        text="{{ number_format($item->item_price) }}" 
        desc="{{ isset($item->item_cost) ? 'Cost: ' . $item->item_cost : ''; }}"
        text-icon="fa-peso-sign" />
    {{-- <x-organisms.ui.table.td>
        @if ($this->lowStocks($item->id))
            <span class="ui text red">
                <i class="fa-solid fa-circle-exclamation"></i>
            </span>
        @endif
    </x-organisms.ui.table.td> --}}
    <x-organisms.ui.table.td-more>
        <x-atom.more.option
            wire-click="showModal('update', {{ $item->id }})"
            option-name="Edit" />
        <x-atom.more.option 
            wire-click="deletingItem({{ $item->id }}, '{{ $item->item_name }}')"
            option-name="Delete" />
    </x-organisms.ui.table.td>
</tr>
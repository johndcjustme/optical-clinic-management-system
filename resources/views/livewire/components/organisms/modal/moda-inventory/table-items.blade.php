@php 
    $lowStocks = $this->lowStocks($item->id);
@endphp

<tr class="{{ $this->inOrderList($item->id) ? 'active' : '' }}">
    <x-organisms.ui.table.td 
        checkbox="selectedItems" 
        checkbox-value="{{ $item->id }}"/>
    <x-organisms.ui.table.td 
        view-photo="showImage('{{ $item->item_image }}', '{{ $item->item_name }}', '{{ $item->category->name }}')"
        avatar="{{ storage('items', $item->item_image) }}"
        text="{{ $item->item_name }}"
        desc="{{ $item->item_size ? $item->item_size . ' • ' : '' }} {{ $item->item_desc }}" />
    <x-organisms.ui.table.td>
        {{-- <div class="ui {{ $item->category->cname }} empty circular label"></div> --}}
        <span class="badge badge-sm badge-ghost"><i class="fa-solid fa-circle mr-2" style="color: {{ $item->category->cvalue }}"></i> {{ $item->category->name ?? '' }}</span>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td 
        text="{{ $item->supplier->supplier_name ?? '' }}"
        desc="{{ $item->supplier->supplier_address ?? '' }}"
        desc-icon="{{ isset($item->supplier->supplier_address) ? 'fa-location-dot' : '' }}"/>
    <x-organisms.ui.table.td>

        {{-- <div class="flex flex-col justify-center">
            <div class="font-bold">
                <i class="fa-solid {{ $textIcon }}" style="margin-right: 3px"></i> 
            </div>
            <div class="text-sm opacity-50">
                <i class="fa-solid {{ $descIcon }}" style="margin-right: 3px"></i> 
            </div>
        </div> --}}

        <div class="dropdown dropdown-left">
            <label tabindex="0" class="font-bold cursor-pointer {{ $lowStocks ? 'text-red-600' : '' }}">
                <i class="fa-solid fa-caret-down mr-1"></i> 
                {{ empty($item->item_qty) ? '0' : $item->item_qty  }}
            </label>
            <ul tabindex="0" class="dropdown-content menu p-4 mr-2 shadow-xl bg-base-100 rounded-box w-52">
                <form wire:submit.prevent="inItem({{ $item->id }})">
                    <x-atoms.ui.label>In/<i>Add</i> Stocks</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="item.in" type="number" min="0" placeholder="Enter number..." class="input-sm w-full mb-1"/>
                    <x-atoms.ui.label>Reserved</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="item.buffer" type="number" min="0" placeholder="{{ $item->item_buffer ?? 0 }}" class="input-sm w-full"/>
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm w-full mt-5">OK</button>
                    </div>
                </form>
            </ul>
        </div>

        <div class="text-sm opacity-50">
            <i class="fa-solid " style="margin-right: 3px"></i> 
            Low level: <b>{{ $item->item_buffer ?? 0 }}</b>
        </div>

        {{-- <div class="ui icon right pointing floating dropdown" margin-left:0; margin-right:0; padding-left:0; padding:right:0" x-init="$('.ui.top.icon').dropdown()">
            <i class="dropdown icon {{ $lowStocks ? 'inverted red' : '' }}" style="margin-left:0;"></i>
            <span>
                <span class="ui text {{ $lowStocks ? 'red' : '' }}">
                    {{ empty($item->item_qty) ? '0' : $item->item_qty  }}
                </span>
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
        <small style="opacity: 0.6">Low level: <b>{{ $item->item_buffer ?? 0 }}</b></small> --}}
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
        @if ($this->inOrderList($item->id))
            <x-atom.more.option 
                wire-click="removeFromOrderList({{ $item->id }})"
                option-name="Remove from order list" />
        @else
            <x-atom.more.option 
                wire-click="addOrderItem({{ $item->id }})"
                option-name="Add to order list" />
        @endif
    </x-organisms.ui.table.td>
</tr>
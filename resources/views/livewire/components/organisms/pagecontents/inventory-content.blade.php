{{-- @php

    if ($subPage == 1) {
        $countLowStocks = [];
    
        foreach (App\Models\Item::select(['item_qty', 'item_buffer'])->whereColumn('item_qty', '<=', 'item_buffer')->get() as $item) {
            $countLowStocks[] = $item;
        }
        $countLowStocks = count($countLowStocks);
    }

@endphp --}}



<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Inventory"
            desc="Lorem Ipsum dolor sit amet."/>
    @endsection

    @section('section-links')
        <x-organisms.ui.tabs>
            <x-organisms.ui.tabs.tab wire:click.prevent="$set('subPage', 1)" class="{{ $this->activePage(1) }}">
                <div class="dropdown">{{ $this->tabDisplayActiveItem($onDisplayItemType) }}
                    <label tabindex="0" class="ml-2"><i class="fa-solid fa-caret-down"></i></label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-lg rounded-box w-40 mt-3 bg-neutral">
                        <li><a wire:click.prevent="$set('onDisplayItemType', 'all')" class="text-white">All Items<span class="badge bg-info-content badge-md">{{ $this->countItems('all') }}</span></a></li>
                        @foreach ($categories as $category)
                            <li><a wire:click.prevent="$set('onDisplayItemType', {{ $category->id }})" class="text-white">{{ $category->name }}<span class="badge bg-info-content badge-md">{{ $this->countItems($category->id) }}</span></a></li>
                        @endforeach
                    </ul>
                </div>   
            </x-organisms.ui.tabs.tab>
            <x-organisms.ui.tabs.tab wire:click.prevent="$set('subPage', 3)" class="{{ $this->activePage(3) }}">
                In-Out
            </x-organisms.ui.tabs.tab>
            <x-organisms.ui.tabs.tab wire:click.prevent="$set('subPage', 5)" class="{{ $this->activePage(5) }}">
                Category
            </x-organisms.ui.tabs.tab>
            <x-organisms.ui.tabs.tab wire:click.prevent="$set('subPage', 4)" class="{{ $this->activePage(4) }}">
                Order List
            </x-organisms.ui.tabs.tab>
        </x-organisms.ui.tab>
    @endsection



        
    @section('section-heading-left')

            @switch($subPage)
                @case(1)
                    <div>
                        @if (count($selectedItems) > 0)
                            <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedItems', [])" class="left pointing tiny">
                                <x-slot name="label">
                                    {{ count($selectedItems) }} Selected 
                                </x-slot>
                                <x-slot name="menu"> 
                                    <li wire:click.prevent="deletingItems" class="item">
                                        <a>
                                            <i class="fa-solid fa-remove"></i> Delete
                                        </a>
                                    </li>
                                    <div class="divider mt-3 mb-3"></div>
                                    <li wire:click.prevent="batchAddOrderItem">
                                        <a>
                                            <i class="fa-solid fa-add"></i> Add to order list
                                        </a>
                                    </li>
                                    <li wire:click.prevent="batchRemoveFromOrderList">
                                        <a>
                                            <i class="fa-solid fa-remove"></i> Remove from order list
                                        </a>
                                    </li>
                                </x-slot>
                            </x-atoms.ui.header-dropdown-menu>
                        @else
                            <x-atoms.ui.header-add-btn label="Add item" wire-click="showModal('add', null)"/>
                        @endif

                    </div>
                    {{-- <div>
                        @if ($countLowStocks != 0)
                            <x-atoms.ui.btn wire-click="$toggle('filterLowStocks')" class="{{ $filterLowStocks ? 'btn-active' : '' }}"> 
                                    Lower Stocks 
                                    @if (! $filterLowStocks && ($countLowStocks != 0))
                                        <span class="indicator-item badge bg-secondary ml-1">{{ $countLowStocks }}</span>
                                    @endif
                            </x-atoms.ui.btn>
                        @endif
                    </div> --}}
                    @break
                @case(2)
                    @break

                @case(3)
                    {{-- <div class="ui buttons">
                        <x-atoms.ui.header-add-btn label="Add Item" wire-click="showModal('add', null)"/>
                        <x-atoms.ui.header-add-btn icon="right arrow" label="In Item" wire-click="showModal('inItem', null)"/>
                    </div> --}}
                    {{-- <x-atoms.ui.header-add-btn label="In Item" wire-click="showModal('inItem', null)"/> --}}
                    @break
                @case(4)
                    <div>
                        @if (count($selectedItems) > 0)
                            <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedItems', [])" class="left pointing tiny">
                                <x-slot name="label">
                                    {{ count($selectedItems) }} Selected 
                                </x-slot>
                                <x-slot name="menu"> 
                                    <li wire:click.prevent="deleteOrderItems" class="item">
                                        <a>
                                            <i class="fa-solid fa-remove"></i> Delete
                                        </a>
                                    </li>
                                </x-slot>
                            </x-atoms.ui.header-dropdown-menu>
                        @else
                            <button wire:click.prevent="savePdf" class="btn"><i class="fa-solid fa-download mr-2"></i> Download pdf</button>
                        @endif
                    </div>
                    @break
                @case(5)
                    <x-atoms.ui.header-add-btn label="Category" wire-click="showModal('addCategory', null)"/>
                    @break
                        
            @endswitch
        @endsection

        

        @section('section-heading-right')
            @switch($subPage)
                @case(1) 
                    <div> 
                        <x-atoms.ui.search wire-model="searchItem" placeholder="Search..."/> 
                    </div>
                    <x-organisms.ui.dropdown-end>
                        <li wire:click.prevent="$toggle('filterLowStocks')" class="{{ $countLowStocks == 0 ? 'disabled' : '' }}">
                            <a class="">{{ !$filterLowStocks ? 'Show' : 'Hide'  }} lower stocks <span class="opacity-50">{{ $countLowStocks }}</span></a>
                        </li>
                        <x-organisms.ui.dropdown-entries :pagenumber="$pageNumber"/>
                    </x-organisms.ui.dropdown-end>
                    @break
                {{-- @case(2) <div> <x-atoms.ui.search wire-model="searchSupplier" placeholder="Search..."/> </div> @break --}}
                @case(3)  
                    @if ($showInOut)
                        <div class="btn-group">
                            <x-atoms.ui.button wire:click.prevent="$set('sort', 'asc')" class="{{ $sort == 'asc' ? 'btn-active' : '' }}">Asc</x-atoms.ui.button>
                            <x-atoms.ui.button wire:click.prevent="$set('sort', 'desc')" class="{{ $sort == 'desc' ? 'btn-active' : '' }}">Desc</x-atoms.ui.button>
                        </div>
                    @endif
                    <x-organisms.ui.dropdown-end>
                        <x-organisms.ui.dropdown-entries :pagenumber="$pageNumber"/>
                    </x-organisms.ui.dropdown-end>
                    @break
                @default
            @endswitch
        @endsection



        @section('section-main')
            @switch($subPage)
                @case(1)
                    <x-organisms.ui.table class="">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="Name" order-by="item_name" />
                            <x-organisms.ui.table.th label="Category" order-by="item_type" />
                            <x-organisms.ui.table.th label="Supplier"/>
                            <x-organisms.ui.table.th label="On Hand" order-by="item_qty" />
                            <x-organisms.ui.table.th label="Price" order-by="item_price" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                                @foreach ($items as $item)
                                    @include('livewire.components.organisms.modal.moda-inventory.table-items')
                                @endforeach
                        </x-slot>
                    </x-organisms.ui.table>
                    {{ $items->links('livewire.components.paginator') }}
                @break

                @case(2)
                    {{-- <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                            <x-organisms.ui.table.th label="Contact" order-by="item_type" />
                            <x-organisms.ui.table.th label="Account" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($suppliers as $su)
                                <tr>
                                    <x-organisms.ui.table.td 
                                        checkbox="selectedSuppliers" 
                                        checkbox-value="{{ $su->id }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $su->supplier_name }}"
                                        desc="{{ isset($su->supplier_branch) ? $su->supplier_branch . ' • ' : '' }} {{ $su->supplier_address }}"
                                        desc-icon="fa-location-dot"
                                        avatar="{{ $this->storage('avatars', $su->supplier_avatar) }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $su->supplier_contact_no }}"
                                        desc="{{ $su->supplier_email }}"
                                        desc-icon="fa-envelope"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $su->supplier_bank }}"
                                        desc="{{ $su->supplier_acc_no }}"/>
                                    <x-organisms.ui.table.td-more>
                                        <x-atom.more.option
                                            wire-click="showModal('update', 'supplier', {{ $su->id }})"
                                            option-name="Edit" />
                                        <x-atom.more.option 
                                            wire-click="deletingSupplier({{ $su->id }})"
                                            option-name="Delete" />
                                    </x-organisms.ui.table.td>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse
                        </x-slot>
                    </x-organisms.ui.table> --}}
                    @break

                @case(3)

                    @if ($showInOut)
                        <div class="flex items-center gap-4 mb-10">
                            <div>
                                <x-atoms.ui.button wire:click.prevent="$set('showInOut', false)" class="btn-circle btn-ghost btn-sm"><i class="fa-solid fa-arrow-left"></i></x-atoms.ui.button>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold">
                                    {{ $this->item['name'] ?? '' }}
                                </h2>
                                @if (!empty($this->item['desc']))
                                    <p class="opacity-40">{{ $this->item['desc'] ?? '' }}</p>
                                @endif
                            </div>
                        </div>

                        <x-organisms.ui.table class="selectable">
                            <x-slot name="thead">
                                <x-organisms.ui.table.th label="Date" style="50%"/>
                                <x-organisms.ui.table.th label="In" style="width: 20%"/>
                                <x-organisms.ui.table.th label="Out" style="width: 20%"/>
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($show_in_out_of_item as $item)
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            text="{{ humanReadableDate($item->created_at) }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ $item->status == true ? $item->qty : '' }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ $item->status == false ? $item->qty : '' }}"/>
                                        <x-organisms.ui.table.td-more>
                                            <x-atom.more.option
                                                wire-click="showModal('update', 'supplier', 'ID HERE')"
                                                option-name="View" />
                                        </x-organisms.ui.table.td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                        {{ $show_in_out_of_item->links('livewire.components.paginator') }}


                    @else

                        <x-organisms.ui.table class="selectable">
                            <x-slot name="thead">
                                <x-organisms.ui.table.th label="Date" style="width:13em"/>
                                <x-organisms.ui.table.th label="Item Name"/>
                                <x-organisms.ui.table.th label="IN" />
                                <x-organisms.ui.table.th label="OUT" />
                                <x-organisms.ui.table.th label="Balance" />
                                <x-organisms.ui.table.th label="" />
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">

                                @foreach ($items as $item)
                                    @foreach (App\Models\In_out_of_item::select(['item_id'])->where('item_id', $item->id)->latest()->limit(1)->get() as $thiss)
                                        <tr>
                                            <x-organisms.ui.table.td 
                                                text="{{ humanReadableDate($item->created_at) }}"/>
                                            <x-organisms.ui.table.td 
                                                text="{{ $item->item_name }}" 
                                                desc="{{ $item->item_desc }}"/>
                                            <x-organisms.ui.table.td 
                                                text="{{ $this->totalIn($item->id) }}"/>
                                            <x-organisms.ui.table.td 
                                                text="{{ $this->totalOut($item->id) }}"/>
                                            <x-organisms.ui.table.td>
                                                {{-- <div class="ui icon right pointing floating dropdown" style="margin-left:0; margin-right:0; padding-left:0; padding:right:0;" x-init="$('.ui.top.icon').dropdown()">
                                                    <i class="dropdown icon" style="margin-left:0;"></i>
                                                    <span>
                                                        <span class="ui text">
                                                            {{ $item->item_qty ?? 0 }}
                                                        </span>
                                                    </span>
                                                    <div class="menu" style="width:250px;">
                                                        <div class="ui icon search input">
                                                            <table style="width: 100%;" class="ui table very basic">
                                                                <tr>
                                                                    <th style="width:60%">Date</th>
                                                                    <th style="width:20%">In</th>
                                                                    <th style="width:20%">Qty</th>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="menu scrolling">
                                                            @foreach (App\Models\In_out_of_item::select(['status', 'qty', 'created_at'])->where('item_id', $item->id)->get() as $hey)
                                                                <div class="item">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td style="width:60%;">{{ humanReadableDate($hey->created_at) }}</td>
                                                                            <td style="width:20%">{{ $hey->status ? 'IN' : 'O' }}</td>
                                                                            <td style="width:20%">{{ $hey->qty }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div><br> --}}
                                            </x-organisms.ui.table.td> 

                                            <x-organisms.ui.table.td>
                                                <x-atoms.ui.button wire:click.prevent="showInOut({{ $item->id }})" class="btn-circle btn-sm btn-primary">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </x-atoms.ui.button>
                                                {{-- <button  class="ui button tiny icon circular">
                                                </button> --}}
                                            </x-organisms.ui.table.td>
                                            <x-organisms.ui.table.td-more>
                                                <x-atom.more.option
                                                    wire-click="showModal('update', 'supplier', 'ID HERE')"
                                                    option-name="View" />
                                            </x-organisms.ui.table.td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                {{-- @forelse ($item_items as $item)
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            text="{{ humanReadableDate($item->created_at) }}" 
                                            desc="{{ humanReadableTime($item->created_at) }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ $item->item->item_name }}" 
                                            desc="{{ $item->item->item_desc }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ $item->status ? $item->qty : '' }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ $item->status ? '' : $item->qty }}"/>
                                        <x-organisms.ui.table.td-more>
                                            <x-atom.more.option
                                                wire-click="showModal('update', 'supplier', 'ID HERE')"
                                                option-name="View" />
                                        </x-organisms.ui.table.td>
                                    </tr>
                                @empty
                                    <x-organisms.ui.table.search-no-results colspan="7"/>
                                @endforelse --}}
                            </x-slot>
                        </x-organisms.ui.table>
                        {{-- {{ $item_items->links('livewire.components.paginator') }} --}}
                    @endif
                   

                    @break

                @case(4)
                    @if (count($orders) > 0)
                        <x-organisms.ui.table class="selectable">
                            <x-slot name="thead">
                                {{-- <x-organisms.ui.table.th label="Date" order-by="item_name"/> --}}
                                <x-organisms.ui.table.th-checkbox/>
                                <x-organisms.ui.table.th label="Item Name" />
                                <x-organisms.ui.table.th label="Description" />
                                <x-organisms.ui.table.th label="Size" />
                                <x-organisms.ui.table.th label="Category" />
                                <x-organisms.ui.table.th label="Quantity" />
                                {{-- <x-organisms.ui.table.th label="Out" /> --}}
                                {{-- <x-organisms.ui.table.th label="Balance" /> --}}
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($orders as $order)
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            checkbox="selectedItems" 
                                            checkbox-value="{{ $order->id }}"/>
                                        <x-organisms.ui.table.td text="{{ $order->item->item_name }}"/>
                                            <x-organisms.ui.table.td text="{{ $order->item->item_desc }}"/>
                                        <x-organisms.ui.table.td text="{{ $order->item->item_size }}"/>
                                        <x-organisms.ui.table.td text="{{ $order->item->category->name }}"/>
                                        <x-organisms.ui.table.td>
                                            <div class="dropdown dropdown-left">
                                                <label tabindex="0" class="font-bold cursor-pointer">
                                                    <i class="fa-solid fa-caret-down mr-1"></i> 
                                                    {{ empty($order->qty) ? '0' : $order->qty  }}
                                                </label>
                                                <ul tabindex="0" class="dropdown-content menu p-4 mr-2 shadow-xl bg-base-100 rounded-box w-52">
                                                    <form wire:submit.prevent="addOrderItemQty({{ $order->id }})">
                                                        {{-- <x-atoms.ui.label>In/<i>Add</i> Stocks</x-atoms.ui.label> --}}
                                                        <x-atoms.ui.input wire-model="orderItemQty" type="number" min="0" placeholder="Enter qty..." class="input-sm w-full mb-1" required/>
                                                        <div>
                                                            <button type="submit" class="btn btn-primary btn-sm w-full mt-5">OK</button>
                                                        </div>
                                                    </form>
                                                </ul>
                                            </div>
                                        </x-organisms.ui.table.td>
                                        <x-organisms.ui.table.td-more>
                                            {{-- <x-atom.more.option
                                                wire-click="showModal('update', 'supplier', 'ID HERE')"
                                                option-name="Edit"/> --}}
                                            <x-atom.more.option 
                                                wire-click="deleteOrderItem({{ $order->id }})"
                                                option-name="Remove" />
                                        </x-organisms.ui.table.td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                    @else 
                    Empty here
                    @endif

                    @break
                @case(5)
                    @if (count($categories) > 0)
                        <x-organisms.ui.table class="selectable">
                            <x-slot name="thead">
                                <x-organisms.ui.table.th label="Indicator" style="width:10em"/>
                                <x-organisms.ui.table.th label="Name" />
                                <x-organisms.ui.table.th label="Description" />
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($categories as $category)
                                    <tr>
                                        <x-organisms.ui.table.td>

                                            <x-organisms.ui.dropdown class="dropdown-right" style="width:8em;">
                                                <x-organisms.ui.dropdown.dropdown-label>
                                                    <i class="fa-solid fa-circle mr-2" style="color: {{ $category->cvalue }}"></i>
                                                    Select
                                                    <i class="fa-solid fa-caret-down ml-2"></i>
                                                </x-organisms.ui.dropdown.dropdown-label>
                                                <x-organisms.ui.dropdown.dropdown-content class="ml-2" style="height: 20em; overflow-y:auto">
                                                    @foreach (colors() as $color)
                                                        <li wire:click.prevent="setColor('{{ $category->id }}', '{{ $color['value'] }}', '{{ $color['name'] }}')" class="item">
                                                            <a>
                                                                <i class="fa-solid fa-circle mr-2" style="color: {{ $color['value'] }}"></i>
                                                                {{ Str::title($color['name']) }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </x-organisms.ui.dropdown.dropdown-content>

                                            </x-organisms.ui.dropdown.dropdown-content>
                                            {{-- <div class="dropdown dropdown-right">
                                                <label tabindex="0" class="btn m-1">Click</label>
                                                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                                  <li><a>Item 1</a></li>
                                                  <li><a>Item 2</a></li>
                                                </ul>
                                            </div> --}}



                                            {{-- <div class="ui dropdown">
                                                <div class="ui {{ $category->cname }} empty circular label" style="margin-right: 0.5em"></div>
                                                <span style="color:{{ $category->cvalue }}">{{ $category->cname }}</span>
                                                <div class="menu">
                                                    <div class="scrolling menu">
                                                        <div class="header">
                                                            <i class="pen icon"></i>
                                                            Choose Color
                                                        </div>
                                                        <div class="ui divider"></div>
                                                        @foreach (colors() as $color)
                                                            <div wire:click.prevent="setColor('{{ $category->id }}', '{{ $color['value'] }}', '{{ $color['name'] }}')" class="item">
                                                                <div class="ui {{ $color['name'] }} empty circular label"></div>
                                                                {{ Str::title($color['name']) }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </x-organisms.ui.table.td>
                                        <x-organisms.ui.table.td 
                                            text="{{ $category->name }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ !empty($category->desc) ? $category->desc : '-' }}"/>
                                        <x-organisms.ui.table.td-more>
                                            <x-atom.more.option
                                                wire-click="showModal('updateCategory', {{ $category->id}})"
                                                option-name="Edit" />
                                            <x-atom.more.option 
                                                wire-click="deletingCategory({{ $category->id }}, '{{ $category->name }}')"
                                                option-name="Delete"/>
                                        </x-organisms.ui.table.td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                    @else
                        <x-atoms.ui.message 
                            icon="frown open"
                            class="mt_20"
                            header="No category added yet."
                            message="This section will contain categories of your inventory."/>
                    @endif
                    @break
                @default
            @endswitch
        @endsection

</x-layout.page-content>


<script>
    $('.ui.dropdown').dropdown();
</script>

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

        <div class="ui compact tiny menu" style="z-index:5;" x-init="$('ui.floating.labeled').dropdown()">
            <div class="item {{ $this->activePage(1) }}">
                <div class="ui transparent" style="display: flex">
                    <div wire:click.prevent="$set('subPage', 1)" class="ui mini transparent" style="display: flex;">
                        {{ $this->tabDisplayActiveItem($onDisplayItemType) }} <div class="ui description ml_3" style="opacity: 0.6">{{ $this->countItems($onDisplayItemType) }}</div> 
                    </div>
                    <div class="ui floating dropdown icon">
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div wire:click.prevent="$set('onDisplayItemType', 'all')" data-value="all" class="item"><span class="text">All Items</span><span class="description">{{ $this->countItems('all') }}</span></div>
                        @foreach ($categories as $category)
                            <div wire:click.prevent="$set('onDisplayItemType', {{ $category->id }})" data-value="all" class="item"><span class="text">{{ $category->name }}</span><span class="description">{{ $this->countItems($category->id) }}</span></div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
            <div wire:click.prevent="$set('subPage', 3)" class="item {{ $this->activePage(3) }}">In Out</div>
            <div wire:click.prevent="$set('subPage', 5)" class="item {{ $this->activePage(5) }}">Categories</div>
            <div wire:click.prevent="$set('subPage', 4)" class="item {{ $this->activePage(4) }}">Purchase</div>
        </div>
    @endsection



        
    @section('section-heading-left')

            @switch($subPage)
                @case(1)
                    @if (count($selectedItems) > 0)
                        <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedItems', [])" class="left pointing tiny">
                            <x-slot name="label">
                                {{ count($selectedItems) }} Selected 
                            </x-slot>
                            <x-slot name="menu"> 
                                <div wire:click.prevent="deletingItems" class="item"><i class="delete icon"></i> Delete</div>
                            </x-slot>
                        </x-atoms.ui.header-dropdown-menu>
                    @else
                        <x-atoms.ui.header-add-btn label="Add Item" wire-click="showModal('add', null)"/>
                    @endif
                    <div>
                        <div class="ui buttons basic tiny">
                            @if ($countLowStocks != 0)
                                <button wire:click.prevent="$toggle('filterLowStocks')" class="ui button {{ $filterLowStocks ? 'active' : '' }}" style="position: relative"><i class="icon eye {{ $filterLowStocks ? 'show' : 'hide' }}"></i> 
                                    Lower Stocks
                                    @if (! $filterLowStocks && ($countLowStocks != 0))
                                        <small style="position: absolute; top:-3px; right:-3px; height:15px; width:15px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center">{{ $countLowStocks }}</small>
                                    @endif
                                </button>
                            @endif
                        </div>
                    </div>
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
                @case(5)
                    <x-atoms.ui.header-add-btn label="Add Category" wire-click="showModal('addCategory', null)"/>
                    @break
                        
            @endswitch
        @endsection

        

        @section('section-heading-right')
            @switch($subPage)
                @case(1) 
                    <div> 
                        <x-atoms.ui.search wire-model="searchItem" placeholder="Search..."/> 
                    </div> 
                    <x-atoms.ui.header-dropdown-menu class="right pointing tiny">
                        <x-slot name="menu"> 
                            <div class="item">
                                <x-molecules.ui.dropdown.icon/>
                                <span class="text">Filter</span>
                                <x-molecules.ui.dropdown.menu>
                                    <div wire:click.prevent="" class="item">Low Stock</div>
                                    <div class="item">sd</div>
                                    <div class="item">sd</div>
                                </x-molecules.ui.dropdown.menu>
                            </div>
                            <x-atoms.ui.header-dropdown-entries/>
                            <div class="item">
                                <x-molecules.ui.dropdown.icon/>
                                <span class="text">{{ $pageNumber }} Entries</span>
                                <x-molecules.ui.dropdown.menu>
                                    <x-organisms.ui.paginator-number/>
                                </x-molecules.ui.dropdown.menu>
                            </div>
                        </x-slot>
                    </x-atoms.ui.header-dropdown-menu>
                    @break
                {{-- @case(2) <div> <x-atoms.ui.search wire-model="searchSupplier" placeholder="Search..."/> </div> @break --}}
                @case(3)  
                    <div class="ui buttons basic tiny">
                        <button wire:click.prevent="$set('sort', 'asc')" class="ui button {{ $sort == 'asc' ? 'active' : '' }}">Asc</button>
                        <button wire:click.prevent="$set('sort', 'desc')" class="ui button {{ $sort == 'desc' ? 'active' : '' }}">Desc</button>
                    </div>
                    {{-- <div class="ui buttons basic tiny">
                        <button wire:click.prevent="$set('status', 'all')" class="ui button {{ $status == 'all' ? 'active' : '' }}">All</button>
                        <button wire:click.prevent="$set('status', 'in')" class="ui button {{ $status == 'in' ? 'active' : '' }}">In</button>
                        <button wire:click.prevent="$set('status', 'out')" class="ui button {{ $status == 'out' ? 'active' : '' }}">Out</button>
                    </div> --}}
                    <x-atoms.ui.header-dropdown-menu class="right pointing tiny">
                        <x-slot name="menu"> 
                            <x-atoms.ui.header-dropdown-entries/>
                            <div class="item">
                                <x-molecules.ui.dropdown.icon/>
                                <span class="text">{{ $pageNumber }} Entries</span>
                                <x-molecules.ui.dropdown.menu>
                                    <x-organisms.ui.paginator-number/>
                                </x-molecules.ui.dropdown.menu>
                            </div>
                        </x-slot>
                    </x-atoms.ui.header-dropdown-menu>
                    @break
                @default
            @endswitch
        @endsection



        @section('section-main')
            @switch($subPage)
                @case(1)
                    <x-organisms.ui.table class="selectable unstackable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="" style="width:1em" />
                            <x-organisms.ui.table.th label="Name" order-by="item_name" />
                            <x-organisms.ui.table.th label="Category" order-by="item_type" />
                            <x-organisms.ui.table.th label="Supplier"/>
                            <x-organisms.ui.table.th label="On Hand" order-by="item_qty" />
                            <x-organisms.ui.table.th label="Price" order-by="item_price" />
                            {{-- <x-organisms.ui.table.th style="width:1em" /> --}}
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            {{-- @if($filterLowStocks)
                                @foreach ($items as $item)
                                    @if ($item->item_qty <= $item->item_buffer)
                                        @include('livewire.components.organisms.modal.moda-inventory.table-items')
                                    @endif
                                @endforeach
                            @else --}}
                                @foreach ($items as $item)
                                    {{-- @if ($item->item_qty > $item->item_buffer) --}}
                                        @include('livewire.components.organisms.modal.moda-inventory.table-items')
                                    {{-- @endif --}}
                                @endforeach
                            {{-- @endif --}}
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
                        <div class="x-flex x-flex-ycenter x-gap-1">
                            <div>
                                <button wire:click.prevent="$set('showInOut', false)" class="ui button circular secondary icon tiny"><i class="icon angle left"></i></button>
                            </div>
                            <div>
                                <h2 class="ui header">
                                    {{ $this->item['name'] ?? '' }}
                                    <div class="sub header">{{ $this->item['desc'] ?? '' }}</div>
                                </h2>
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
                                                text="{{ humanReadableDate($item->created_at) }}" 
                                                desc="{{ humanReadableTime($item->created_at) }}"/>
                                            <x-organisms.ui.table.td 
                                                text="{{ $item->item_name }}" 
                                                desc="{{ $item->item_desc }}"/>
                                            <x-organisms.ui.table.td 
                                                text="{{ $this->totalIn($item->id) }}"/>
                                            <x-organisms.ui.table.td 
                                                text="{{ $this->totalOut($item->id) }}"/>
                                            <x-organisms.ui.table.td>
                                                <div class="ui icon right pointing floating dropdown" style="margin-left:0; margin-right:0; padding-left:0; padding:right:0;" x-init="$('.ui.top.icon').dropdown()">
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
                                                </div><br>
                                            </x-organisms.ui.table.td> 

                                            <x-organisms.ui.table.td>
                                                <button wire:click.prevent="showInOut({{ $item->id }})" class="ui button tiny icon circular"><i class="icon angle right"></i></button>
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
                    
                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th label="Date" order-by="item_name"/>
                            <x-organisms.ui.table.th label="Item" />
                            <x-organisms.ui.table.th label="Category" />
                            <x-organisms.ui.table.th label="Out" />
                            <x-organisms.ui.table.th label="Balance" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-organisms.ui.table.td desc="Jan 15, 2021"/>
                                <x-organisms.ui.table.td text="jerjehrjher"/>
                                <x-organisms.ui.table.td text="Lense"/>
                                <x-organisms.ui.table.td text="2"/>
                                <x-organisms.ui.table.td text="8"/>
                                <x-organisms.ui.table.td-more>
                                    <x-atom.more.option
                                        wire-click="showModal('update', 'supplier', 'ID HERE')"
                                        option-name="Edit" />
                                    <x-atom.more.option 
                                        wire-click="deletingSupplier('ID HERE')"
                                        option-name="Delete" />
                                </x-organisms.ui.table.td>
                            </tr>
                        </x-slot>
                    </x-organisms.ui.table>

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
                                            <div class="ui dropdown">
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
                                            </div>
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

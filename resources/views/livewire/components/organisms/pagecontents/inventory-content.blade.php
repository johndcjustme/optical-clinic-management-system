<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Inventory"
            desc="Lorem Ipsum dolor sit amet."/>
    @endsection

    @section('section-links')

        <div class="ui compact tiny menu" style="z-index:1;" x-init="$('ui.floating.labeled').dropdown()">
            <div class="item {{ $this->activePage(1) }}">
                <div class="ui transparent" style="display: flex">
                    <div wire:click.prevent="$set('subPage', 1)" class="ui mini transparent" style="display: flex;">
                        {{ $this->tabDisplayActiveItem($onDisplayItemType) }} <div class="ui description ml_3" style="opacity: 0.6">{{ $this->countItems($onDisplayItemType) }}</div> 
                        {{-- {{ App\Models\Category::where('id', $onDisplayItemType)->first()->name; }} --}}
                        {{-- @switch($onDisplayItemType)
                            @case('all') All Items<div class="ui description ml_3" style="opacity: 0.6"></div> @break
                            @case('le') Lenses <div class="ui description ml_3" style="opacity: 0.6"></div> @break
                            @case('fr') Frames <div class="ui description ml_3" style="opacity: 0.6"></div> @break
                            @case('ac') Accessories <div class="ui description ml_3" style="opacity: 0.6">{{ $this->countItems('ac') }}</div> @break
                            @default
                        @endswitch --}}
                    </div>
                    <div class="ui floating dropdown icon">
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div wire:click.prevent="$set('onDisplayItemType', 'all')" data-value="all" class="item"><span class="text">All Items</span><span class="description">{{ $this->countItems('all') }}</span></div>
                        @foreach ($categories as $category)
                            <div wire:click.prevent="$set('onDisplayItemType', {{ $category->id }})" data-value="all" class="item"><span class="text">{{ $category->name }}</span><span class="description">{{ $this->countItems($category->id) }}</span></div>
                        @endforeach
                        {{-- <div wire:click.prevent="$set('onDisplayItemType', 'le')" data-value="le" class="item"><span class="text">Lense</span><span class="description">{{ $this->countItems('le') }}</span></div>
                        <div wire:click.prevent="$set('onDisplayItemType', 'fr')" data-value="fr" class="item"><span class="text">Frame</span><span class="description">{{ $this->countItems('fr') }}</span></div>
                        <div wire:click.prevent="$set('onDisplayItemType', 'ac')" data-value="ac" class="item"><span class="text">Accessory</span><span class="description">{{ $this->countItems('ac') }}</span></div> --}}
                    </div>
                    </div>
                </div>
            </div>
            <div wire:click.prevent="$set('subPage', 3)" class="item {{ $this->activePage(3) }}">In Items</div>
            <div wire:click.prevent="$set('subPage', 4)" class="item {{ $this->activePage(4) }}">Out Items</div>
            <div wire:click.prevent="$set('subPage', 5)" class="item {{ $this->activePage(5) }}">Categories</div>
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
                        <x-atoms.ui.header-add-btn icon="right arrow" label="In Item" wire-click="showModal('inItem', null)"/>
                    @endif
                    @break
                    
                @case(2)
                    @break

                @case(3)
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
                            <div class="item">
                                <x-molecules.ui.dropdown.icon/>
                                <span class="text">Showing {{ $pageNumber }} Entries</span>
                                <x-molecules.ui.dropdown.menu>
                                    <x-organisms.ui.paginator-number/>
                                </x-molecules.ui.dropdown.menu>
                            </div>
                        </x-slot>
                    </x-atoms.ui.header-dropdown-menu>
                    @break
                {{-- @case(2) <div> <x-atoms.ui.search wire-model="searchSupplier" placeholder="Search..."/> </div> @break --}}
                @case(3)  
                    <x-atoms.ui.header-dropdown-menu class="right pointing tiny">
                        <x-slot name="menu"> 
                            <div class="item">
                                <x-molecules.ui.dropdown.icon/>
                                <span class="text">Showing {{ $pageNumber }} Entries</span>
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
                            <x-organisms.ui.table.th label="Supplier" />
                            <x-organisms.ui.table.th label="Stocks" order-by="item_qty" />
                            <x-organisms.ui.table.th label="Price" order-by="item_price" />
                            <x-organisms.ui.table.th style="width:1em" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach ($items as $item)
                                @if ($item->item_qty <= $item->item_buffer)
                                    @include('livewire.components.organisms.modal.moda-inventory.table-items')
                                @endif
                            @endforeach
                            @foreach ($items as $item)
                                @if ($item->item_qty > $item->item_buffer)
                                    @include('livewire.components.organisms.modal.moda-inventory.table-items')
                                @endif
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
                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th label="Item" order-by="item_type" />
                            <x-organisms.ui.table.th label="Status" />
                            <x-organisms.ui.table.th label="Qty" />
                            <x-organisms.ui.table.th label="Balance" />
                            <x-organisms.ui.table.th label="Date" order-by="item_name" style="width:15em"/>
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($in_out_items as $in_out)
                                <tr>
                                    <x-organisms.ui.table.td 
                                        text="{{ $in_out->item->item_name }}" 
                                        desc="{{ $in_out->item->item_desc }}"/>
                                    <x-organisms.ui.table.td text="{{ $in_out->status ? 'IN' : 'OUT' }}"/>
                                    <x-organisms.ui.table.td text="{{ $in_out->qty }}"/>
                                    <x-organisms.ui.table.td text="{{ $in_out->balance }}"/>
                                    <x-organisms.ui.table.td text="{{ humanReadableDate($in_out->created_at) }}" desc="{{ humanReadableTime($in_out->created_at) }}"/>
                                    <x-organisms.ui.table.td-more>
                                        <x-atom.more.option
                                            wire-click="showModal('update', 'supplier', 'ID HERE')"
                                            option-name="View" />
                                    </x-organisms.ui.table.td>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse
                        </x-slot>
                    </x-organisms.ui.table>
                    {{ $in_out_items->links('livewire.components.paginator') }}
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

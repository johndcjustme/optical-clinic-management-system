<x-layout.page-content>
    {{-- head --}}

    @section('section-page-title', 'Inventory')

    @section('section-links')
        <x-molecules.ui.group-buttons>
            <x-molecules.ui.group-buttons.button wire-click="$set('subPage', 1)" active="{{ $subPage == 1 }}"
                label="Items" />
            <div class="ui buttons" style="z-index: 100">
                <div class="ui combo top right pointing dropdown icon button">
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div wire:click.prevent="$set('onDisplayItemType', 'all')" data-value="all" class="item">
                            All</div>
                        <div wire:click.prevent="$set('onDisplayItemType', 'le')" data-value="le" class="item">
                            Lense</div>
                        <div wire:click.prevent="$set('onDisplayItemType', 'fr')" data-value="fr" class="item">
                            Frame</div>
                        <div wire:click.prevent="$set('onDisplayItemType', 'ac')" data-value="ac" class="item">
                            Accessory</div>
                    </div>
                </div>
            </div>
            <x-molecules.ui.group-buttons.button wire-click="$set('subPage', 2)" active="{{ $subPage == 2 }}"
                label="Supplier" />
            <x-molecules.ui.group-buttons.button wire-click="$set('subPage', 3)" active="{{ $subPage == 3 }}"
                label="In / Out" />
            </x-molecules.ui.group-buttons.butt>

        @endsection

        @section('section-heading-left')
            @switch($subPage)
                @case(1)
                    <div>
                        @if (count($selectedItems) > 0)
                            <div class="ui small basic icon buttons">
                                <x-atoms.ui.button wire:click.prevent="deletingItems">
                                    <i class="fa-solid fa-trash mr_2 red"></i>
                                    {{ 'items (' . count($selectedItems) . ')' }}
                                </x-atoms.ui.button>
                                <x-atoms.ui.button wire:click.prevent="$set('selectedItems', [])">
                                    <i class="fa-solid fa-xmark"></i>
                                </x-atoms.ui.button>
                            </div>
                        @else
                            <x-atoms.ui.button wire:click.prevent="showModal('add', 'item', null)" class="primary basic tiny">
                                <i class="icon plus"></i> New
                            </x-atoms.ui.button>
                        @endif
                    </div>
                @break

                @case(2)
                    <div>
                        <x-atom.btn-circle wire-click="showModal('add', 'supplier', null)" />
                    </div>
                @break

                @case(3)
                    IN / OUT
                @break

            @endswitch
        @endsection
        @section('section-heading-right')
            @switch($subPage)
                @case(1)
                    <div>
                        <x-atoms.ui.search wire-model="searchItem" />
                    </div>
                @break

                @case(2)
                    {{-- <div class="flex" style="gap: 0.5em"> --}}
                    <div>
                        <x-input.search wire-model="searchSupplier" />
                    </div>
                    <div class="flex gap_1">

                        {{-- <x-atom.sort>
                                    <x-atom.sort.sort-content 
                                        for=""
                                        span="Entries"
                                        wire-model="su_paginateVal"
                                        name=""
                                        val="" 
                                    /> 
                                    <x-atom.sort.sort-content 
                                        for="az"
                                        span="A-Z"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="asc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="za"
                                        span="Z-A"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="desc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="l_modified"
                                        span="Last Modified"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="last_modified" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="f_modified"
                                        span="First Modified"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="first_modified" 
                                    />
                                </x-atom.sort> --}}
                    </div>


                    {{-- </div> --}}
                @break

                @case(3)
                @break
            @endswitch
        @endsection

        @section('section-main')
            <div class="items">
                @switch($subPage)
                    @case(1)
                        <div>
                            <x-organisms.ui.table class="selectable">
                                <x-slot name="thead">
                                    <tr>
                                        <x-organisms.ui.table.th style="width:30px" />
                                        <x-organisms.ui.table.th label="Name" order-by="item_name" />
                                        <x-organisms.ui.table.th label="Type" order-by="item_type" />
                                        <x-organisms.ui.table.th label="Supplier" />
                                        <x-organisms.ui.table.th label="Remaining" order-by="item_qty" />
                                        <x-organisms.ui.table.th label="Price" order-by="item_price" />
                                        <x-organisms.ui.table.th style="width:30px" />
                                    </tr>
                                </x-slot>
                                <x-slot name="tbody">
                                    @forelse ($items as $item)
                                        <tr class="tr">
                                            <x-organisms.ui.table.td>
                                                <input wire:model="selectedItems" type="checkbox" class="pointer" value="{{ $item->id }}" checked>
                                            </x-organisms.ui.table.td>
                                            <x-organisms.ui.table.td text="{{ $item->item_name }}"
                                                desc="{{ $item->item_size ? $item->item_size . ' • ' : '' }} {{ $item->item_desc }}" />
                                            <x-organisms.ui.table.td>
                                                <p style="color: {{ $this->itemColor($item->item_type) }}">{{ $this->itemType($item->item_type) }}</p>
                                                <div class="ui top left pointing tiny dropdown sort_table">
                                                    <i class="fa-solid fa-caret-down pointer mx_3" style="padding: 0.1em 0.2em;"></i>
                                                    <div class="menu">
                                                        <div class="item massive" style="width: 100px; height:100px;background:src">
                                                            <img src="{{ asset('images/dango-logo-nolabel.png')}}" alt="" height="500px" style="height: 100px; position:relative;top:0;left:0;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $('.ui.sort_table').dropdown();
                                                </script>
                                            </x-organisms.ui.table.td>
                                            <x-organisms.ui.table.td text="{{ $item->supplier->supplier_name }}"
                                                desc-icon="fa-location-dot" desc="{{ $item->supplier->supplier_address }}" />
                                            <x-organisms.ui.table.td text="{{ $item->item_qty }}" />
                                            <x-organisms.ui.table.td text="{{ number_format($item->item_price) }}" text-icon="fa-peso-sign" />
                                            <x-organisms.ui.table.td>
                                                <x-atom.more>
                                                    <x-atom.more.option
                                                        wire-click="showModal('update', 'item', {{ $item->id }})"
                                                        option-name="Edit" />
                                                    <x-atom.more.option wire-click="deletingItem({{ $item->id }})"
                                                        option-name="Delete" />
                                                </x-atom.more>
                                            </x-organisms.ui.table.td>
                                        </tr>
                                    @empty
                                        <x-organisms.ui.table.search-no-results colspan="7"/>
                                    @endforelse
                                </x-slot>
                            </x-organisms.ui.table>

                            <x-organisms.ui.paginator display-page-number="{{ $pageNumber }}">
                                <x-slot name="paginator">
                                    {{ $items->links('livewire.components.paginator') }}
                                </x-slot>
                                <select wire:model="pageNumber"
                                    class="ui small compact selection dropdown dropdown-page-number"" id=" search-select">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>

                                </x-organisms.ui.paginator.item>



                        </div>
                    @break

                    @case(2)
                        <x-layout.lists-section>
                            <x-layout.lists-section.lists-list list-for="grid_supplier title">
                                <x-atom.column-title />
                                <x-atom.column-title wire-click="sortBy('item', 'item_name')" col-title="Name"
                                    {{-- arrow-direction="{{ $this->item_sortColumn === 'item_name' && $this->item_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title wire-click="sortBy('item', 'item_type')" col-title="Contact"
                                    {{-- arrow-direction="{{ $this->item_sortColumn === 'item_name' && $this->item_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title wire-click="sortBy('item', 'item_name')" col-title="Account"
                                    {{-- arrow-direction="{{ $this->item_sortColumn === 'item_name' && $this->item_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title />
                            </x-layout.lists-section.lists-list>
                            @foreach (App\Models\Supplier::all() as $su)
                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_supplier list">
                                        <x-layout.lists-section.list-item>
                                            <div class="flex flex_center">
                                                <input wire:model="selectedAppts" type="checkbox" class="pointer"
                                                    value="{{ $su->id }}">
                                            </div>
                                        </x-layout.lists-section.list-item>
                                        <x-layout.lists-section.list-item item-name="{{ $su->supplier_name }} fontBold"
                                            item-desc="{{ $su->supplier_branch ? $su->supplier_branch . ' • ' : '' }} {{ $su->supplier_address ?? '' }}"
                                            {{-- item-desc-icon="fa-location-dot" --}} {{-- item-desc="{{ !empty($su->item_size) ? $item->item_size . ' • ' : '' }} {{ $item->item_desc }}" --}} />
                                        <x-layout.lists-section.list-item item-name="{{ $su->supplier_contact_no }}"
                                            item-desc="{{ $su->supplier_email }}" />

                                        <x-layout.lists-section.list-item item-name="{{ $su->supplier_bank }}"
                                            item-desc="{{ $su->supplier_acc_no }}" />
                                        <x-layout.lists-section.list-item item-name="" item-desc="">
                                            <div class="flex flex_center">
                                                <x-atom.more>
                                                    <x-atom.more.option
                                                        wire-click="showModal('update', 'supplier', {{ $su->id }})"
                                                        option-name="Edit" />
                                                    <x-atom.more.option wire-click="deletingSupplier({{ $su->id }})"
                                                        option-name="Delete" />
                                                </x-atom.more>
                                            </div>
                                        </x-layout.lists-section.list-item>
                                    </x-layout.lists-section.lists-list>
                                </x-layout.lists-section.lists-container>
                            @endforeach
                        </x-layout.lists-section>
                    @break

                    @case(3)
                        <x-layout.lists-section>

                            <x-layout.lists-section.lists-list list-for="grid_lens title">
                                <x-atom.column-title />
                                <x-atom.column-title wire-click="sortBy('item', 'item_name')" col-title="Date"
                                    {{-- arrow-direction="{{ $this->item_sortColumn === 'item_name' && $this->item_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title wire-click="sortBy('item', 'item_type')" col-title="Name"
                                    {{-- arrow-direction="{{ $this->item_sortColumn === 'item_name' && $this->item_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title wire-click="sortBy('item', 'item_name')" col-title="In"
                                    {{-- arrow-direction="{{ $this->item_sortColumn === 'item_name' && $this->item_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title wire-click="sortBy('le', 'lense_qty')" col-title="Out"
                                    {{-- arrow-direction="{{ $this->le_sortColumn === 'lense_qty' && $this->le_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title wire-click="sortBy('le', 'lense_price')" col-title="Balance"
                                    {{-- arrow-direction="{{ $this->le_sortColumn === 'lense_price' && $this->le_sortDirection === 'asc' }}" --}} />
                                <x-atom.column-title />
                            </x-layout.lists-section.lists-list>
                            @forelse ($items as $item)
                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_lens list">
                                        <x-layout.lists-section.list-item>
                                            <div class="flex flex_center">
                                                <input wire:model="selectedAppts" type="checkbox" class="pointer"
                                                    value="{{ $item->id }}">
                                            </div>
                                        </x-layout.lists-section.list-item>
                                        <x-layout.lists-section.list-item item-name="Date fontBold" item-desc="desc" />
                                        <x-layout.lists-section.list-item item-name="John Doe" item-desc="Address" />
                                        <x-layout.lists-section.list-item item-name="In" item-desc="" />

                                        <x-layout.lists-section.list-item item-name="Out" item-desc="" />
                                        <x-layout.lists-section.list-item item-name="Balance" item-desc="" />
                                        <x-layout.lists-section.list-item item-name="" item-desc="">
                                            <div class="flex flex_center">
                                                <x-atom.more>
                                                    <x-atom.more.option wire-click="" option-name="Edit" />
                                                </x-atom.more>
                                            </div>
                                        </x-layout.lists-section.list-item>
                                    </x-layout.lists-section.lists-list>
                                </x-layout.lists-section.lists-container>
                            @empty
                                <x-layout.lists-section.list-empty empty-message="No Results." />
                            @endforelse

                            {{-- {{$items->links('livewire.components.paginator')}} --}}

                        </x-layout.lists-section>
                    @break

                @endswitch

            </div>





        @endsection

</x-layout.page-content>


<script>
    $('.dropdown-page-number').dropdown();
</script>

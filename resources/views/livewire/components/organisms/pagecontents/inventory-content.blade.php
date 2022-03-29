<x-layout.page-content>

    @section('section-page-title', 'Inventory')

    @section('section-links')
            <x-molecules.ui.group-buttons>
                <x-molecules.ui.group-buttons.button 
                    wire-click="$set('subPage', 1)" 
                    active="{{ $subPage == 1 }}"
                    label="Items" />

                    <div class="ui buttons" style="z-index: 100" x-init="">
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
            </x-molecules.ui.group-buttons.button>
    @endsection



        
    @section('section-heading-left')

            @switch($subPage)
                @case(1)
                    <div>
                        @if (count($selectedItems) > 0)
                            <div class="ui tiny basic icon buttons">
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
                        @if (count($selectedSuppliers) > 0)
                            <div class="ui tiny basic icon buttons">
                                <x-atoms.ui.button wire:click.prevent="deletingSuppliers">
                                    <i class="fa-solid fa-trash mr_2 red"></i>
                                    {{ 'items (' . count($selectedSuppliers) . ')' }}
                                </x-atoms.ui.button>
                                <x-atoms.ui.button wire:click.prevent="$set('selectedSuppliers', [])">
                                    <i class="fa-solid fa-xmark"></i>
                                </x-atoms.ui.button>
                            </div>
                        @else
                            <x-atoms.ui.button wire:click.prevent="showModal('add', 'supplier', null)" class="primary basic tiny">
                                <i class="icon plus"></i> New
                            </x-atoms.ui.button>
                        @endif
                    </div>
                @break

                @case(3)
                    IN / OUT
                @break

            @endswitch
        @endsection

        

        @section('section-heading-right')
            @switch($subPage)
                @case(1) <div> <x-atoms.ui.search wire-model="searchItem" placeholder="Search..."/> </div> @break
                @case(2) <div> <x-atoms.ui.search wire-model="searchSupplier" placeholder="Search..."/> </div> @break
                @case(3) <div> <x-atoms.ui.search wire-model="search_in_out_of_item" placeholder="Search..."/> </div> @break
                @default
            @endswitch
        @endsection



        @section('section-main')
            @switch($subPage)
                @case(1)
                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="Name" order-by="item_name" />
                            <x-organisms.ui.table.th label="Category" order-by="item_type" />
                            <x-organisms.ui.table.th label="Supplier" />
                            <x-organisms.ui.table.th label="Stocks" order-by="item_qty" />
                            <x-organisms.ui.table.th label="Price" order-by="item_price" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($items as $item)
                                <tr>
                                    <x-organisms.ui.table.td 
                                        checkbox="selectedItems" 
                                        checkbox-value="{{ $item->id }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $item->item_name }}"
                                        desc="{{ $item->item_size ? $item->item_size . ' • ' : '' }} {{ $item->item_desc }}" />
                                    <x-organisms.ui.table.td>
                                        <div>
                                            <div class="ui top left pointing dropdown table-inventory-dropdown-image">
                                                <div x-init="$('.ui.dropdown').dropdown();" style="color: {{ $this->itemColor($item->item_type) }}">{{ $this->itemType($item->item_type) }}</div>
                                                <div class="menu">
                                                    <div class="item massive" style="width:7em; height:7em; background:url('{{ $this->storage('items', $item->item_image) }}') no-repeat center; background-size:7em 7em"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </x-organisms.ui.table.td>
                                    <x-organisms.ui.table.td 
                                        text="{{ isset($item->supplier->supplier_name) ? $item->supplier->supplier_name : '' }}"
                                        desc="{{ isset($item->supplier->supplier_address) ? $item->supplier->supplier_address : '' }}"
                                        desc-icon="{{ isset($item->supplier->supplier_address) ? 'fa-location-dot' : '' }}" /> 
                                    <x-organisms.ui.table.td 
                                        text="{{ $item->item_qty }}" 
                                        desc="{{ isset($item->item_buffer) ? 'Low Stock: ' . $item->item_buffer : ''; }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ number_format($item->item_price) }}" 
                                        desc="{{ isset($item->item_cost) ? 'Cost: ' . $item->item_cost : ''; }}"
                                        text-icon="fa-peso-sign" />
                                    <x-organisms.ui.table.td-more>
                                        <x-atom.more.option
                                            wire-click="showModal('update', 'item', {{ $item->id }})"
                                            option-name="Edit" />
                                        <x-atom.more.option 
                                            wire-click="deletingItem({{ $item->id }})"
                                            option-name="Delete" />
                                    </x-organisms.ui.table.td>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse
                        </x-slot>
                    </x-organisms.ui.table>

                    <x-organisms.ui.paginator display-page-number="{{ $pageNumber }}" wire-model="pageNumber">
                        {{ $items->links('livewire.components.paginator') }}
                    </x-organisms.ui.paginator.item>    
                @break

                @case(2)
                    <x-organisms.ui.table class="selectable">
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
                    </x-organisms.ui.table>
                    @break

                @case(3)
                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th label="Date" order-by="item_name"/>
                            <x-organisms.ui.table.th label="Owned by" order-by="item_type" />
                            <x-organisms.ui.table.th label="In" />
                            <x-organisms.ui.table.th label="Out" />
                            <x-organisms.ui.table.th label="Balance" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            {{-- @forelse ($suppliers as $su) --}}
                                <tr>
                                    <x-organisms.ui.table.td desc="Jan 15, 2021"/>
                                    <x-organisms.ui.table.td text="John Doe" avatar="{{  $this->storage('avatars', '') }}"/>
                                    <x-organisms.ui.table.td text="5"/>
                                    <x-organisms.ui.table.td text="8"/>
                                    <x-organisms.ui.table.td text="10"/>
                                    <x-organisms.ui.table.td-more>
                                        <x-atom.more.option
                                            wire-click="showModal('update', 'supplier', 'ID HERE')"
                                            option-name="Edit" />
                                        <x-atom.more.option 
                                            wire-click="deletingSupplier('ID HERE')"
                                            option-name="Delete" />
                                    </x-organisms.ui.table.td>
                                </tr>
                            {{-- @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse --}}
                        </x-slot>
                    </x-organisms.ui.table>
                    @break
                @default
            @endswitch
        @endsection

</x-layout.page-content>


<script>
    $('.ui.dropdown').dropdown();
</script>

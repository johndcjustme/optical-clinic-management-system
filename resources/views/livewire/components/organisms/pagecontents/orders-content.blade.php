<x-layout.page-content>

    @section('section-page-title', 'Orders')

    @section('section-links')
            {{-- <x-atom.tab-links.link tab-title="All Orders" wire-click="myTab(1)" sub-page="{{ $this->myTab == 1 }}"/>
            <x-atom.tab-links.link tab-title="Pending" wire-click="myTab(2)" sub-page="{{ $this->myTab == 2 }}"/>
            <x-atom.tab-links.link tab-title="Received" wire-click="myTab(3)" sub-page="{{ $this->myTab == 3 }}"/>
            <x-atom.tab-links.link tab-title="Claimed" wire-click="myTab(4)" sub-page="{{ $this->myTab == 4 }}"/> --}}
                <div>
                    <div class="ui tiny compact selection dropdown">
                        <i class="dropdown icon"></i>
                        <div class="text">Orders</div>
                        <div class="menu">
                            <div class="item">All Orders</div>
                            <div class="item">Pending</div>
                            <div class="item">Recieved</div>
                            <div class="item">Claimed</div>
                        </div>
                      </div>

                    {{-- <x-molecules.ui.group-buttons>
                        <x-molecules.ui.group-buttons.button 
                            wire-click="" 
                            active=""
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
                    </x-molecules.ui.group-buttons>                 --}}
                </div>
    @endsection

    @section('section-heading-left')

        <x-atoms.ui.button wire:click.prevent="showModal('add', 'item', null)" class="primary basic tiny">
            <i class="icon plus"></i> New
        </x-atoms.ui.button>
    @endsection

    @section('section-heading-right')
        <div> 
            <x-atoms.ui.search wire-model="searchOrder" placeholder="Search..."/> 
        </div>

    @endsection

    @section('section-main')

        <x-organisms.ui.table class="selectable">
            <x-slot name="thead">
                <x-organisms.ui.table.th-checkbox/>
                <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                <x-organisms.ui.table.th label="Contact" order-by="item_type" />
                <x-organisms.ui.table.th label="Account" />
                <x-organisms.ui.table.th-more/>
            </x-slot>
            <x-slot name="tbody">
                {{-- @forelse ($suppliers as $su) --}}
                    <tr>
                        <x-organisms.ui.table.td 
                            checkbox="selectedSuppliers" 
                            checkbox-value=""/>
                        <x-organisms.ui.table.td 
                            text="John Doe"
                            desc="Tandag city"
                            desc-icon="fa-location-dot"
                            avatar="{{ $this->storage('avatars', '') }}"/>
                        <x-organisms.ui.table.td 
                            text="kdfkdjfkdjf"
                            desc="dfdkf"
                            desc-icon="fa-envelope"/>
                        <x-organisms.ui.table.td 
                            text="jdhfjdhf"
                            desc="kdjfkdjfkd"/>
                        <x-organisms.ui.table.td-more>
                            <x-atom.more.option
                                wire-click="showModal('update', 'supplier','id')"
                                option-name="Edit" />
                            <x-atom.more.option 
                                wire-click="deletingSupplier('id')"
                                option-name="Delete" />
                        </x-organisms.ui.table.td>
                    </tr>
                {{-- @empty
                    <x-organisms.ui.table.search-no-results colspan="7"/>
                @endforelse --}}
            </x-slot>
        </x-organisms.ui.table>
    @endsection


</x-layout.page-content>

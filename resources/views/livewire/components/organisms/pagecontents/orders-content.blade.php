<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Orders"
            desc="Lorem Ipsum dolor sit amet."/>        
    @endsection

    @section('section-links')
        <div class="ui compact tiny menu" style="z-index:300;">
            <div class="ui floating labeled icon dropdown item">
                <i class="filter icon" style="margin-right:0.8em;"></i>
                <span class="text">
                    @switch($subPage)
                        @case(1) {{ $this->orderCategory(1) }} <div class="ui description">{{ $this->orderCategoryDesc(1) }}</div> @break
                        @case(2) {{ $this->orderCategory(2) }} <div class="ui description">{{ $this->orderCategoryDesc(2) }}</div> @break
                        @case(3) {{ $this->orderCategory(3) }} <div class="ui description">{{ $this->orderCategoryDesc(3) }}</div> @break
                        @case(4) {{ $this->orderCategory(4) }} <div class="ui description">{{ $this->orderCategoryDesc(4) }}</div> @break
                        @default
                    @endswitch
                </span>
                <div class="menu">
                    <div wire:click.prevent="$set('subPage', 1)" class="item">{{ $this->orderCategory(1) }}<span class="description">{{ $this->orderCategoryDesc(1) }}</span></div>
                    <div wire:click.prevent="$set('subPage', 2)" class="item">{{ $this->orderCategory(2) }}<span class="description">{{ $this->orderCategoryDesc(2) }}</span></div>
                    <div wire:click.prevent="$set('subPage', 3)" class="item">{{ $this->orderCategory(3) }}<span class="description">{{ $this->orderCategoryDesc(3) }}</span></div>
                    <div wire:click.prevent="$set('subPage', 4)" class="item">{{ $this->orderCategory(4) }}<span class="description">{{ $this->orderCategoryDesc(4) }}</span></div>
                </div>
            </div>

{{-- 

            <div class="ui tiny compact selection dropdown">
                <i class="dropdown icon"></i>
                <div class="text">
                    @switch($subPage)
                        @case(1) {{ $this->orderCategory(1) }} <div class="ui description">{{ $this->orderCategoryDesc(1) }}</div> @break
                        @case(2) {{ $this->orderCategory(2) }} <div class="ui description">{{ $this->orderCategoryDesc(2) }}</div> @break
                        @case(3) {{ $this->orderCategory(3) }} <div class="ui description">{{ $this->orderCategoryDesc(3) }}</div> @break
                        @case(4) {{ $this->orderCategory(4) }} <div class="ui description">{{ $this->orderCategoryDesc(4) }}</div> @break
                        @default
                    @endswitch
                </div>
                <div class="menu">
                    <div wire:click.prevent="$set('subPage', 1)" class="item">{{ $this->orderCategory(1) }}<span class="description">{{ $this->orderCategoryDesc(1) }}</span></div>
                    <div wire:click.prevent="$set('subPage', 2)" class="item">{{ $this->orderCategory(2) }}<span class="description">{{ $this->orderCategoryDesc(2) }}</span></div>
                    <div wire:click.prevent="$set('subPage', 3)" class="item">{{ $this->orderCategory(3) }}<span class="description">{{ $this->orderCategoryDesc(3) }}</span></div>
                    <div wire:click.prevent="$set('subPage', 4)" class="item">{{ $this->orderCategory(4) }}<span class="description">{{ $this->orderCategoryDesc(4) }}</span></div>
                </div>
            </div> --}}
        </div>
    @endsection

    @section('section-heading-left')

        @if (count($selectedOrders) > 0)
            <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedOrders', [])" class="left pointing tiny">
                <x-slot name="label">
                    {{ count($selectedOrders) }} Selected 
                </x-slot>
                <x-slot name="menu"> 
                    @switch($subPage)
                        @case(1)
                            <div wire:click.prevent="previewOrder" class="item"><i class="cart icon"></i> Order Now</div>
                            <div class="ui divider"></div>
                            <div wire:click.prevent="deletingOrders" class="item"><i class="delete icon"></i> Remove from exam list</div>
                            @break
                        @case(2)
                            @break
                    
                        @case(3)
                            
                            @break
                        @case(4)
                            <div class="item"><i class="edit icon"></i> Edit</div>
                            <div class="item"><i class="add icon"></i> Add to exam list</div>
                            <div wire:click.prevent="deletingPatients" class="item"><i class="delete icon"></i> Delete</div>
                            @break
                        @default
                    @endswitch
                </x-slot>
            </x-atoms.ui.header-dropdown-menu>
        @else
            <x-atoms.ui.header-add-btn label="Add Order" wire-click="showModal('add', null)"/>
        @endif
        {{-- <x-atoms.ui.button wire:click.prevent="showModal('add', null)" class="primary basic tiny">
            <i class="icon plus"></i> Add Order
        </x-atoms.ui.button> --}}

    @endsection

    @section('section-heading-right')
        @switch($subPage)
            @case(1)
                @if ($this->hasOrderStatus(1))
                    <div><x-atoms.ui.search wire-model="searchOrder" placeholder="Search..."/></div>
                    @include('livewire.components.organisms.pagecontents.orders-content.dropdown') 
                @endif
                @break
            @case(2)
                @if ($this->hasOrderStatus(2))
                    <div><x-atoms.ui.search wire-model="searchOrder" placeholder="Search..."/></div>
                    @include('livewire.components.organisms.pagecontents.orders-content.dropdown') @break
                @endif
            @case(3)
                @if ($this->hasOrderStatus(3))
                    <div><x-atoms.ui.search wire-model="searchOrder" placeholder="Search..."/></div>
                    @include('livewire.components.organisms.pagecontents.orders-content.dropdown') @break
                @endif
            @case(4)
                @if ($this->hasOrderStatus(4))
                    <div><x-atoms.ui.search wire-model="searchOrder" placeholder="Search..."/></div>
                    @include('livewire.components.organisms.pagecontents.orders-content.dropdown') @break
                @endif
            @default
        @endswitch
    @endsection

    @section('section-main')
        @switch($subPage)
            @case(1)
                @if ($this->hasOrderStatus(1))
                    <x-organisms.ui.table class="selectable unstackable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:14em;"/>
                            <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                            <x-organisms.ui.table.th label="Contact" order-by="item_type" />
                            <x-organisms.ui.table.th label="Order" order-by="item_type" />
                            <x-organisms.ui.table.th label="Total" order-by="item_type" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($orders as $order)
                                <tr>
                                    <x-organisms.ui.table.td 
                                        checkbox="selectedOrders" 
                                        checkbox-value="{{ $order->id }}"/>
                                    <x-organisms.ui.table.td 
                                        text="Apr 24, 2022"
                                        desc=""/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $this->getFullName($order->patient_id) }}"
                                        desc="{{ $order->patient->patient_address }}"
                                        desc-icon="{{ !empty($order->patient->patient_address) ? 'fa-location-dot' : ''; }}"
                                        avatar="{{ $this->storage($order->patient->patient_avatar) }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $order->patient->patient_mobile}}"
                                        desc="{{ $order->patient->patient_email }}"
                                        desc-icon="{{ !empty($order->patient->patient_email) ? 'fa-envelope' : '';}}"/>
                                    <x-organisms.ui.table.td>
                                        <div>
                                            <div x-init="$('.showItems').popup({popup:$('.ui.flowing.popup'), on: 'click'});" class="showItems"><a><i class="fa-solid fa-cart-shopping mr_3"></i> {{ $this->itemSum($order->id) }} Items</a></div>
                                            <div class="ui flowing popup top right transition hidden">
                                            <div class="ui one column divided center aligned grid">

                                                <div class="column">
                                                    <h4 class="ui header">Items</h4>
                                                    @foreach (App\Models\Ordered_item::with('item')->where('order_id', $order->id)->get() as $ordered_item)
                                                        <p><b>{{ $ordered_item->ordered_item_qty }}</b> {{ $ordered_item->item->item_name }}</p>
                                                    @endforeach
                                                </div>

                                            </div>
                                            </div>
                                        </div>
                                    </x-organisms.ui.table.td>
                                    <x-organisms.ui.table.td 
                                        text="P 1,000"
                                        text-icon="fa-peso-sign"
                                        desc-icon=""/>
                                
                                    <x-organisms.ui.table.td-more>
                                        <x-atom.more.option
                                            wire-click="showModal('update', {{ $order->id }})"
                                            option-name="Edit" />
                                        <x-atom.more.option 
                                            wire-click="deletingOrder({{ $order->id }})"
                                            option-name="Delete" />
                                    </x-organisms.ui.table.td>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse
                        </x-slot>
                    </x-organisms.ui.table>
                    {{ $orders->links('livewire.components.paginator') }}
                @else
                    <x-atoms.ui.message 
                        icon="frown open"
                        class="mt_20"
                        header="No orders created yet."
                        message="This section will contain all created orders."/>
                @endif
                @break

            @case(2)
                @if ($this->hasOrderStatus(2))
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
                                        checkbox="selectedOrders" 
                                        checkbox-value=""/>
                                    <x-organisms.ui.table.td 
                                        text="John Doe"
                                        desc="Tandag city"
                                        desc-icon="fa-location-dot"
                                        avatar="{{ $this->storage('') }}"/>
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
                @else
                    <x-atoms.ui.message 
                        icon="frown open"
                        class="mt_20"
                        header="No pending orders."
                        message="This section will contain all pending orders."/>
                @endif
                @break

            @case(3)
                @if ($this->hasOrderStatus(3))
                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="Account" />
                            <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                            <x-organisms.ui.table.th label="Contact" order-by="item_type" />
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            {{-- @forelse ($suppliers as $su) --}}
                                <tr>
                                    <x-organisms.ui.table.td 
                                        checkbox="selectedOrders" 
                                        checkbox-value=""/>
                                    <x-organisms.ui.table.td 
                                        text=""
                                        desc="Apr 1, 2022"/>
                                    <x-organisms.ui.table.td 
                                        text="John Doe"
                                        desc="Tandag city"
                                        desc-icon="fa-location-dot"
                                        avatar="{{ $this->storage('') }}"/>
                                    <x-organisms.ui.table.td 
                                        text="kdfkdjfkdjf"
                                        desc="dfdkf"
                                        desc-icon="fa-envelope"/>
                                    
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
                @else
                    <x-atoms.ui.message 
                        icon="frown open"
                        class="mt_20"
                        header="No recieved orders."
                        message="This section will contain all received orders."/>
                @endif
                @break

            @case(4)
                @if ($this->hasOrderStatus(4))
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
                                        checkbox="selectedOrders" 
                                        checkbox-value=""/>
                                    <x-organisms.ui.table.td 
                                        text="John Doe"
                                        desc="Tandag city"
                                        desc-icon="fa-location-dot"
                                        avatar="{{ $this->storage('') }}"/>
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
                                <tr>
                                    <x-organisms.ui.table.td 
                                        checkbox="selectedOrders" 
                                        checkbox-value=""/>
                                    <x-organisms.ui.table.td 
                                        text="John Doe"
                                        desc="Tandag city"
                                        desc-icon="fa-location-dot"
                                        avatar="{{ $this->storage('') }}"/>
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
                @else 
                    <x-atoms.ui.message 
                        icon="frown open"
                        class="mt_20"
                        header="No claimed orders."
                        message="This section will contain all claimed orders."/>
                @endif
                @break
            @default 
        @endswitch
    @endsection
</x-layout.page-content>

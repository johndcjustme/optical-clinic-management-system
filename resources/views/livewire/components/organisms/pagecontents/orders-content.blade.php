<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Orders"
            desc="Lorem Ipsum dolor sit amet."/>        
    @endsection

    @section('section-links')
        <div class="ui compact tiny menu">
            <div wire:click.prevent="$set('page', 1)" class="link item @if($page == 1) active @endif">Patients</div>
            <div wire:click.prevent="$set('page', 2)" class="link item @if($page == 2) active @endif">Inventory</div>
        </div>
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
                    @for ($i = 1; $i <= 4; $i++)
                        <div wire:click.prevent="$set('subPage', {{ $i }})" class="item {{ $this->orderCategoryDesc($i) == 0 ? 'disabled' : '' }}">{{ $this->orderCategory($i) }}<span class="description">{{ $this->orderCategoryDesc($i) }}</span></div>
                    @endfor
                </div>
            </div>
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
                            <div wire:click.prevent="showModal('viewOrder', null)" class="item"><i class="eye icon"></i> View</div>
                            <div class="ui divider"></div>
                            <div wire:click.prevent="" class="item"><i class="eye icon"></i> Order Now</div>
                            <div wire:click.prevent="pdf" class="item"><i class="eye icon"></i> Download pdf</div>
                            <div class="ui divider"></div>
                            <div wire:click.prevent="deletingOrders" class="item"><i class="delete icon"></i> Remove</div>
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
            <button wire:click.prevent="sendMail">download</button>
        @if ($page == 1)
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
                                            avatar="{{ avatar($order->patient->patient_avatar) }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ $order->patient->patient_mobile}}"
                                            desc="{{ $order->patient->patient_email }}"
                                            desc-icon="{{ !empty($order->patient->patient_email) ? 'fa-envelope' : '';}}"/>
                                        <x-organisms.ui.table.td>
                                            <div>
                                                <div x-init="$('.showItems').popup({on: 'click'});" class="showItems"><a><i class="icon eye mr_3"></i> View</a></div>
                                                <div class="ui flowing popup top right transition hidden">
                                                <div class="ui one column divided left aligned grid">
                                                    <div class="column">
                                                        <h4 class="ui header">Orders</h4>
                                                        <p><b>Frame:</b> {{ $order->frame }}</p>
                                                        <p><b>Lense:</b> {{ $order->lense }}</p>
                                                        <p><b>Tint:</b> {{ $order->tint }}</p>
                                                        <p><b>Others:</b> {{ $order->others }}</p> 
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </x-organisms.ui.table.td>
                                        <x-organisms.ui.table.td 
                                            text="{{ App\Models\Ordered_item::where('order_detail_id', $order->id)->sum('ordered_item_price') }}"
                                            text-icon="fa-peso-sign"
                                            desc-icon=""/>
                                        <x-organisms.ui.table.td-more>
                                            <x-atom.more.option
                                                wire-click="viewOrder({{ $order->patient_id }}, {{ $order->exam_id }})"
                                                option-name="Order Details" />
                                            <div class="ui divider"></div>
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
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            checkbox="selectedOrders" 
                                            checkbox-value=""/>
                                        <x-organisms.ui.table.td 
                                            text="John Doe"
                                            desc="Tandag city"
                                            desc-icon="fa-location-dot"
                                            avatar="{{ avatar('') }}"/>
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
                                            avatar="{{ avatar('') }}"/>
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
                                            avatar="{{ avatar('') }}"/>
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
                                            avatar="{{ avatar('') }}"/>
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
        @elseif ($page == 2)
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
                    @foreach (App\Models\Item::all() as $item)
                        <tr>
                            <x-organisms.ui.table.td 
                                checkbox="selectedItems" 
                                checkbox-value="{{ $item->id }}"/>
                            <x-organisms.ui.table.td>
                                <span wire:click.prevent="showImage('{{ $item->item_image }}', '{{ $item->item_name }}', '{{ $item->category->name }}')" data-tooltip="{{ !empty($item->item_image) ? 'View Photo' : 'No Photo' }}" data-position="top center" data-inverted="" data-variation="mini">
                                    <i class="icon blue image"></i> 
                                </span>
                            </x-organisms.ui.table.td>
                            <x-organisms.ui.table.td 
                                text="{{ $item->item_name }}"
                                desc="{{ $item->item_size ? $item->item_size . ' • ' : '' }} {{ $item->item_desc }}" />
                            <x-organisms.ui.table.td text="">
                                <div class="ui {{ $item->category->cname }} empty circular label"></div>
                                <span class="ui text {{ $item->category->cname }}">{{ $item->category->name ?? '' }}</span>
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
                            </x-organisms.ui.table.td>
                            <x-organisms.ui.table.td-more>
                                <x-atom.more.option
                                    wire-click="showModal('update', {{ $item->id }})"
                                    option-name="Edit" />
                                <x-atom.more.option 
                                    wire-click="deletingItem({{ $item->id }}, '{{ $item->item_name }}')"
                                    option-name="Delete" />
                            </x-organisms.ui.table.td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-organisms.ui.table>
        @endif
        
    @endsection
</x-layout.page-content>

<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Orders"
            desc="All orders {{ count(App\Models\Order_detail::all()) }}"/>        
    @endsection

    @section('section-links')
        <div class="ui compact tiny menu">
            <div wire:click.prevent="$set('subPage', 1)" class="link item @if($subPage == 1) active @endif {{ $this->orderCategoryDesc(1) == 0 ? 'disabled' : '' }}">To order <span style="opacity: 0.5; margin-left:0.4em">{{ $this->orderCategoryDesc(1) }}</span></div>
            <div wire:click.prevent="$set('subPage', 2)" class="link item @if($subPage == 2) active @endif {{ $this->orderCategoryDesc(2) == 0 ? 'disabled' : '' }}">Pending <span style="opacity: 0.5; margin-left:0.4em">{{ $this->orderCategoryDesc(2) }}</span></div>
            <div wire:click.prevent="$set('subPage', 3)" class="link item @if($subPage == 3) active @endif {{ $this->orderCategoryDesc(3) == 0 ? 'disabled' : '' }}">Recieved <span style="opacity: 0.5; margin-left:0.4em">{{ $this->orderCategoryDesc(3) }}</span></div>
            <div wire:click.prevent="$set('subPage', 4)" class="link item @if($subPage == 4) active @endif {{ $this->orderCategoryDesc(4) == 0 ? 'disabled' : '' }}">Claimed <span style="opacity: 0.5; margin-left:0.4em">{{ $this->orderCategoryDesc(4) }}</span></div>
        </div>

{{-- 
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
        </div> --}}
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

                            <div class="header">update status</div>
                            <div wire:click.prevent="changeStatus(2)" class="item"><i class="share icon"></i> Pending</div>

                            <div class="ui divider"></div>

                            <div wire:click.prevent="sendMail" class="item"><i class="cart icon"></i> Order Now</div>
                            <div wire:click.prevent="downloadPdf" class="item"><i class="download icon"></i> Download pdf</div>

                            <div class="ui divider"></div>

                            <div wire:click.prevent="deletingOrders" class="item"><i class="delete icon"></i> Remove</div>
                            @break

                        @case(2)
                            <div wire:click.prevent="showModal('viewOrder', null)" class="item"><i class="eye icon"></i> View</div>

                            <div class="ui divider"></div>

                            <div class="header">update status</div>
                            <div wire:click.prevent="changeStatus(1)" class="item"><i class="reply icon"></i> To order</div>
                            <div wire:click.prevent="changeStatus(3)" class="item"><i class="share icon"></i> Received</div>

                            <div class="ui divider"></div>

                            <div wire:click.prevent="downloadPdf" class="item"><i class="download icon"></i> Download pdf</div>

                            <div class="ui divider"></div>

                            <div wire:click.prevent="deletingOrders" class="item"><i class="delete icon"></i> Remove</div>
                            @break
                    
                        @case(3)
                            <div wire:click.prevent="showModal('viewOrder', null)" class="item"><i class="eye icon"></i> View</div>

                            <div class="ui divider"></div>

                            <div class="header">update status</div>
                            <div wire:click.prevent="changeStatus(2)" class="item"><i class="reply icon"></i> Pending</div>
                            <div wire:click.prevent="changeStatus(4)" class="item"><i class="share icon"></i> Claimed</div>

                            <div class="ui divider"></div>
                            @break

                        @case(4)
                            <div wire:click.prevent="showModal('viewOrder', null)" class="item"><i class="eye icon"></i> View</div>

                            <div class="ui divider"></div>

                            <div class="header">update status</div>
                            <div wire:click.prevent="changeStatus(3)" class="item"><i class="reply icon"></i> Received</div>
                            @break

                        @default
                    @endswitch
                </x-slot>
            </x-atoms.ui.header-dropdown-menu>
        @else
            {{-- <x-atoms.ui.header-add-btn label="Add Order" wire-click="showModal('add', null)"/> --}}
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
                                {{-- <x-organisms.ui.table.th label="Total" order-by="item_type" /> --}}
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($orders as $order)
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            checkbox="selectedOrders" 
                                            checkbox-value="{{ $order->id }}"/>
                                        <x-organisms.ui.table.td 
                                            {{-- class="left marked green" --}}
                                            {{-- text-icon="icon cart plus" --}}
                                            text="N / A"/>
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
                                        {{-- <x-organisms.ui.table.td 
                                            text="{{ App\Models\Ordered_item::where('order_detail_id', $order->id)->sum('ordered_item_price') }}"
                                            text-icon="fa-peso-sign"
                                            desc-icon=""/> --}}
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
                            header="No ongoing orders."
                            message="This section will contain all ongoing orders."/>
                    @endif
                    @break

                @case(2)
                    @if ($this->hasOrderStatus(2))
                        <x-organisms.ui.table class="selectable unstackable">
                            <x-slot name="thead">
                                <x-organisms.ui.table.th-checkbox/>
                                <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:14em;"/>
                                <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                                <x-organisms.ui.table.th label="Contact" order-by="item_type" />
                                <x-organisms.ui.table.th label="Order" order-by="item_type" />
                                {{-- <x-organisms.ui.table.th label="Total" order-by="item_type" /> --}}
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($orders as $order)
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            checkbox="selectedOrders" 
                                            checkbox-value="{{ $order->id }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ humanReadableDate($order->updated_at) }}"
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
                                        {{-- <x-organisms.ui.table.td 
                                            text="{{ App\Models\Ordered_item::where('order_detail_id', $order->id)->sum('ordered_item_price') }}"
                                            text-icon="fa-peso-sign"
                                            desc-icon=""/> --}}
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
                            header="Pending orders is empty."
                            message="This section will contain all pending orders."/>
                    @endif
                    @break

                @case(3)
                    @if ($this->hasOrderStatus(3))
                        <x-organisms.ui.table class="selectable unstackable">
                            <x-slot name="thead">
                                <x-organisms.ui.table.th-checkbox/>
                                <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:14em;"/>
                                <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                                <x-organisms.ui.table.th label="Contact" order-by="item_type" />
                                <x-organisms.ui.table.th label="Order" order-by="item_type" />
                                {{-- <x-organisms.ui.table.th label="Total" order-by="item_type" /> --}}
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($orders as $order)
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            checkbox="selectedOrders" 
                                            checkbox-value="{{ $order->id }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ humanReadableDate($order->created_at) }}"
                                            desc="Recieved: {{ humanReadableDate($order->updated_at) }}"/>
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
                                        {{-- <x-organisms.ui.table.td 
                                            text="{{ App\Models\Ordered_item::where('order_detail_id', $order->id)->sum('ordered_item_price') }}"
                                            text-icon="fa-peso-sign"
                                            desc-icon=""/> --}}
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
                            header="Recieved orders is empty."
                            message="This section will contain all received orders."/>
                    @endif
                    @break

                @case(4)
                    @if ($this->hasOrderStatus(4))
                        <x-organisms.ui.table class="selectable unstackable">
                            <x-slot name="thead">
                                <x-organisms.ui.table.th-checkbox/>
                                <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:14em;"/>
                                <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                                <x-organisms.ui.table.th label="Contact" order-by="item_type" />
                                <x-organisms.ui.table.th label="Order" order-by="item_type" />
                                {{-- <x-organisms.ui.table.th label="Total" order-by="item_type" /> --}}
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($orders as $order)
                                    <tr>
                                        <x-organisms.ui.table.td 
                                            checkbox="selectedOrders" 
                                            checkbox-value="{{ $order->id }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ humanReadableDate($order->created_at) }}"
                                            desc="Claimed: {{ humanReadableDate($order->updated_at) }}"/>
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
                                        {{-- <x-organisms.ui.table.td 
                                            text="{{ App\Models\Ordered_item::where('order_detail_id', $order->id)->sum('ordered_item_price') }}"
                                            text-icon="fa-peso-sign"
                                            desc-icon=""/> --}}
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
                            header="Claimed orders is empty."
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



@push('js')
    

<script>
    function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>

@endpush
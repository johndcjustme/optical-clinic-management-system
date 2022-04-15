


        <div class="x-dashed-top-2 my_10">

        </div>

        <div class="x-flex x-flex-xbetween">
            <div style="width:50%">
                <address>
                    <b>From</b> <br>
                    Dango Optical Clinic<br> 
                    address<br>
                </address>
                <br>
                <address>
                    <b>To</b> <br>
                    Supplier.<br> 
                    Supplier@email.com<br>
                    095182839200<br>
                    Box 564, Disneyland, address
                </address>
            </div>
            <div style="text-align: left; width:50%">
                <div>Lorem, ipsum.</div>
                <div>Lorem, ipsum.</div>
                <div>Lorem, ipsum.</div>
                <div>Lorem, ipsum.</div>
                <div>Lorem, ipsum.</div>
            </div>
        </div><br>



        <div class="x-flex x-flex-xend py_5">
            <div class="ui dropdown icon labeled button mini" x-init="$('.ui.dropdown').dropdown()" style="z-index: 500">
                <i class="add user icon"></i>
                <span class="">Supplier</span>
                <div class="menu left small">
                    <div class="ui icon search input">
                        <i class="search icon"></i>
                        <input type="text" placeholder="Search tags...">
                    </div>
                    <div class="divider"></div>
                    <div class="header">
                        <i class="tags icon"></i>
                        Tag Label
                    </div>
                    <div class="scrolling menu">
                        @foreach (App\Models\Supplier::all() as $su)
                            <div wire:click.prevent="orderAssignPatient({{ $su->id }})" class="item">
                                <div class="x-flex x-flex-ycenter x-gap-1">
                                    <x-atom.profile-photo size="2.5em" path="{{ $this->storage($su->supplier_avatar) }}" />
                                    {{-- <img class="ui avatar image" src="{{ $this->storage($pt->patient_avatar) }}"> --}}
                                    <div>
                                        {{ $su->supplier_name }}
                                        {{-- {{ $this->getFullName($su->id) }} --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

      <x-organisms.ui.table class="selectable unstackable basic celled">
        <x-slot name="thead">
            <x-organisms.ui.table.th label="Item"/>
            <x-organisms.ui.table.th label="Qty" style="width:9em"/>
            <x-organisms.ui.table.th label="Price" style="width: 9em"/>
            <x-organisms.ui.table.th label="Total" style="width: 9em"/>
        </x-slot>
        <x-slot name="tbody">
            @foreach (App\Models\Order::where('order_code', $order['code'])->get() as $order)
                @foreach (App\Models\Ordered_item::with('item')->where('order_id', $order->id)->get() as $ordered_item)
                    <tr>
                        <x-organisms.ui.table.td text="{{ $ordered_item->item->item_name }}"/>
                        <x-organisms.ui.table.td text="{{ $ordered_item->ordered_item_qty }}"/>
                        <x-organisms.ui.table.td text="{{ $ordered_item->ordered_item_price }}"/>
                        <x-organisms.ui.table.td text="{{ $ordered_item->ordered_item_qty * $ordered_item->ordered_item_price }}"/>
                    </tr>
                    @php
                        $order['total'] += ($ordered_item->ordered_item_qty * $ordered_item->ordered_item_price);
                    @endphp
                @endforeach
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;">
                    TOTAL
                </td>
                <td>
                    {{ $order['total'] }}
                </td>
            </tr>
        </x-slot>
      </x-organisms.ui.table>
@include('layouts.head')

    <div style="width: 100%">
        <div style="width:700px; margin-left:auto; margin-right:auto">
            <br><br>
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


            <x-organisms.ui.table class="selectable unstackable basic celled">
                <x-slot name="thead">
                    <x-organisms.ui.table.th label="Item"/>
                    <x-organisms.ui.table.th label="Qty" style="width:9em"/>
                    <x-organisms.ui.table.th label="Price" style="width: 9em"/>
                    <x-organisms.ui.table.th label="Total" style="width: 9em"/>
                </x-slot>
                <x-slot name="tbody">
                    @foreach ($orders as $order)
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
                            3000
                        </td>
                    </tr>
                </x-slot>
            </x-organisms.ui.table>
        </div>
    </div>

@include('layouts.foot')


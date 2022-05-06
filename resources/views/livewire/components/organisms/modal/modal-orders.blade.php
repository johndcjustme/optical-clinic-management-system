<x-organisms.modal max-width="{{ $modal['viewOrder'] ? '600px' : '500px' }}">

    @section('modal_title')
        <div>
            @if ($modal['viewOrder'])
            <div class="x-flex x-gap-1">
                <div wire:click.prevent="pdf" class="ui button small icon" data-tooltip="Download pdf" data-position="bottom left" data-inverted="" data-variation="mini"><i class="icon download"></i> Download PDF</div>
                <div wire:click.prevent="" class="ui button small icon" data-tooltip="Download pdf" data-position="bottom left" data-inverted="" data-variation="mini">Order Now</div>
            </div>
            @else
                <div class="ui dropdown icon circular floating button tiny" x-init="$('.ui.dropdown').dropdown()" style="z-index: 500">
                    <i class="add user icon"></i>
                    {{-- <span class="">Patient</span> --}}
                    <div class="menu right small">
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
                            @foreach (App\Models\Patient::all() as $pt)
                                <div wire:click.prevent="orderAssignPatient({{ $pt->id }})" class="item">
                                    <div class="x-flex x-flex-ycenter x-gap-1">
                                        <x-atom.profile-photo size="2.5em" path="{{ avatar($pt->patient_avatar) }}" />
                                        {{-- <img class="ui avatar image" src="{{ $this->storage($pt->patient_avatar) }}"> --}}
                                        <div>
                                            {{ $this->getFullName($pt->id) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div>
            <h4>
                @if ($modal['add'])
                    ADD ORDER
                @elseif ($modal['update'])
                    UPDATE ORDER
                @endif
            </h4>
        </div>
        <div class="">
            <x-atoms.ui.button wire:click.prevent="closeModal" class="tiny">Close</x-atoms.ui.button>
            @if (!$modal['viewOrder'])
                <x-atoms.ui.button class="secondary tiny" form="" type="submit">Save</i></x-atoms.ui.button>
            @else
            @endif
        </div>
    @endsection

    @section('modal_body')

        
        @if ($modal['add'] || $modal['update'])
            <br>

            <div class="x-flex x-flex-xbetween x-flex-ystart">    

                @if (!empty($order['id']))
                    <div class="x-flex x-flex-ycenter x-gap-1">
                        <div>
                            <x-atom.profile-photo size="5em" path="{{ avatar($pt['avatar']) }}" />
                        </div>
                        <div>
                            <div>
                                <h4>
                                    {{ $this->getFullName($orderPatientId) }}
                                </h4>
                                <span>Tandah</span>
                            </div>
                            <small>@if (!empty($pt['addr'])) <i class="fa-solid fa-location-dot mr_2"></i> {{ $pt['addr'] }}@endif</small>
                        </div>
                    </div>
                @else
                    <div class="ui message tiny fluid warning" style="width: 100%">
                        <div class="header">
                            Select Patient
                        </div>
                        <p>There is no patient selected yet.</p>
                    </div>
                @endif


                <div>
                    {{--  --}}
                </div>
            </div>

            <br><br>

            <div class="x-flex x-flex-xstart">
                <div class="ui dropdown labeled icon button small {{ empty($order['id']) ? 'disabled' : '' }}" x-init="$('.ui.dropdown').dropdown()" style="z-index: 400">
                    <i class="add icon"></i>
                    <span class="">Add Item</span>
                    <div class="menu">
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
                            @foreach (App\Models\Item::all() as $item)
                                <div class="item">
                                    <div class="x-flex x-flex-xbetween x-gap-1">
                                        <div>
                                            <div>{{ $item->item_name }}</div>
                                            <small>
                                                <i class="fa-solid fa-peso-sign"></i> {{ $item->item_price }} • {{ $item->item_desc }}
                                            </small>
                                        </div>
                                        <div><button wire:click.prevent="orderAddItem({{ $item->id }}, {{ $item->item_price }})" class="ui button mini">+</button></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="field">
                <div class="ui relaxed celled list">

                    @if (!empty($order['id']))
                        @foreach (App\Models\Ordered_item::with('item')->where('order_id', $order['id'])->latest()->get() as $ordered_item)
                            <div class="item">
                                <div class="x-flex x-flex-xbetween x-flex-ycenter x-gap-1 py_3">
                                    <div class="x-flex x-gap-1">
                                        <div class="x-flex x-flex-ycenter">
                                            <button wire:click.prevent="disableOn({{ $ordered_item->id }}, {{ $ordered_item->item->item_price }}, 1, 'dec')" class="ui button tertiary mini icon blue {{ $ordered_item->ordered_item_qty > 1 ? '' : 'disabled'; }}"><i class="minus icon"></i></button>
                                            <div class="px_6">{{ $ordered_item->ordered_item_qty }}</div>
                                            <button wire:click.prevent="disableOn({{ $ordered_item->id }}, {{ $ordered_item->item->item_price }}, 5, 'inc')" class="ui button tertiary mini icon blue {{ $ordered_item->ordered_item_qty < 20 ? '' : 'disabled'; }}"><i class="add icon"></i></button>
                                        </div>
                                        <div>
                                            <div>{{ $ordered_item->item->item_name }}</div>
                                            <small>{{ $ordered_item->item->item_price }}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <button wire:click.prevent="removeItem({{ $ordered_item->id }})" class="ui button mini icon red tertiary"  title="Remove Item"><i class="close icon"></i></button>
                                    </div>
                                </div> 
                            </div>
                        @endforeach
                    @endif


                        {{ $item['price'] }}

                </div>
                <div>
                    <div class="ui input fluid">
                        <textarea wire:model.lazy="description" style="width: 100%" placeholder="Enter description if there's any..."></textarea>
                    </div>
                </div>
            </div>

            <div class="x-dashed-top-2 mt_13 mb_15"></div>
            
            <div class="">
                <select name="" id="" class="ui dropdown compact mini">
                    <option class="item" value="" selected hidden>Payment Type</option>
                    <option class="item" value="">On Hand</option>
                    <option class="item" value="">GCash</option>
                </select>
            </div><br>
            
            <form wire:submit.prevent="there" id="submit_payment">
                <div class="grid grid_col_2 gap_1">
                    <div>
                        <label for="">Deposit</label>
                        <div class="ui labeled input small fluid @if (session()->has('deposit')) error @endif">
                            <label for="deposit" class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                            <input wire:model.lazy="deposit" type="number" step="0.01" min="0" placeholder="Deposit" id="deposit">
                        </div>

                        <label for="">Discount</label>
                        <div class="ui labeled input small fluid @if (session()->has('discount')) error @endif">
                            <label for="discount" class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                            <input wire:model.lazy="discount" type="number" step="0.01" min="0" placeholder="Discount" id="discount">
                        </div>
                    </div>

                    <div>
                        <label for="">Balance</label>
                        <div class="ui labeled input small fluid">
                            <label class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                            <input type="text" value="{{ number_format($balance, 2) }}" readonly>
                            <input wire:model="balance" type="text" readonly hidden style="opacity: 0">
                        </div>
                        <label for="">Total Amount</label>
                        <div class="ui labeled input small fluid">
                            <label class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                            <input type="text" value="{{ number_format($total, 2) }}" readonly/>
                            <input wire:model="total" type="text" readonly hidden style="opacity: 0">
                        </div>
                    </div>
                </div>
                <br>
                <div class="grid grid_col_2 gap_1">
                    <div>
                        <label for="">Cash</label>
                        <div class="ui labeled input small fluid @if (session()->has('cash')) error @endif">
                            <label class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                            <input wire:model.lazy="cash" type="number" step="0.01" min="0" placeholder="Enter Cash...">
                        </div>
                    </div>
                    <div>
                        <label for="">Change</label>
                        <div class="ui labeled input small fluid">
                            <label class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                            <input type="text" value="{{ number_format($change, 2) }}" readonly/>
                            <input wire:model="change" type="text" hidden style="opacity: 0">
                        </div>
                    </div>
                </div>
            </form>

            @if ($balance > 0)
                <div class="grid grid_col_2 gap_1 mt_20">
                    <div>
                        <label for="">Due Date</label>
                        <div class="ui input tiny fluid">
                            <input wire:model="duedate" wire:bind="duedate" type="date">
                        </div>
                        {{ $duedate }}
                    </div>
                    <div></div>
                </div>
            @endif
        

        @elseif ($modal['sendorder'])
            kdjkdj   









        @elseif ($modal['viewOrder'])
            <br>
            <center style="margin-bottom:25px; margin-top:15px;"><h3>DANGO OPTICAL CLINIC</h3></center>
            <style>
                table.table1 {
                    font-family: Arial, Helvetica, sans-serif;
                    border: 3px solid rgb(175, 175, 175);
                    border-collapse: collapse;
                }
                .table1 th, .table1 td {
                    border: 1px solid lightgray;
                    padding: 7px 5px;
                }
                .bb {
                    border-bottom: 1px solid black;
                }
                .text-center {
                    text-align: center;
                }
                .text-right {
                    text-align: right;
                }
            </style>

            @foreach ($orderDetails as $order)
                @foreach ($selectedOrders as $selected)
                    @if ($order->id == $selected)
                        <div style="padding-bottom:30px">
                            <table class="table1" style="width:100%;">
                                <tr>
                                    <td colspan="5"><b>NAME: </b><span class="" style="font-size:16px;">{{ Str::title($order->patient->patient_lname . ', ' . $order->patient->patient_fname . ' ' . $order->patient->patient_mname) }}</span></td>
                                    <td colspan="2"><b>AGE: </b>{{ $order->patient->patient_age }}</td>
                                </tr>
                                <tr>
                                    <td colspan="7"><b>ADDRESS: </b>{{ $order->patient->patient_address}}</td>
                                </tr>
                                <tr>
                                    <th colspan="7" style="padding:12px 0"><center><span class="ui header">REFRACTION</span></center></th>
                                </tr>
                                <tr>
                                    <th class="text-center">RX</th>
                                    <th class="text-center">SPH</th>
                                    <th class="text-center">CYL</th>
                                    <th class="text-center">AXIS</th>
                                    <th class="text-center">NVA</th>
                                    <th class="text-center">PH</th>
                                    <th class="text-center">CVA</th>
                                </tr>
                                <tr>
                                    <th class="text-center">OD</th>
                                    <td class="text-center">{{ $order->exam->exam_OD_SPH }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OD_CYL }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OD_AXIS }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OD_NVA }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OD_PH }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OD_CVA }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">OS</th>
                                    <td class="text-center">{{ $order->exam->exam_OS_SPH }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OS_CYL }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OS_AXIS }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OS_NVA }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OS_PH }}</td>
                                    <td class="text-center">{{ $order->exam->exam_OS_CVA }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">ADD</th>
                                    <td colspan="2">{{ $order->exam->exam_ADD }}</td>
                                    <th class="text-center">P. D.</th>
                                    <td colspan="3">{{ $order->exam->exam_PD }}</td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-top:12px; padding-bottom:12px;"><b style="margin-right:8px;">REMARKS: </b> {{ $order->exam->exam_remarks }}</td>
                                </tr>

                                <tr>
                                    <th class="text-center">LENSE</th>
                                    <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->lense }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">FRAME</th>
                                    <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->frame }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">TINT</th>
                                    <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->tint }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">OTHERS</th>
                                    <td colspan="6" style="padding-top:12px; padding-bottom:12px;">{{ $order->others }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                @endforeach
            @endforeach
        @else
            <br><br>
            <div class="x-flex x-flex-center">
                <button wire:click.prevent="addOrder" class="ui button primary basic massive"><i class="add icon"></i> ADD</button>
            </div>
        @endif        
    @endsection
</x-organisms.modal>
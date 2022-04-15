<x-organisms.modal>

    @section('modal_title')
        <div>
            
        </div>
        <div class="">
            <x-atoms.ui.button wire:click.prevent="closeModal" class="basic tiny">Close</x-atoms.ui.button>
            <x-atoms.ui.button class="secondary tiny" form="" type="submit">Save</i></x-atoms.ui.button>
        </div>
    @endsection

    @section('modal_body')

        
        @if ($hasOrder)
            <br>

            <div class="x-flex x-flex-xbetween x-flex-ystart">    
                <div class="x-flex x-flex-ycenter x-gap-1">
                    <div>
                        <x-atom.profile-photo size="3em" path="{{ $this->storage($pt['avatar']) }}" />
                    </div>
                    <div>
                        <div>
                            <span class="ui text large">
                                {{ $this->getFullName($orderPatientId) }}
                            </span>
                        </div>
                        <small>@if (!empty($pt['addr'])) <i class="fa-solid fa-location-dot mr_2"></i> {{ $pt['addr'] }}@endif</small>
                    </div>
                </div>
                <div>
                    <div class="ui dropdown icon button mini" x-init="$('.ui.dropdown').dropdown()" style="z-index: 500">
                        <i class="add user icon"></i>
                        {{-- <span class="">Patient</span> --}}
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
                                @foreach (App\Models\Patient::all() as $pt)
                                    <div wire:click.prevent="orderAssignPatient({{ $pt->id }})" class="item">
                                        <div class="x-flex x-flex-ycenter x-gap-1">
                                            <x-atom.profile-photo size="2.5em" path="{{ $this->storage($pt->patient_avatar) }}" />
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
                </div>
            </div>

            <br><br>

            <div class="x-flex x-flex-xstart">
                <div class="ui dropdown labeled icon button small" x-init="$('.ui.dropdown').dropdown()" style="z-index: 400">
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
                                        <div><button wire:click.prevent="orderAddItem({{ $item->id }})" class="ui button mini">+</button></div>
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

                    @foreach (App\Models\Ordered_item::with('item')->where('order_id', $order['id'])->latest()->get() as $ordered_item)
                        <div class="item">
                            <div class="x-flex x-flex-xbetween x-flex-ycenter x-gap-1 py_3">
                                <div class="x-flex x-gap-1">
                                    <div class="x-flex x-flex-ycenter">
                                        <button wire:click.prevent="disableOn({{ $ordered_item->id }}, 1, 'dec')" class="ui button tertiary mini icon blue {{ $ordered_item->ordered_item_qty > 1 ? '' : 'disabled'; }}"><i class="minus icon"></i></button>
                                        <div class="px_6">{{ $ordered_item->ordered_item_qty }}</div>
                                        <button wire:click.prevent="disableOn({{ $ordered_item->id }}, 5, 'inc')" class="ui button tertiary mini icon blue {{ $ordered_item->ordered_item_qty < 5 ? '' : 'disabled'; }}"><i class="add icon"></i></button>
                                    </div>
                                    <div>
                                        <div>{{ $ordered_item->item->item_name }}</div>
                                        <small>{{ $ordered_item->item->item_desc }}</small>
                                    </div>
                                </div>
                                <div class="x-flex x-gap-1">
                                    <div class="ui input mini" style="width:7em">
                                        <input wire:model="item.price" type="text" placeholder="Enter Price..." style="text-align: right">
                                    </div>
                                    <button wire:click.prevent="removeItem({{ $ordered_item->id }})" class="ui button mini icon red tertiary"  title="Remove Item"><i class="close icon"></i></button>
                                </div>
                            </div> 
                        </div>
                    @endforeach


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
            kdjkdjf

            



        @else
            <br><br>
            <div class="x-flex x-flex-center">
                <button wire:click.prevent="addOrder" class="ui button primary basic massive"><i class="add icon"></i> ADD</button>
            </div>
        @endif


        {{-- @if ($modal['sendorder'])
            kjfkdjf
        @else
        @endif --}}
    

      
        
    @endsection
</x-organisms.modal>
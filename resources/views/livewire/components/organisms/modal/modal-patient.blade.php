@php    
    $totalAmount = 0;

    $formId = '';
    $examPurchase_newBtnWireclick = '';
    $examPurchase_newBtnLabel = '';
    // $label = '';

    if ($modal['isAddPatient']) {
        $wireSubmitTo = 'addPt';
        $formId = 'addPatient';
        // $label = 'Add Patient';
    }
    if ($modal['isUpdatePatient']) {
        $wireSubmitTo = 'updatePt';
        $formId = 'updatePatient';
        // $label = 'Update Patient';
    }
    if ($modal['tabs']) {
        $wireSubmitTo = 'updatePt';
        $formId = 'updatePatient';
        // $label = 'Update Patient';
    }
    if($modal['exam_purchase_tab'] == 1) {
        $examPurchase_newBtnWireclick = 'newExam(' . $pt['id'] . ')';
        $examPurchase_newBtnLabel = '+ New';
    }
    if ($modal['exam_purchase_tab'] == 2) {
        $examPurchase_newBtnWireclick = 'purchaseNewItem(' . $pt['id'] . ')';
        $examPurchase_newBtnLabel = '+ New';
    }
@endphp



<x-organisms.modal>

    @section('modal_title')
        <div>
            @if ($modal['isAddPatient'] || $modal['isUpdatePatient'])
                {{-- <label for="patient_avatar" class="btn"><i class="fa-solid fa-add mr-2"></i> {{ !empty($previewAvatar) || !empty($pt['avatar']) ? 'Change Avatar' : 'Add Avatar' }}</label>         --}}
            @elseif ($modalTab == 2)
                <div class="tooltip tooltip-bottom" data-tip="Download exam as PDF">
                    <x-atoms.ui.button class="btn-circle btn-sm" wire:click.prevent="downloadPrescription"><i class="fa-solid fa-download"></i></x-atoms.ui.button>
                </div>
            @endif
        </div>
        <div>
            <x-atoms.ui.modal-title>
                @if ($modal['isAddPatient'])
                    ADD PATIENT
                @elseif ($modal['isUpdatePatient'])
                    EDIT PATIENT
                @endif
            </x-atoms.ui.modal-title>
        </div>
        <div>
            <x-atoms.ui.btn-close-modal/>
            @if ($modal['isAddPatient'] || $modal['isUpdatePatient'])
                <x-atoms.ui.button class="btn-primary ml-2" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
            @endif
        </div>
    @endsection

    @section('modal_body')

        @if ($modal['isAddPatient'] || $modal['isUpdatePatient'])
            <br>
            <form wire:submit.prevent="{{ $wireSubmitTo }}" id="{{ $formId }}">
                <input wire:model.defer="pt.id" type="hidden" name="">
                
                <div>
                    <div class="flex gap_1 flex_center mt_10">
                        <div class="tooltip" data-tip="Click Avatar">
                            <label for="patient_avatar">                                
                                <div class="tooltip" data-tip="Click Avatar"> 
                                    @if ($previewAvatar)
                                        <x-atoms.ui.avatar src="{{ $previewAvatar->temporaryUrl() }}" size="5em"/>
                                    @else
                                        <x-atoms.ui.avatar src="{{ avatar($pt['avatar']) }}" size="5em"/>
                                    @endif
                                </div>
                                <input wire:model="previewAvatar" type="file" name="" id="patient_avatar" style="opacity:0;" hidden>     
                            </label>
                        </div>
                    </div>
                    @error('pt.avatar') <span class="ui text error">{{ $message }}</span> @enderror
                </div>

                <x-molecules.ui.field class="grid-cols-2">
                    <div>
                        <x-atoms.ui.label>First name <x-atoms.ui.required/> @error('pt.fname') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="pt.fname" type="text" class="mb-3" placeholder="Enter First Name..."/>

                        <x-atoms.ui.label>Last name <x-atoms.ui.required/> @error('pt.lname') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="pt.lname" type="text" class="mb-3" placeholder="Enter Last Name..."/>

                        <x-atoms.ui.label>Middle initial</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="pt.mname" type="text" class="mb-3" placeholder="Enter Middle Name..."/>

                        <x-atoms.ui.label>Age <x-atoms.ui.required/> @error('pt.age') <span class="ui text red"> • {{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="pt.age" type="number" class="mb-3" placeholder="Enter Age..."/>
                    </div>
                    <div>
                        <x-atoms.ui.label>Gender</x-atoms.ui.label>    
                        <x-atoms.ui.select wire:model.defer="pt.gender" class="mb-3">
                            <option value="" selected hidden>Select</option>
                            <option class="item" value="m">Male</option>
                            <option class="item" value="f">Female</option>
                        </x-atoms.ui.select>
                        <x-atoms.ui.label>Occupation</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="pt.occ" type="text" class="mb-3" placeholder="Enter Occupation..."/>

                        <x-atoms.ui.label>Address</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="pt.addr" type="text" class="mb-3" placeholder="Enter Address..."/>
                    </div>
                </x-molecules.ui.field>

                <x-molecules.ui.field class="grid-cols-2">
                    <div>
                        <x-atoms.ui.label>Contact number @error('pt.no') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                        <x-molecules.ui.input-group wire-model="pt.no" placeholder="9091293802">
                            +63
                        </x-molecules.ui.input-group>
                    </div>
                    <div>
                        <x-atoms.ui.label>Email address @error('pt.email') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="pt.email" type="email" class="mb-3" placeholder="example@email.com"/>
                    </div>
                </x-molecules.ui.field>

                <x-molecules.ui.field class="grid-cols-2">
                    <div>
                        <x-atoms.ui.label for="queue" class="flex align-center">
                            <x-atoms.ui.checkbox class="checkbox-sm" wire-model="pt.queue" id="queue"/>
                            <span class="ml-2">
                                Add to Exam List
                            </span>
                        </x-atoms.ui.label>
                    </div>
                </x-molecules.ui.field>

            </form>
      

        @elseif ($modal['tabs'])
            <br>
            <div class="flex justify-items-start gap-2">
                <div>
                    <x-atoms.ui.avatar size="3em" src="{{ avatar($pt['avatar']) }}"/>
                </div>
                <div>
                    <div class="font-bold">{{ $pt['fullname'] }}</div>
                    <div class="text-sm opacity-50">{{ $pt['age'] }} • {{ $pt['addr'] }}</div>
                </div>
            </div>
            {{-- <div class="ui divider"></div> --}}
            <div class="mb-10 mt-10">
                <div class="flex justify-between items-center gap_1" style="{{ $editExamHistory ? 'display:none': ''; }}"> <!-  hide div when editing from exam history of the patient --!>
                    <div>
                        <x-organisms.ui.tabs>
                            <x-organisms.ui.tabs.tab wire:click.prevent="modal_tab(1, {{ $patientId }})" class="{{ $modalTab == 1 ? 'tab-active' : '' }}">
                                About
                            </x-organisms.ui.tabs.tab>
                            <x-organisms.ui.tabs.tab wire:click.prevent="modal_tab(2, {{ $patientId }})" class="{{ $modalTab == 2 ? 'tab-active' : '' }}">
                                Exam
                            </x-organisms.ui.tabs.tab>
                            <x-organisms.ui.tabs.tab wire:click.prevent="modal_tab(3, {{ $patientId }})" class="{{ $modalTab == 3 ? 'tab-active' : '' }}">
                                Purchase
                            </x-organisms.ui.tabs.tab>
                        </x-organisms.ui.tabs>
                    </div>
                    <div>
                        @if ($modalTab == 2)
                            @role(['sadmin','admin'])
                                <button class="btn btn-sm btn-success btn-outline" 
                                    wire:click.prevent="createExam({{ $patientId }})">+ New</button>
                            @endrole
                        @elseif ($modalTab == 3)
                            <button class="btn btn-sm btn-success btn-outline" 
                                wire:click.prevent="createPurchase({{ $pt['id'] }})">+ New</button>
                        @endif
                           
                    </div>
                </div>
            </div>

{{-- 
            @switch($modal['exam_purchase_tab'])
                @case(1)
                    @if ($exam['last'])
                        
                        @include('livewire.components.organisms.modal.modal-patient.patient-exam')
                        
                        <div class="mt_6">
                            <div class="flex flex_x_between flex_y_center">
                                <div>
                                </div>
                                <div>
                                    <button wire:click.prevent="deleteExam({{ $exam['id'] }})"  class="ui tertiary button tiny red">
                                        Remove
                                    </button>
                                    <button type="submit" form="saveExam" class="ui button secondary tiny">
                                        @if (session()->has('savedExam'))
                                            {{ session('savedExam') }}<i class="fa-solid fa-circle-check ml_3"></i>
                                        @else
                                            Save Exam
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    @break

                @case (2)
                    @if (! empty($latestPurchase))
                        <div class="field x-flex x-flex-xend">
                            <div class="ui dropdown floating labeled icon button blue tiny" x-init="$('.ui.dropdown').dropdown()" style="z-index: 400">
                                <i class="dropdown icon"></i>
                                <span class="">Select Item</span>
                                <div class="menu fluid left">
                                    <div class="ui icon search input">
                                        <i class="search icon"></i>
                                        <input type="text" placeholder="Search Items...">
                                    </div>
                                    <div class="divider"></div>
                                    <div class="scrolling menu">
                                        @foreach (App\Models\Item::all() as $item)
                                            <div class="item">
                                                <div class="x-flex x-flex-xbetween x-gap-1">
                                                    <div>
                                                        <div>
                                                            {{ $item->item_name }}
                                                        </div>
                                                        <small>
                                                            <i class="fa-solid fa-peso-sign"></i> {{ $item->item_price }} • {{ $item->item_desc }}
                                                        </small>
                                                    </div>
                                                    <div>
                                                        <button class="ui circular icon button tiny" wire:click.prevent="addItem('{{ $purchase['id'] }}', {{ $item->id }}, {{ $item->item_price }})">
                                                            <i class="icon add"></i>
                                                        </button>
                                                    </div>
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
                                <x-organisms.ui.table class="unstackable">
                                    <x-slot name="thead"></x-slot>
                                    <x-slot name="tbody">
                                        @forelse ($selectedItems as $selectedItem)  
                                            <tr>
                                                <td style="width:7em">
                                                    <div class="x-flex x-flex-ycenter">
                                                        <button wire:click.prevent="inc_dec_item('dec', {{ $selectedItem->id }})" class="ui button blue tertiary mini icon {{ $selectedItem->qty == 1 ? 'disabled' : ''  }}"><i class="minus icon"></i></button>
                                                        <div class="px_6">{{ $selectedItem->qty }}</div>
                                                        <button wire:click.prevent="inc_dec_item('inc', {{ $selectedItem->id }})" class="ui button blue tertiary mini icon" {{ ($selectedItem->qty == 20) || ($this->checkItemQty($selectedItem->item_id) == 0) ? 'disabled' : ''  }}><i class="add icon"></i></button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div data-tooltip="{{ $this->remainingItems($selectedItem->item_id) }}" data-position="top left" data-inverted="" data-variation="mini">
                                                        {{ $selectedItem->item->item_name }}
                                                    </div>
                                                    <small>
                                                        <i class="fa-solid fa-peso-sign"></i> 
                                                        {{ $selectedItem->item->item_price }} • {{ $selectedItem->item->item_desc }}
                                                    </small>
                                                </td>
                                                <td class="right aligned" style="width: 3em">
                                                    <button wire:click.prevent="removeItem({{ $selectedItem->id }})" class="ui button mini icon red tertiary"  data-inverted="" data-tooltip="Remove Item" data-position="top right" data-variation="mini"><i class="close icon"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <i class="fa-solid fa-circle-exclamation mr_3"></i> Empty.
                                                    <span wire:click.prevent="deletePurchase({{ $purchase['id'] }})" class="mr_5 red pointer"> 
                                                        Click remove empty purchase.
                                                    </span>
                                                </td>
                                            </tr>
                                    @endforelse
                                    </x-slot>
                                </x-organisms.ui.table>                             
                            </div>
                        </div>
                        <br>

                        @if (count($selectedItems) > 0)

                            <div class="pt_10">
                                <select name="" id="">
                                    <option value="" selected hidden>Payment Type</option>
                                    <option value="">On Hand</option>
                                    <option value="">GCash</option>
                                </select>
                            </div><br>
                            <form wire:submit.prevent="savePayment({{ $latestPurchase }})" id="submit_payment">
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

                                <div class="grid grid_col_2 gap_1 mt_20">
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

                            <div class="text_right mt_15">
                                <button wire:click.prevent="deletePurchase({{ $purchase['id'] }})"  class="ui tertiary button tiny red">
                                    Remove
                                </button>
                                <button type="submit`" form="submit_payment" class="ui button secondary tiny">
                                    @if (session()->has('savedPayment'))
                                        {{ session('savedPayment') }}<i class="fa-solid fa-circle-check ml_3"></i>
                                    @else
                                        Save Payment
                                    @endif
                                </button>
                            </div>

                            <div class="x-dashed-top-2" style="margin-top:1em; padding-top:0.5em">
                                Item not available for patient? <a wire:click.prevent="makeOrder" ><b>Order</b></a>
                            </div>
                        @endif
                    @endif

                    @break

                @case(3)
                        @include('livewire.components.organisms.modal.modal-patient.patient-details')
                    @break
               
                @default
                    
            @endswitch --}}



            
            @switch($modalTab)
                @case(1)
                    @include('livewire.components.organisms.modal.modal-patient.patient-details')
                    @break

                @case(2)
                    @if ($modal['tab_hasExam'])
                        
                        @include('livewire.components.organisms.modal.modal-patient.patient-exam')

                            
                        
                        <br>
                        <div class="mt_6">
                            <div>

                                @if ($removeExam)
                                    <div>
                                        <div  class="ui warning message">
                                            <div class="x-flex x-flex-xbetween x-gap-1">
                                                <div>
                                                    <div class="header">Removing exam</div>
                                                    This exam will be removed. Are you sure?
                                                </div>
                                                <div>
                                                    <x-atoms.ui.button wire:click.prevent="$set('removeExam', false)" class="btn-sm btn-outline">No</x-atoms.ui.button>
                                                    <x-atoms.ui.button wire:click.prevent="deleteExam({{ $exam['id'] }})" class="btn-sm btn-error">Yes</x-atoms.ui.button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex justify-between flex-items-center">
                                        <div>
                                            <div class="form-control">
                                                <label class="label cursor-pointer">
                                                    <input wire:model="createOrder" type="checkbox" checked="checked" class="checkbox checkbox-primary" />
                                                    <span class="label-text ml-2">Mark as Order</span> 
                                                </label>
                                              </div>
                                            {{-- <button wire:click.prevent="createOrder" class="btn">Mark as Order</button> --}}
                                            {{-- <x-atoms.ui.button @click="open = ! open" class="btn-ghost {{ empty($exam['id']) ? 'disabled' : '' }}">
                                                {{ $orderButtonLabel }}
                                                <i :class="open ? 'angle up' : 'angle down'" class="icon"></i>
                                            </x-atoms.ui.button> --}}
                                        </div>
                                        <div style="display:flex; gap:0.7em">

                                            @role(['sadmin', 'admin'])
                                                <x-atoms.ui.button wire:click.prevent="$set('removeExam',true)" class="btn-ghost">
                                                    Remove exam
                                                </x-atoms.ui.button>
                                                <x-atoms.ui.button type="submit" form="saveExam" class="btn-primary">
                                                    @if (session()->has('savedExam'))
                                                        {{ session('savedExam') }}<i class="fa-solid fa-circle-check ml_3"></i>
                                                    @else
                                                        Save exam
                                                    @endif
                                                </x-atoms.ui.button>
                                            @endrole

                                        </div>
                                    </div>
                                @endif
                                {{-- <form x-show="open" wire:submit.prevent="createOrder" id="createOrderForm">
                                    <div class="ui divider"></div>
                                    <div>
                                        <x-atoms.ui.label>Lense</x-atoms.ui.label>
                                        <textarea class="input input-bordered w-full" wire:model.lazy="orderLense" placeholder="Enter lense..." rows="2"></textarea>

                                        <x-atoms.ui.label>Frames</x-atoms.ui.label>
                                        <textarea class="input input-bordered w-full" wire:model.lazy="orderFrame" placeholder="Enter frames..." rows="2"></textarea>
                                  
                                        <x-atoms.ui.label>Tint</x-atoms.ui.label>
                                        <textarea class="input input-bordered w-full" wire:model.lazy="orderTint" placeholder="Enter tint..." rows="2"></textarea>

                                        <x-atoms.ui.label>Others</x-atoms.ui.label>
                                        <textarea class="input input-bordered w-full" wire:model.lazy="orderOthers" placeholder="Please specify..." rows="2"></textarea>
                                    </div>
                                    <br>

                                    @if ($removeOrder) 
                                        <div>
                                            <div  class="ui warning message">
                                                <div class="x-flex x-flex-xbetween x-gap-1">
                                                    <div>
                                                        <div class="header">Remove order</div>
                                                        This order will be removed. Are you sure?
                                                    </div>
                                                    <div>
                                                        <x-atoms.ui.button wire:click.prevent="$set('removeOrder', false)" class="btn-sm btn-outline">No</x-atoms.ui.button>
                                                        <x-atoms.ui.button wire:click.prevent="removeOrder({{ $exam['id'] }})" class="btn-sm btn-error">Yes</x-atoms.ui.button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span style="opacity: 0.5">Status: </span>To order
                                            </div>
                                            <div style="display:flex; gap:0.8em">
                                                <button class="btn btn-ghost"
                                                    @if ($orderButtonLabel == 'View order')
                                                        wire:click.prevent="$set('removeOrder', true)">Remove Order 
                                                    @else
                                                        wire:click.prevent="resetOrderField">Reset
                                                    @endif
                                                </button>
                                                <button type="submit" form="createOrderForm" class="btn {{ empty($orderLense) && empty($orderFrame) && empty($orderTint) && empty($orderOthers) ? 'btn-disabled' : '' }}">
                                                    @if (session()->has('orderSave'))
                                                        {{ session('orderSave') }}<i class="fa-solid fa-circle-check mr-2"></i>
                                                    @else
                                                        Save order
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    @endif


                                  

                                </form>    --}}

                             </div>
                        </div>
                    @endif
                    @break

                @case(3)
                    @if ($modal['tab_hasPurchase'])
                        <div class="field x-flex x-flex-xend">

                            <div class="ui dropdown icon" x-init="$('.ui.dropdown').dropdown()" style="z-index: 400">
                                <label class="btn mb-3">
                                    <i class="fa-solid fa-add mr-2"></i>
                                    Add Item
                                </label>    
                                <div class="mt-2 menu shadow-xl overflow-hidden" style="border-radius: 1em; left:unset; right:0;">
                                    <div class="p-3 search">
                                        <input class="input input-bordered w-full" type="text" placeholder="Search Items...">
                                    </div>
                                    <div class="dropdown-content scrolling menu">
                                        @foreach (App\Models\Item::select(['id','item_name','item_price','item_qty'])->get() as $item)
                                            <div class="item flex align-center {{ $item->item_qty == 0 ? 'disabled' : '' }}">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <div class="font-bold">
                                                            {{ $item->item_name }}
                                                        </div>
                                                        <div class="text-sm opacity-50">
                                                            <i class="fa-solid fa-peso-sign"></i> {{ $item->item_price }} • {{ $item->item_qty }} left
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <x-atoms.ui.button class="btn-circle btn-primary btn-sm" wire:click.prevent="addItem({{ $purchase['id'] }}, {{ $item->id }}, {{ $item->item_price }})">
                                                            <i class="fa-solid fa-add"></i>
                                                        </x-atoms.ui.button>
                                                    </div>
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
                                <x-organisms.ui.table class="unstackable table-purchase-item-list">
                                    <x-slot name="thead"></x-slot>
                                    <x-slot name="tbody">
                                        @forelse ($selectedItems as $selectedItem)  
                                            <tr>
                                                <td style="width:7em; padding:0.7em 0.3em;">
                                                    <div class="flex items-center">
                                                        <x-atoms.ui.button wire:click.prevent="inc_dec_item('dec', {{ $selectedItem->id }})" class="btn-circle btn-sm btn-ghost {{ $selectedItem->qty == 1 ? 'btn-disabled' : ''  }}"><i class="fa-solid fa-minus"></i></x-atoms.ui.button>
                                                        <div class="font-bold text-blue-500 text-base px-4">{{ $selectedItem->qty }}</div>
                                                        <x-atoms.ui.button wire:click.prevent="inc_dec_item('inc', {{ $selectedItem->id }})" class="btn-circle btn-sm btn-ghost {{ ($selectedItem->qty == 20) || ($this->checkItemQty($selectedItem->item_id) == 0) ? 'btn-disabled' : ''  }}"><i class="fa-solid fa-add"></i></x-atoms.ui.button>
                                                    </div>
                                                </td>
                                                <td style="padding:0.7em 0.3em;">
                                                    <div class="font-bold" style="white-space:normal"> 
                                                        {{ $selectedItem->item->item_name }}
                                                    </div>
                                                    <div class="text-sm opacity-50">
                                                        <i class="fa-solid fa-peso-sign"></i> 
                                                        {{ $selectedItem->item->item_price }} • {{ $this->remainingItems($selectedItem->item_id) }}
                                                    </div>
                                                </td>
                                                <td class="right aligned" style="width:3em; padding:0.7em 0.3em;">
                                                    <x-atoms.ui.button wire:click.prevent="removeItem({{ $selectedItem->id }})" class="btn-circle btn-sm btn-error btn-outline"><i class="fa-solid fa-close"></i></x-atoms.ui.button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <i class="fa-solid fa-circle-exclamation mr_3"></i> Empty.
                                                    <a wire:click.prevent="deletePurchase()" class="mr_5 red pointer"> 
                                                        Click to remove.
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </x-slot>
                                </x-organisms.ui.table>                             
                            </div>
                        </div>

                        @if (count($selectedItems) > 0)

                            <div class="ui divider"></div>

                            <form wire:submit.prevent="savePayment({{ $purchase['id'] }})" id="submit_payment" class="pt-2">
                                <div>
                                    <x-atoms.ui.select wire:model.defer="payment_type" class="mb-3">
                                        <option value="None">None</option>
                                        @foreach (App\Models\Cash_type::select(['type', 'id'])->get() as $cash)
                                            <option value="{{ $cash->type }}">{{ $cash->type }}</option>
                                        @endforeach
                                    </x-atoms.ui.select>
                                </div>
                                <x-molecules.ui.field class="grid-cols-2">
                                    <div>
                                        <x-atoms.ui.label for="">Deposit</x-atoms.ui.label>
                                        <div class="input-group">
                                            <span><i class="fa-solid fa-peso-sign"></i></span>
                                            <input wire:model.lazy="deposit" class="input w-full input-bordered @if (session()->has('deposit')) input-error @endif" type="number" step="0.01" min="0" placeholder="Deposit" id="deposit">
                                        </div>

                                        <x-atoms.ui.label>Discount</x-atoms.ui.label>
                                        <div class="input-group">
                                            <span><i class="fa-solid fa-peso-sign"></i></span>
                                            <input wire:model.lazy="discount" class="input w-full input-bordered @if (session()->has('discount')) input-error @endif" type="number" step="0.01" min="0" placeholder="Discount" id="discount">
                                        </div>
                                    </div>

                                    <div>
                                        <x-atoms.ui.label>Balance</x-atoms.ui.label>
                                        <div class="input-group">
                                            <span><i class="fa-solid fa-peso-sign"></i></span>
                                            <input wire:model="balance" type="text" readonly hidden style="opacity: 0">
                                            <input type="text" value="{{ number_format($balance, 2) }}" class="input w-full input-bordered" readonly>
                                        </div>
                                        <x-atoms.ui.label>Total Amount</x-atoms.ui.label>
                                        <div class="input-group">
                                            <span><i class="fa-solid fa-peso-sign"></i></span>
                                            <input wire:model="total" type="text" readonly hidden style="opacity: 0">
                                            <input type="text" value="{{ number_format($total, 2) }}" class="input w-full input-bordered" readonly/>
                                        </div>
                                    </div>
                                </x-molecules.ui.field>

                                <x-molecules.ui.field class="grid-cols-2">
                                    <div>
                                        <x-atoms.ui.label for="">Cash</x-atoms.ui.label>
                                        <div class="input-group">
                                            <span><i class="fa-solid fa-peso-sign"></i></span>
                                            <input wire:model.lazy="cash" class="input w-full input-bordered @if (session()->has('cash')) input-error @endif" type="number" step="0.01" min="0" placeholder="Enter Cash...">
                                        </div>
                                    </div>
                                    <div>
                                        <x-atoms.ui.label>Change</x-atoms.ui.label>
                                        <div class="input-group">
                                            <span><i class="fa-solid fa-peso-sign"></i></span>
                                            <input wire:model="change" type="text" hidden style="opacity: 0">
                                            <input type="text" value="{{ number_format($change, 2) }}" class="input w-full input-bordered" readonly/>
                                        </div>
                                    </div>
                                </x-molecules.ui.field>
                            </form>

                            @if ($balance > 0)
                                <div class="mt-7">
                                    <x-atoms.ui.label for="">Due Date <b>{{ !empty($duedate) ? ' • ' . humanReadableDate($duedate) : '' }}</b></x-atoms.ui.label>
                                    <input wire:model="duedate" value="{{ $duedate }}" class="input input-bordered" type="date">
                                </div>
                            @endif

                            <div class="text_right mt_15">
                                <x-atoms.ui.button wire:click.prevent="deletePurchase()"  class="btn-ghost mr-2">
                                    Remove
                                </x-atoms.ui.button>
                                <button type="submit`" form="submit_payment" class="btn btn-primary">
                                    @if (session()->has('savedPayment'))
                                        {{ session('savedPayment') }}<i class="fa-solid fa-circle-check ml_3"></i>
                                    @else
                                        Save Payment
                                    @endif
                                </button>
                            </div>

                            <div class="x-dashed-top-2" style="margin-top:1em; padding-top:0.5em">
                                Item not available? <a wire:click.prevent="makeOrder" ><b>Order</b></a>
                            </div>
                        @endif
                    @endif
                    @break
               
                @default
                    
            @endswitch
        @endif 

    @endsection

</x-organisms.modal>

{{-- @include('livewire.components.organisms.modal.modal-include-top')

    @if ($modalPatientUpdate)
        @include('livewire.components.molecules.modal.modal-patient-update')
    @endif

    @if ($modalPatientAdd)
        @include('livewire.components.molecules.modal.modal-patient-add')
    @endif

@include('livewire.components.organisms.modal.modal-include-bottom') --}}
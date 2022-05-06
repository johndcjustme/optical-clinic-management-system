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
                <label for="patient_avatar" class="ui button tiny icon"><i class="icon add"></i> {{ !empty($previewAvatar) || !empty($pt['avatar']) ? 'Change Avatar' : 'Add Avatar' }}</label>        
            @elseif ($modalTab == 2)
                <button class="ui button circular icon tiny" wire:click.prevent="downloadPrescription" data-tooltip="Download PDF" data-position="top left" data-inverted="" data-variation="mini"><i class="icon download"></i></button>
            @endif
        </div>
        <div>
            <h5>
                @if ($modal['isAddPatient'])
                    ADD PATIENT
                @elseif ($modal['isUpdatePatient'])
                    EDIT PATIENT
                @endif
            </h5>
        </div>
        <div>
            <a wire:click.prevent="closeModal" class="ui button tiny" rel="modal:close">Close</a>
            @if ($modal['isAddPatient'] || $modal['isUpdatePatient'])
                <x-atoms.ui.button class="secondary tiny" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
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
                        <div>                                
                            @if ($previewAvatar)
                                <x-atoms.ui.avatar src="{{ $previewAvatar->temporaryUrl() }}" size="5em"/>
                            @else
                                <x-atom.profile-photo size="5em" path="{{ $this->storage($pt['avatar']) }}" />
                            @endif
                            <input wire:model="previewAvatar" type="file" name="" id="patient_avatar" style="opacity:0;" hidden>     
                        </div>
                    </div>
                    @error('pt.avatar') <span class="ui text error">{{ $message }}</span> @enderror
                </div>

                <br>
                <div class="ui form">
                    <div class="two fields">
                        <div class="field">
                            <x-atoms.ui.label>First name <x-atoms.ui.required/> @error('pt.fname') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.fname" type="text" class="mb_7" placeholder="Enter First Name..."/>
    
                            <x-atoms.ui.label>Last name <x-atoms.ui.required/> @error('pt.lname') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.lname" type="text" class="mb_7" placeholder="Enter Last Name..."/>
    
                            <x-atoms.ui.label>Middle initial</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.mname" type="text" class="mb_7" placeholder="Enter Middle Name..."/>

                            <x-atoms.ui.label>Age <x-atoms.ui.required/> @error('pt.age') <span class="ui text red"> • {{ $message }}</span> @enderror</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.age" type="number" class="mb_7" placeholder="Enter Age..."/>
                        </div>
                        <div class="field">
                            <x-atoms.ui.label>Gender</x-atoms.ui.label>    
                            <x-atoms.ui.select wire:model.defer="pt.gender" class="mb_7">
                                <option value="" selected hidden>Select</option>
                                <option class="item" value="m">Male</option>
                                <option class="item" value="f">Female</option>
                            </x-atoms.ui.select>
                            <x-atoms.ui.label>Occupation</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.occ" type="text" class="mb_7" placeholder="Enter Occupation..."/>
    
                            <x-atoms.ui.label>Address</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.addr" type="text" class="mb_7" placeholder="Enter Address..."/>
                        </div>
                    </div>
                </div>
                <div class="ui form">
                    <div class="two fields">
                        <div class="field">
                            <x-atoms.ui.label>Contact number @error('pt.no') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <div class="ui labeled input">
                                <div class="ui label">
                                  +63
                                </div>
                                <input type="text" placeholder="e.g 9512558699">
                            </div>
                            {{-- <x-atoms.ui.input wire-model="pt.no" type="text" class="mb_7"/> --}}
                        </div>
                        <div class="field">
                            <x-atoms.ui.label>Email address @error('pt.email') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.email" type="email" class="mb_7" placeholder="example.gmail.com"/>
                        </div>
                    </div>
                </div>
                <br>
                <div class="grid grid_col_2 gap_1">
                    <div>
                        <div class="ui checkbox small">
                            <input wire:model="pt.queue" type="checkbox" class="pointer" id="queue" value="">
                            <label for="queue">Add to Exam List</label>
                        </div>
                    </div>
                    <div class="flex flex_y_center"></div>
                </div>
            </form>
      

        @elseif ($modal['tabs'])
            <br>
            <div class="x-flex x-flex-ycenter x-gap-1">
                <div>
                    <x-atom.profile-photo size="3em" path="{{ $this->storage($pt['avatar']) }}"/>
                </div>
                <div>
                    <strong>{{ $pt['fullname'] }}</strong><br>
                    <small>{{ $pt['age'] }} • {{ $pt['addr'] }}</small>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="mb_20">
                <div class="flex flex_x_between flex_y_center gap_1" 
                    style="{{ $editExamHistory ? 'display:none': ''; }}"> <!-  hide div when editing from exam history of the patient --!>
                    <div class="flex gap_1">
                        <div class="ui menu compact tiny">
                            {{-- <div wire:click.prevent="exam_purchase_tab('patient', {{ $pt['id'] }})" class="item link {{ $modal['exam_purchase_tab'] == 3 ? 'active' : ''; }}">About</div>
                            <div wire:click.prevent="exam_purchase_tab('exam', {{ $pt['id'] }})" class="item link {{ $modal['exam_purchase_tab'] == 1 ? 'active' : ''; }}">Exam</div>
                            <div wire:click.prevent="exam_purchase_tab('purchase', {{ $pt['id'] }})" class="item link {{ $modal['exam_purchase_tab'] == 2 ? 'active' : ''; }}">Purchase</div> --}}


                            <div wire:click.prevent="modal_tab(1, {{ $patientId }})" class="item link {{ $modalTab == 1 ? 'active' : '' }}">About</div>
                            <div wire:click.prevent="modal_tab(2, {{ $patientId }})" class="item link {{ $modalTab == 2 ? 'active' : '' }}">Exam</div>
                            <div wire:click.prevent="modal_tab(3, {{ $patientId }})" class="item link {{ $modalTab == 3 ? 'active' : '' }}">Purchase</div>
                        </div>
                    </div>
                    <div>
                        <button class="ui button green basic tiny"
                            @if ($modalTab == 2)
                                wire:click.prevent="createExam({{ $patientId }})" 
                            @elseif ($modalTab == 3)
                                wire:click.prevent="createPurchase({{ $pt['id'] }})"
                            @endif
                            >
                            + New
                        </button>
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
                            <div x-data="{open: @entangle('showCreateOrderWindow')}">

                                @if ($removeExam)
                                    <div>
                                        <div  class="ui warning message">
                                            <div class="x-flex x-flex-xbetween x-gap-1">
                                                <div>
                                                    <div class="header">Removing exam</div>
                                                    This exam will be removed. Are you sure?
                                                </div>
                                                <div>
                                                    <button wire:click.prevent="$set('removeExam', false)" class="ui button tertiary">No</button>
                                                    <button wire:click.prevent="deleteExam({{ $exam['id'] }})" class="ui button tertiary">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex flex_x_between flex_y_center">
                                        <div>
                                            <button @click="open = ! open" class="ui button tiny tertiary icon {{ empty($exam['id']) ? 'disabled' : '' }}">
                                                {{ $orderButtonLabel }}
                                                <i :class="open ? 'angle up' : 'angle down'" class="icon"></i>
                                            </button>
                                        </div>
                                        <div style="display:flex; gap:0.7em">
                                            {{-- <button wire:click.prevent="deleteExam({{ $exam['id'] }})"  class="ui tertiary button tiny red">
                                                Remove exam
                                            </button> --}}
                                            <button wire:click.prevent="$set('removeExam',true)" class="ui tertiary button tiny red">
                                                Remove exam
                                            </button>
                                            <button type="submit" form="saveExam" class="ui button secondary tiny">
                                                @if (session()->has('savedExam'))
                                                    {{ session('savedExam') }}<i class="fa-solid fa-circle-check ml_3"></i>
                                                @else
                                                    Save exam
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <form x-show="open" wire:submit.prevent="createOrder" id="createOrderForm">
                                    <br>
                                    <div class="ui divider"></div>
                                    <h4>Prepare Order</h4>
                                    <div class="mt_15">
                                        <label>Lense</label>

                                        <div class="ui input fluid">
                                            <textarea wire:model.lazy="orderLense" placeholder="Enter lense..." rows="2" style="width: 100%"></textarea>
                                        </div>
                                    </div>

                                    <div class="mt_15">
                                        <label>Frames</label>
                                        <div class="ui input fluid">
                                            <textarea wire:model.lazy="orderFrame" placeholder="Enter frames..." rows="2" style="width: 100%"></textarea>
                                        </div>
                                    </div>

                                    <div class="mt_15">
                                        <label>Tint</label>
                                        <div class="ui input fluid">
                                            <textarea wire:model.lazy="orderTint" placeholder="Enter tint..." rows="2" style="width: 100%"></textarea>
                                        </div>
                                    </div>

                                    <div class="mt_15">
                                        <label>Others</label>
                                        <div class="ui input fluid">
                                            <textarea wire:model.lazy="orderOthers" placeholder="Please specify..." rows="2" style="width: 100%"></textarea>
                                        </div>
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
                                                        <button wire:click.prevent="$set('removeOrder', false)" class="ui button tertiary">No</button>
                                                        <button wire:click.prevent="removeOrder({{ $exam['id'] }})" class="ui button tertiary">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex flex_x_between flex_y_center">
                                            <div>
                                                <span style="opacity: 0.5">Status: </span>To order
                                            </div>
                                            <div style="display:flex; gap:0.8em">
                                                <button class="ui  button tertiary tiny red"
                                                    @if ($orderButtonLabel == 'View order')
                                                        wire:click.prevent="$set('removeOrder', true)">Remove Order
                                                    @else
                                                        wire:click.prevent="resetOrderField">Reset
                                                    @endif
                                                </button>
                                                <button type="submit" form="createOrderForm" class="ui button secondary tiny {{ empty($orderLense) && empty($orderFrame) && empty($orderTint) && empty($orderOthers) ? 'disabled' : '' }}">
                                                    @if (session()->has('orderSave'))
                                                        {{ session('orderSave') }}<i class="fa-solid fa-circle-check ml_3"></i>
                                                    @else
                                                        Save to order
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    @endif


                                  

                                </form>   

                             </div>
                        </div>
                    @endif
                    @break

                @case(3)
                    @if ($modal['tab_hasPurchase'])
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
                                            <div class="item {{ $item->item_qty == 0 ? 'disabled' : '' }}">
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
                                                        <button class="ui circular icon button tiny" wire:click.prevent="addItem({{ $purchase['id'] }}, {{ $item->id }}, {{ $item->item_price }})">
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
                        <br>

                        @if (count($selectedItems) > 0)

                            <div class="pt_10">
                                <select name="" id="">
                                    <option value="" selected hidden>Payment Type</option>
                                    <option value="">On Hand</option>
                                    <option value="">GCash</option>
                                </select>
                            </div><br>
                            <form wire:submit.prevent="savePayment({{ $purchase['id'] }})" id="submit_payment">
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
                                <button wire:click.prevent="deletePurchase()"  class="ui tertiary button tiny red">
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
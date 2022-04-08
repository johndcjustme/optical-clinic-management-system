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
    if ($modal['isExamPurchase']) {
        $wireSubmitTo = 'updatePt';
        $formId = 'updatePatient';
        // $label = 'Update Patient';
    }
    if($modal['exam_purchase_tab'] == 1) {
        $examPurchase_newBtnWireclick = 'newExam(' . $pt['id'] . ')';
        $examPurchase_newBtnLabel = '+ new';
    }
    if ($modal['exam_purchase_tab'] == 2) {
        $examPurchase_newBtnWireclick = 'purchaseNewItem(' . $pt['id'] . ')';
        $examPurchase_newBtnLabel = '+ New';
    }
@endphp


<x-organisms.modal>

    @section('modal_title')
        <div class="full_w flex flex_x_between">
            <div></div>
            <div>
                <a wire:click.prevent="closeModal" class="ui button tiny basic" rel="modal:close">Close</a>
                <x-atoms.ui.button class="secondary tiny" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
                {{-- <x-atom.btn-save-modal form="{{ $formId }}" val="{{ $label }}"/>   --}}
            </div>
        </div>
    @endsection

    @section('modal_body')

        @if ($modal['isAddPatient'] || $modal['isUpdatePatient'])
            
            <form wire:submit.prevent="{{ $wireSubmitTo }}" id="{{ $formId }}">
                <input wire:model.defer="pt.id" type="hidden" name="">
                
                <div>
                    <div class="flex gap_1 flex_y_center">
                        <div>
                            @if ($previewAvatar)
                                <x-atoms.ui.avatar src="{{ $previewAvatar->temporaryUrl() }}" size="4em"/>
                            @else
                                <x-atom.profile-photo size="4em" path="{{ $this->storage($pt['avatar']) }}" />
                            @endif
                        </div>
                        <div>
                            <label class="ui blue tertiary button" for="patient_avatar">Choose File</label>
                            <input wire:model="previewAvatar" type="file" name="" id="patient_avatar" hidden>     
                        </div>
                    </div>
                    @error('pt.avatar') <span class="ui text error">{{ $message }}</span> @enderror
                </div>

                <br>
                <p class="dark_100 my_10">Personal Information</p>
                <div class="ui form">
                    <div class="two fields">
                        <div class="field">
                            <x-atoms.ui.label>First name @error('pt.fname') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.fname" type="text" class="mb_7"/>
    
                            <x-atoms.ui.label>Last name @error('pt.lname') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.lname" type="text" class="mb_7"/>
    
                            <x-atoms.ui.label>M.I.</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.mname" type="text" class="mb_7"/>

                            <x-atoms.ui.label>Age @error('pt.age') <span class="ui text red"> • {{ $message }}</span> @enderror</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.age" type="number" class="mb_7"/>
                        </div>
                        <div class="field">
                            <x-atoms.ui.label>Gender</x-atoms.ui.label>    
                            <x-atoms.ui.select wire:model.defer="pt.gender" class="mb_7">
                                <option value="" selected hidden>Select</option>
                                <option class="item" value="m">Male</option>
                                <option class="item" value="f">Female</option>
                            </x-atoms.ui.select>
                            <x-atoms.ui.label>Occupation</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.occ" type="text" class="mb_7"/>
    
                            <x-atoms.ui.label>Address</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.addr" type="text" class="mb_7"/>
                        </div>
                    </div>
                </div>

                <div class="ui form">
                    <div class="two fields">
                        <div class="field">
                            <x-atoms.ui.label>Contact number @error('pt.no') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.no" type="text" class="mb_7"/>
                        </div>
                        <div class="field">
                            <x-atoms.ui.label>Email address @error('pt.email') <span class="ui text red"> • {{ $message }}</span> @enderror </x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="pt.email" type="email" class="mb_7"/>
                        </div>
                    </div>
                </div>
                <br>
                <div class="grid grid_col_2 gap_1 mt_10">
                    <div>
                        <div class="ui checkbox small">
                            <input wire:model="pt.queue" type="checkbox" class="pointer" id="queue" value="">
                            <label for="queue">Add to Exam List</label>
                        </div>
                    </div>
                    <div class="flex flex_y_center"></div>
                </div>
            </form>
        @endif

        @if ($modal['isExamPurchase'])
            <div>
                <strong>{{ $pt['fullname'] }}</strong><br>
                <small>{{ $pt['age'] }} • {{ $pt['addr'] }}</small>
            </div>
            
            <div class="mt_15 mb_20">
                <div class="flex flex_x_between flex_y_center gap_1" 
                    style="{{ $editExamHistory ? 'display:none': ''; }}"> <!-  hide div when editing from exam history of the patient --!>
                    <div class="flex gap_1">
                        <div>
                            <button wire:click.prevent="exam_purchase_tab('patient', {{ $pt['id'] }})" class="ui grey small tertiary button {{ $modal['exam_purchase_tab'] == 3 ? 'active' : ''; }}">Patient</button>
                            <button wire:click.prevent="exam_purchase_tab('exam', {{ $pt['id'] }})" class="ui grey small tertiary button {{ $modal['exam_purchase_tab'] == 1 ? 'active' : ''; }}">Exam</button>
                            <button wire:click.prevent="exam_purchase_tab('purchase', {{ $pt['id'] }})" class="ui grey small tertiary button {{ $modal['exam_purchase_tab'] == 2 ? 'active' : ''; }}">Purchase</button>
                        </div>
                    </div>
                    <div>
                        @if ($modal['exam_purchase_tab'] != 3) 
                            <button wire:click.prevent="{{ $examPurchase_newBtnWireclick }}" class="ui button green basic tiny">{{ $examPurchase_newBtnLabel }}</button>
                        @endif
                    </div>
                </div>
            </div>


            @switch($modal['exam_purchase_tab'])
                @case(1)
                    @if ($exam['last'])
                        
                        @include('livewire.components.organisms.modal.modal-patient.patient-exam')
                        
                        <div class="mt_6">
                            <div class="flex flex_x_between flex_y_center">
                                <div>
                                    <p>
                                        <small>
                                            Exams : {{ $exam['history'] }}
                                        </small>
                                    </p>
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
                        <div>
                            <div class="mb_14">
                                <p>
                                    <small class="dark_200">Created at: {{ $this->purchaseDate($latest_purchase['date']) }}</small>
                                </p>
                            </div>
                            <div>
                                <div class="">
                                    <div class="relative">    
                                        <div class="relative">
                                            <div class="ui icon input fluid">
                                                <input wire:model="searchItem" class="ui input primary" type="text" placeholder="Enter Item">
                                                <i class="search icon"></i>
                                            </div>
                                        </div>
                                        @if (! empty($searchItem))
                                            <div class="absolute left right radius_1 overflow_y" style="max-height: 300px; width:100%; background:rgb(232, 232, 255); box-shadow: 0px 10px 25px -4PX rgb(76 90 121 / 40%); z-index:20;">
                                                <ul class="hoverable">
                                                    @if (isset($items))
                                                        @forelse ($items as $item)
                                                                <li class="flex flex_x_between flex_y_center my_10" style="line-height:1rem">
                                                                    <div class="my_5">
                                                                        <div>
                                                                            {{ $item->item_name }}
                                                                        </div>
                                                                        <small class="dark_200">
                                                                            <i class="fa-solid fa-peso-sign"></i> {{ $item->item_price }} • {{ $item->item_desc }}
                                                                        </small>
                                                                    </div>
                                                                    <button wire:click.prevent="addItem('{{ $latest_purchase['id'] }}', {{ $item->id }}, {{ $item->item_price }})" class="pointer btn_small cancel">
                                                                        Add
                                                                    </button>
                                                                </li>
                                                        @empty
                                                            <li>No results.</li>
                                                        @endforelse
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="hoverable my_15" style="line-height: 1rem">
                            @forelse ($selectedItems as $selectedItem)     
                                <li class="flex flex_x_between flex_y_center b_1 my_4">
                                    <div class="flex gap_1 my_3">
                                        <div class="flex flex_y_center" style="gap:0.4em">
                                            <button wire:click.prevent="inc_dec_item('dec', {{ $selectedItem->id }})" class="btn_small cancel" style="padding:0 2px" {{ $selectedItem->qty == 1 ? 'disabled' : ''  }}>
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <a class="text_center" style="width:1.5em; font-weight:bold; font-size:1rem">{{ $selectedItem->qty  }}</a>
                                            <button wire:click.prevent="inc_dec_item('inc', {{ $selectedItem->id }})" class="btn_small cancel" style="padding:0 2px" {{ ($selectedItem->qty == 20) || ($this->checkItemQty($selectedItem->item_id) == 0) ? 'disabled' : ''  }}>
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <div class="mb_4" data-tooltip="{{ $this->remainingItems($selectedItem->item_id) }}" data-position="top left" data-inverted="" data-variation="mini">
                                                {{ $selectedItem->item->item_name }}
                                            </div>
                                            <small class="dark_200">
                                                <i class="fa-solid fa-peso-sign"></i> {{ $selectedItem->item->item_price }} • {{ $selectedItem->item->item_desc }}
                                            </small>
                                        </div>
                                    </div>
                                    <div>
                                        <i wire:click.prevent="removeItem({{ $selectedItem->id }})" title="Remove" class="fa-regular fa-trash-can pointer mr_3" style="color: red;"></i>                                            {{-- <a wire:click.prevent="removeItem({{ $selectedItem->id }})" class="noformat pointer" title="remove" style="color: red; font-size:0.8rem">REMOVE</a> --}}
                                    </div>
                                </li>
                            @empty
                                <p class="text_center py_7"><i class="fa-solid fa-circle-exclamation mr_3"></i> Empty.
                                    <span wire:click.prevent="deletePurchase({{ $latest_purchase['id'] }})" class="mr_5 red pointer"> 
                                        Click remove empty purchase.
                                    </span>
                                </p> 
                                
                            @endforelse
                        </ul>

                        @if (count($selectedItems) > 0)
                            <div class="pt_10 dashed-top-2">
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
                                <button wire:click.prevent="deletePurchase({{ $latest_purchase['id'] }})"  class="ui tertiary button tiny red">
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

                            <div class="dashed-top-2" style="margin-top:1em; padding-top:0.5em">
                                Item not available for patient? <a href="/order"><b>Order</b></a>
                            </div>
                        @endif
                    @endif

                    @break

                @case(3)
                        @include('livewire.components.organisms.modal.modal-patient.patient-details')
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
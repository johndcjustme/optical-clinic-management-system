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
                
                <div class="flex gap_1 flex_y_center">
                    <div>
                        <x-atom.profile-photo size="4em" path="storage/photos/avatars/{{ $pt['avatar'] }}" />
                    </div>
                    <div>
                        <label class="button btn_small cancel" for="patient_avatar">Choose File`</label>
                        <input type="file" name="" id="patient_avatar" hidden>
                    </div>
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
                <p class="dark_100 mt_7">Select Option</p>
                <div class="grid grid_col_2 gap_1 mt_10">
                    <div>
                        <select wire:model="selectOption" class="input_small">
                            <option value="">--None--</option>
                            <option value="1">Examine Now</option>
                            <option value="2">Purchase Only</option>
                        </select>
                    </div>
                    <div class="flex flex_y_center">
                        <div class="flex flex_y_center">
                            @if ($selectOption == 1)
                                <input wire:model="addToQueue" type="checkbox" id="check_add_to_q">
                                <label class="ml_2" for="check_add_to_q">Add to Queue</label>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        @endif

        @if ($modal['isExamPurchase'])
            <div>
                <strong>{{ $pt['fullname'] }}</strong><br>
                <small>{{ $pt['age'] }} • {{ $pt['addr'] }}</small>
            </div>
            <div class="mt_15 mb_20 flex flex_x_between flex_y_center gap_1">
                <div class="flex gap_1">
                    {{-- <x-atom.tab-links.link tab-title="Exam" wire-click="exam_purchase_tab('exam', {{ $pt['id'] }})" sub-page="{{ $modal['exam_purchase_tab'] === 1}}" />
                    <x-atom.tab-links.link tab-title="Purchase" wire-click="exam_purchase_tab('purchase', {{ $pt['id'] }})" sub-page="{{ $modal['exam_purchase_tab'] === 2}}" /> --}}
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
                                    <span wire:click.prevent="deleteExam({{ $exam['id'] }})" class="mr_5 red pointer"> 
                                        <small>
                                            Delete this Exam
                                        </small>
                                    </span>
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
                                {{-- @switch ($purchase_select_item)
                                    @case (1) --}}
                                        <div class="">
                                            <div class="relative">    
                                                <div class="relative">
                                                    <div class="ui icon input fluid">
                                                        <input wire:model="searchItem" class="ui input primary" type="text" placeholder="Enter Item">
                                                        <i class="search icon"></i>
                                                    </div>
                                                    {{-- <button wire:click.prevent="$set('searchItem', '')" class="btn_small cancel absolute" style="top: 0.7em; right: 0.5em; color:blue;">Clear</button> --}}
                                                </div>
                                                @if (! empty($searchItem))
                                                    <div class="absolute left right radius_1 overflow_y" style="max-height: 300px; width:100%; background:rgb(232, 232, 255); box-shadow: 0px 10px 25px -4PX rgb(76 90 121 / 40%); z-index:20;">
                                                        <ul class="hoverable">
                                                            @if (isset($items))
                                                                @forelse ($items as $item)
                                                                        <li class="flex flex_x_between flex_y_center my_7" style="line-height:1rem">
                                                                            <div>
                                                                                <p>
                                                                                    {{ $item->item_name }}
                                                                                </p>
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
                                            {{-- <div>    
                                                <label for="">Tint</label>
                                                <input type="text">
                                            </div> --}}
                                        </div>
                                        {{-- @break
                                    @case (2) 
                                        <div>
                                            <label for="">Choose Frame</label>
                                            <input type="text">
                                        </div>
                                        @break
                                    @case (3)
                                        <div>
                                            <label for="">Choose Accessory</label>
                                            <input type="text">
                                        </div>
                                        @break
                                @endswitch --}}
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
                                            <button wire:click.prevent="inc_dec_item('inc', {{ $selectedItem->id }})" class="btn_small cancel" style="padding:0 2px" {{ $selectedItem->qty == 20 ? 'disabled' : ''  }}>
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <div class="mb_4">
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

                                {{-- @php
                                    $latest_purchase['total'] += $selectedItem->qty * $selectedItem->item->item_price;
                                @endphp --}}
                            @empty
                                <p class="text_center py_7"><i class="fa-solid fa-circle-exclamation mr_3"></i> Empty.
                                    <span wire:click.prevent="deletePurchase({{ $latest_purchase['id'] }})" class="mr_5 red pointer"> 
                                        {{-- <small> --}}
                                            Click remove empty payment.
                                        {{-- </small> --}}
                                    </span>
                                </p> 
                                
                            @endforelse
                        </ul>

{{-- 
                        @php 
                            $latest_purchase_balance = 0;
                            if (!empty($latest_purchase['discount']) && ($latest_purchase['discount'] > 0)) {
                                $latest_purchase['total'] = $latest_purchase['total'] - $latest_purchase['discount'];
                            } 
                            if ($latest_purchase['deposit'] > 0) {
                                $latest_purchase['balance'] = $latest_purchase['total'] - $latest_purchase['deposit'];
                            } else {
                                $latest_purchase['balance'] = 0;
                            }
                        @endphp --}}

                        @if (count($selectedItems) > 0)
                            <form wire:submit.prevent="savePayment({{ $latestPurchase }})" id="submit_payment">
                                <div class="grid grid_col_2 gap_1">
                                    <div>
                                        <label for="">Deposit</label>
                                        <div class="ui labeled input small fluid">
                                            <label for="deposit" class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                                            <input wire:model.lazy="deposit" type="number" step="0.01" min="0" placeholder="Deposit" id="deposit">
                                        </div>

                                        <label for="">Discount</label>
                                        <div class="ui labeled input small fluid">
                                            <label for="discount" class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                                            <input wire:model.lazy="discount" type="number" step="0.01" min="0" placeholder="Discount" id="discount">
                                        </div>

                                    </div>

                                    <div>
                                        <label for="">Balance</label>
                                        <div class="ui labeled input small fluid">
                                            <label class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                                            <input wire:model="balance" type="text" readonly hidden style="opacity: 0">
                                            <div class="ui input x-flex x-flex-ycenter b_1 full_w px_7" style="border-top-right-radius: 0.3em; border-bottom-right-radius: 0.3em">
                                                <div>
                                                    {{ number_format($balance, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <label for="">Total Amount</label>
                                        <div class="ui labeled input small fluid">
                                            <label class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                                            <input wire:model="total" type="text" readonly hidden style="opacity: 0">
                                            <div class="ui input x-flex x-flex-ycenter b_1 full_w px_7" style="border-top-right-radius: 0.3em; border-bottom-right-radius: 0.3em">
                                                <div>
                                                    {{ number_format($total, 2) }}
                                                </div>
                                            </div>
                                            {{-- <input type="number" step="0.01" value="{{ number_format($latest_purchase['total'], 2) }}" readonly> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="text_right mt_15">
                                {{-- <span class="button cancel mr_7">Delete</span> --}}
                                <span wire:click.prevent="deletePurchase({{ $latest_purchase['id'] }})" class="mr_5 red pointer"> 
                                    <small>
                                        Delete this payment
                                    </small>
                                </span>
                                <button type="submit`" form="submit_payment" class="ui button secondary tiny">
                                    @if (session()->has('savedPayment'))
                                        {{ session('savedPayment') }}<i class="fa-solid fa-circle-check ml_3"></i>
                                    @else
                                        Save Payment
                                    @endif
                                </button>
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
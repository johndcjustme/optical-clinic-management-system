@php    
    $totalAmount = 0;

    $formId = '';
    if ($modal['isAddPatient']) {
        $wireSubmitTo = 'addPt';
        $label = 'Add Patient';
        $formId = 'addPatient';
    }
    if ($modal['isUpdatePatient']) {
        $wireSubmitTo = 'updatePt';
        $label = 'Update Patient';
        $formId = 'updatePatient';
    }
    if ($modal['isExamPurchase']) {
        $wireSubmitTo = 'updatePt';
        $label = 'Update Patient';
        $formId = 'updatePatient';
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
        {{-- <div class="full_w flex flex_x_between">
            <div></div>
            <div>
                <x-atom.btn-close-modal wire-click="closeModal"/>  
                <x-atom.btn-save-modal form="{{ $formId }}" val="{{ $label }}"/>  
            </div>
        </div> --}}
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

                            <x-atoms.ui.label>Last name</x-atoms.ui.label>
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
                <p>
                    <strong>{{ $pt['fullname'] }}</strong><br>
                    <small>{{ $pt['addr'] }}</small>
                </p>
            </div>
            <div class="my_15 flex flex_x_between flex_y_center gap_1">
                <div class="flex gap_1">
                    <x-atom.tab-links.link tab-title="Exam" wire-click="exam_purchase_tab('exam', {{ $pt['id'] }})" sub-page="{{ $modal['exam_purchase_tab'] === 1}}" />
                    <x-atom.tab-links.link tab-title="Purchase" wire-click="exam_purchase_tab('purchase', {{ $pt['id'] }})" sub-page="{{ $modal['exam_purchase_tab'] === 2}}" />
                </div>
                <div>
                    {{-- <button class="btn_small">New Exam</button> --}}
                    <button wire:click.prevent="{{ $examPurchase_newBtnWireclick }}" class="btn_small">{{ $examPurchase_newBtnLabel }}</button>
                </div>
            </div>
            @switch($modal['exam_purchase_tab'])
                @case(1)
                    @if ($exam['last'])
                        <form wire:submit.prevent="updateExam({{ $exam['id'] }})" id="saveExam">
                            <div style="overflow-y: auto">
                                <table class="full_w noformat" style="min-width: 400px;">
                                    <thead>
                                        <tr>
                                            <td>RX</td>
                                            <td>SPH</td>
                                            <td>CYL</td>
                                            <td>AXIS</td>
                                            <td>NVA</td>
                                            <td>PH</td>
                                            <td>CVA</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>OD</td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OD_SPH" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OD_CYL" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OD_AXIS" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OD_NVA" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OD_PH" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OD_CVA" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>OS</td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OS_SPH" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OS_CYL" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OS_AXIS" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OS_NVA" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OS_PH" type="text">
                                            </td>
                                            <td>
                                                <input wire:model.defer="exam.exam_OS_CVA" type="text">
                                            </td>
                                        </tr>
                                        <tr class="mt_7">
                                            <td></td>
                                            <td colspan="3">
                                                <label>ADD</label>
                                                <input wire:model.defer="exam.exam_ADD" type="text">
                                            </td>
                                            <td colspan="3">
                                                <label for="">P.D.</label>
                                                <input wire:model.defer="exam.exam_PD" type="text">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
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
                                    <button type="submit`" form="saveExam" class="btn_small">
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
                                                <label for="">Choose Item</label>
                                                <div class="relative">
                                                    <input wire:model="searchItem" class="type="text" placeholder="Enter Item">
                                                    <button wire:click.prevent="$set('searchItem', '')" class="btn_small cancel absolute" style="top: 0.7em; right: 0.5em; color:blue;">Clear</button>
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
                        <ul class="hoverable my_10" style="line-height: 1rem">
                            @forelse ($selectedItems as $selectedItem)     
                                <li class="flex flex_x_between flex_y_center b_1 my_4">
                                    <div class="flex gap_1 my_3">
                                        <div class="flex flex_y_center" style="gap:0.4em">
                                            <button wire:click.prevent="inc_dec_item('dec', {{ $selectedItem->id }})" class="btn_small cancel" style="padding:0 2px" {{ $selectedItem->qty == 1 ? 'disabled' : ''  }}>
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <p class="text_center" style="width: 1.5em">{{ $selectedItem->qty  }}</p>
                                            <button wire:click.prevent="inc_dec_item('inc', {{ $selectedItem->id }})" class="btn_small cancel" style="padding:0 2px" {{ $selectedItem->qty == 20 ? 'disabled' : ''  }}>
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                        <div>
                                            <p>
                                                {{ $selectedItem->item->item_name }}
                                            </p>
                                            <p class="dark_200">
                                                <small>
                                                    <i class="fa-solid fa-peso-sign"></i> {{ $selectedItem->item->item_price }} • {{ $selectedItem->item->item_desc }}
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="pointer">
                                            <button wire:click.prevent="removeItem({{ $selectedItem->id }})" class="noformat" style="color: red;">REMOVE</button>
                                        </p>
                                    </div>
                                </li>

                                @php
                                    $latest_purchase['total'] += $selectedItem->qty * $selectedItem->item->item_price;
                                @endphp
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
                        @endphp


                        @if (count($selectedItems) > 0)
                            <form wire:submit.prevent="savePayment({{ $latestPurchase }})" id="submit_payment">
                                <div class="grid grid_col_2 gap_1">
                                    <div>
                                        <label for="">Deposit</label>
                                        <input wire:model.lazy="latest_purchase.deposit" type="number" step="0.01" name="" id="" min="0">
                                        <label for="">Discount</label>
                                        <input wire:model.lazy="latest_purchase.discount" type="number" step="0.01" name="" id="" min="0">
                                    </div>
                                    <div>
                                        <label for="">Balance</label>
                                        <div class="input">
                                            {{ number_format($latest_purchase['balance'], 2) }}
                                        </div>
                                        <label for="">Total Amount</label>
                                        <div class="input">
                                            {{ number_format($latest_purchase['total'], 2) }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="text_right mt_8">
                                {{-- <span class="button cancel mr_7">Delete</span> --}}
                                <span wire:click.prevent="deletePurchase({{ $latest_purchase['id'] }})" class="mr_5 red pointer"> 
                                    <small>
                                        Delete this payment
                                    </small>
                                </span>
                                <button type="submit`" form="submit_payment" class="btn_small">
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
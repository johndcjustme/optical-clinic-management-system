@php
    $formId;
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

    $calc = 0;
@endphp


<x-organisms.modal>

    @section('modal_title')
        <div class="full_w flex flex_x_between">
            <div></div>
            <div>
                <x-atom.btn-close-modal wire-click="closeModal"/>  
                <x-atom.btn-save-modal form="{{ $formId }}" val="{{ $label }}"/>  
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
                <div class="grid grid_col_2 gap_1 mb_15">
                    <div>
                        <label for="">First Name 
                            @error('pt.fname')
                                <x-atom.error>{{ $message }}</x-atom.error>
                            @enderror  
                        </label>
                        <input wire:model.defer="pt.fname" type="text">
                        <label for="">Last Name
                            @error('pt.lname')
                                <x-atom.error>{{ $message }}</x-atom.error>
                            @enderror  
                        </label>
                        <input wire:model.defer="pt.lname" type="text">
                        <label for="">M.I.</label>
                        <input wire:model.defer="pt.mname" type="text">
                    </div>
                    <div>
                        <label for="">Gender</label>
                        <select wire:model.defer="pt.gender" name="" id="">
                            <option value="" selected>--None--</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        <label for="">Occupation</label>
                        <input wire:model.defer="pt.occ" type="text" name="" id="">
                        <label for="">Address</label>
                        <input wire:model.defer="pt.addr" type="text" name="" id="">
                    </div>
                </div>

                <div class="grid grid_col_2 gap_1">
                    <div>
                        <label for="">Contact Number
                            @error('pt.no')
                                <x-atom.error>{{ $message }}</x-atom.error>
                            @enderror  
                        </label>
                        <input wire:model.defer="pt.no" type="text">
                    </div>
                    <div>
                        <label for="">Email Address
                            @error('pt.email')
                                <x-atom.error>{{ $message }}</x-atom.error>
                            @enderror  
                        </label>
                        <input wire:model.defer="pt.email" type="email">
                    </div>
                </div>
                <br>
                <p class="dark_100 mt_7">Select Option</p>
                <div class="grid grid_col_2 gap_1 mt_10">
                    <div>
                        <div class="flex flex_y_center">
                            <input wire:model="selectOption" name="option" value="0" type="radio" id="check_none">
                            <label class="ml_2" for="check_none">Defaut</label>
                        </div>
                        <br>
                        <div class="flex flex_y_center">
                            <input wire:model="selectOption" name="option" value="1" type="radio" id="check_examine">
                            <label class="ml_2" for="check_examine">Examine today</label>
                        </div>
                        <br>
                        <div class="flex flex_y_center">
                            <input wire:model="selectOption" name="option" value="2" type="radio" id="check_purchase_only">
                            <label class="ml_2" for="check_purchase_only">Puchase Only</label>
                        </div>
                    </div>
                    <div>
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
                    <strong>{{ $pt['fname'] }}</strong><br>
                    <small>{{ $pt['addr'] }}</small>
                </p>
            </div>
            <div class="my_15 flex gap_1">
                <x-atom.tab-links.link tab-title="Exam" wire-click="exam_purchase_tab('exam', {{ $pt['id'] }})" sub-page="{{ $modal['exam_purchase_tab'] === 1}}" />
                <x-atom.tab-links.link tab-title="Purchase" wire-click="exam_purchase_tab('purchase', {{ $pt['id'] }})" sub-page="{{ $modal['exam_purchase_tab'] === 2}}" />
            </div>
            @switch($modal['exam_purchase_tab'])
                @case(1)
                    <div>
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
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>OS</td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                        <td>
                                            <input type="text">
                                        </td>
                                    </tr>
                                    <tr class="mt_7">
                                        <td></td>
                                        <td colspan="3">
                                            <label>ADD</label>
                                            <input type="text">
                                        </td>
                                        <td colspan="3">
                                            <label for="">P.D.</label>
                                            <input type="text">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt_6">
                        <div class="flex flex_x_between flex_y_center">
                            <div>
                                <p>
                                    <small>
                                        Previous Exams: {{ $exam['previous'] }}
                                    </small>
                                </p>
                            </div>
                            <div>
                                <button class="btn_small">New Exam</button>
                            </div>
                        </div>
                    </div>
                    @break

                @case (2)
                    <div>
                        <div class="flex flex_x_between flex_y_center bb_1 pb_3 mb_7">
                            <div>
                                {{-- <p>Select Items</p> --}}
                                <button wire:click.prevent="purchaseNewItem({{ $pt['id'] }})" class="btn_small">+ New</button>
                            </div>
                            <div>
                                <select wire:model="purchase_select_item" class="input_small" name="" id="" >
                                    <option value="1">Lense</option>
                                    <option value="2">Frame</option>
                                    <option value="3">Accessory</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            @switch ($purchase_select_item)
                                @case (1)
                                    <div class="grid grid_col_2 gap_1" style="grid-template-columns: auto 40%;">
                                        <div class="relative">    
                                            <label for="">Choose Lense</label>
                                            <input wire:model="searchItem" type="text" placeholder="Enter Lense">
                                            @if (! empty($searchItem))
                                                <div class="absolute left right radius_1 overflow_y" style="max-height: 300px; width:100%; background:rgb(232, 232, 255); box-shadow: 0px 10px 25px -4PX rgb(76 90 121 / 40%);">
                                                    <ul class="hoverable">
                                                        @if (isset($items))
                                                            @forelse ($items as $item)
                                                                    <li class="flex flex_x_between my_3" style="line-height:1rem">
                                                                        <div>
                                                                            <p>
                                                                                {{ $item->item_name }}
                                                                            </p>
                                                                            <small class="dark_200">
                                                                                <i class="fa-solid fa-peso-sign"></i> {{ $item->item_price }} • {{ $item->item_desc }}
                                                                            </small>
                                                                        </div>
                                                                        <div wire:click.prevent="addItem('{{ $itemType }}', '{{ $item->item_price }}', {{ $item->id }})" class="pointer">
                                                                            <p>Add</p>
                                                                        </div>
                                                                    </li>
                                                            @empty
                                                                <li>No results.</li>
                                                            @endforelse
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                           
                                        </div>
                                        <div>    
                                            <label for="">Tint</label>
                                            <input type="text">
                                        </div>
                                    </div>
                                    @break
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
                            @endswitch
                        </div>
                    </div>
                    <ul class="hoverable my_10" style="line-height: 1rem">
                        <p class="dark_200 text_center"><i class="fa-solid fa-ellipsis"></i></p>
                            @foreach ($selectedItems as $selectedItem)     

                                {{-- {{ $selectedItem->item_id }} --}}
                                <li class="flex flex_x_between flex_y_center b_1 my_4">
                                    <div class="flex gap_1 my_3">
                                        <div class="flex flex_y_center" style="gap:0.4em">
                                            <button class="noformat p_5">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <p>{{ $selectedItem->qty }}</p>
                                            <button class="noformat p_5">
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
                                            <small>REMOVE</small>
                                        </p>
                                    </div>
                                </li>

                                @php
                                    $calc += $selectedItem->total * $selectedItem->qty;
                                @endphp
                            @endforeach
                        <p class="dark_200 text_center"><i class="fa-solid fa-ellipsis"></i></p>
                    </ul>
                    <div class="grid grid_col_2 gap_1">
                        <div>
                            <label for="">Deposit</label>
                            <input type="number" name="" id="" min="0">
                            <label for="">Discount</label>
                            <input type="number" name="" id="" min="0">
                        </div>
                        <div>
                            <label for="">Balance</label>
                            <input type="number" name="" id="" disabled>
                            <label for="">Total</label>
                            <input type="number" name="" id="" value="{{ $calc }}" disabled>
                        </div>
                    </div>
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
<x-layout.page-content>

    @section('section-page-title')
        <div class="x-flex x-flex-yend">
            <x-atoms.ui.header title="Patients" link="/patients"/>

            @if ($historyPage > 0)
                <a>/History</a>
            @endif



        </div>
    @endsection

    @section('section-links')
        {{-- <x-atom.tab-links.link tab-title="Today" wire-click="$set('tab', 1)" sub-page="{{ $tab === 1}}" />
        <x-atom.tab-links.link tab-title="Queue (4)" wire-click="$set('tab', 2)" sub-page="{{ $tab === 2}}" />
        <x-atom.tab-links.link tab-title="Patient list" wire-click="$set('tab', 3)" sub-page="{{ $tab === 3}}" /> --}}
        @if ($subPage != 3)
            <x-molecules.ui.group-buttons>
                <x-molecules.ui.group-buttons.button 
                    wire-click="$set('subPage', 1)" 
                    active="{{ $subPage == 1 }}"
                    label="Patients" />

                    <div class="ui buttons" style="z-index: 100" x-init="">
                        <div class="ui combo top right pointing dropdown icon button">
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <div wire:click.prevent="$set('showInPatient', 1)" data-value="1" class="item">
                                    All</div>
                                <div wire:click.prevent="$set('showInPatient', 2)" data-value="2" class="item">
                                    In list</div>
                            </div>
                        </div>
                    </div>
                <x-molecules.ui.group-buttons.button wire-click="$set('subPage', 2)" active="{{ $subPage == 2 }}"
                    label="Payment History" />
            </x-molecules.ui.group-buttons.button>
        @endif

    @endsection

    @section('section-heading-left')
        @if ($subPage != 3)
            <div>
                <x-atoms.ui.button wire:click.prevent="patientShowModal('isAdd', null)" class="primary basic tiny">
                    <i class="icon plus"></i> New
                </x-atoms.ui.button>
            </div>
        @endif
    @endsection

    @section('section-heading-right')
        @if ($subPage != 3)
            <div> <x-atoms.ui.search wire-model="searchPatient" placeholder="Search..."/> </div>
        @endif
    @endsection

    @section('section-main')
    
        @switch($subPage)
            @case(1)
                <x-organisms.ui.table class="selectable">
                    <x-slot name="thead">
                        <x-organisms.ui.table.th-checkbox/>
                        <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                        <x-organisms.ui.table.th label="Status"/>
                        <x-organisms.ui.table.th label="Action"/>
                        <x-organisms.ui.table.th-more/>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($pts as $pt)   
                            <tr>
                                <x-organisms.ui.table.td 
                                    checkbox="selectedPatients" 
                                    checkbox-value="{{ $pt->id }}"/>
                                <x-organisms.ui.table.td 
                                    text="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}}"
                                    desc="{{ isset($pt->patient_address) ? $pt->patient_address : ''; }}"
                                    desc-icon="{{ isset($pt->patient_address) ? 'fa-location-dot' : ''; }}"
                                    avatar="{{ $this->storage($pt->patient_avatar) }}"/>
                                <x-organisms.ui.table.td 
                                    text="Scheduled"/>
                                <x-organisms.ui.table.td>
                                    <div class="flex flex_y_center full_w" style="gap:0.8em">
                                        <div>
                                            <div wire:click.prevent="patientShowModal('isExam', {{ $pt->id }})" class="clickable_icon">
                                                <i class="fa-solid fa-pen  green"></i>
                                            </div>
                                        </div>
                                        <div wire:click.prevent="patientShowModal('isPurchase', {{ $pt->id }})">
                                            <div class="clickable_icon">
                                                <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 81, 0)"></i>
                                            </div>
                                        </div>
                                    </div>  
                                </x-organisms.ui.table.td>
                                <x-organisms.ui.table.td-more>
                                    <x-atom.more.option
                                        wire-click="showModal('update', 'supplier', {{ $pt->id }})"
                                        option-name="Edit" />
                                    <x-atom.more.option 
                                        wire-click="deletingSupplier({{ $pt->id }})"
                                        option-name="Delete" />
                                    <x-atom.more.option 
                                        wire-click="history(1, {{ $pt->id }})"
                                        option-name="Exam History" />
                                    <x-atom.more.option 
                                        wire-click="history(2, {{ $pt->id }})"
                                        option-name="Purchase History" />
                                </x-organisms.ui.table.td>
                            </tr>
                        @empty
                            <x-organisms.ui.table.search-no-results colspan="7"/>
                        @endforelse
                    </x-slot>
                </x-organisms.ui.table>
                <x-organisms.ui.paginator display-page-number="{{ $pageNumber }}" wire-model="pageNumber">
                    {{ $pts->links('livewire.components.paginator') }}
                </x-organisms.ui.paginator.item>    
                @break
            @case(2)
                <x-organisms.ui.table class="selectable">
                    <x-slot name="thead">
                        <x-organisms.ui.table.th-checkbox/>
                        <x-organisms.ui.table.th label="Date" style="width:10em;"/>
                        <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                        <x-organisms.ui.table.th label="Payment Type"/>
                        <x-organisms.ui.table.th label="Balance"/>
                        <x-organisms.ui.table.th label="Total"/>
                        <x-organisms.ui.table.th-more/>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach (App\Models\Purchase::with('purchased_item')->with('patient')->get() as $purchase)
                            
                        {{-- @for ($i = 1; $i < 10; $i++)    --}}
                            <tr>
                                <x-organisms.ui.table.td 
                                    checkbox="selectedPatients" 
                                    checkbox-value=""/>
                                <x-organisms.ui.table.td 
                                    text=""
                                    desc="{{ $this->date($purchase->created_at) }}"/>
                                <x-organisms.ui.table.td 
                                    text="{{ $purchase->patient->patient_lname . ', ' . $purchase->patient->patient_fname . ' ' . $purchase->patient->patient_mname }}"
                                    avatar="{{ $this->storage($purchase->patient->patient_avatar) }}"
                                    desc=""/>
                                <x-organisms.ui.table.td
                                    text="On Hand"
                                    desc=""/>
                                <x-organisms.ui.table.td
                                    text="{{ empty($purchase->balance) || ($purchase->balance == 0) ? 'Paid' : $purchase->balance; }}"
                                    text-icon="{{ empty($purchase->balance) || ($purchase->balance == 0) ? '' : 'fa-peso-sign';}}"
                                    desc=""/>
                                <x-organisms.ui.table.td
                                    text="{{ $purchase->total }}"
                                    text-icon="fa-peso-sign"
                                    desc=""/>
                                <x-organisms.ui.table.td-more>
                                    <x-atom.more.option
                                        wire-click="patientShowModal('isPurchase', {{ $purchase->patient->id }})"
                                        option-name="Edit" />
                                    <x-atom.more.option 
                                        wire-click="deletingSupplier('id')"
                                        option-name="Delete" />
                                </x-organisms.ui.table.td>
                            </tr>
                        {{-- @endfor --}}
                        @endforeach

                    </x-slot>
                </x-organisms.ui.table>
                @break
            @case(3)
                <div style="max-width: 600px; width: 600px; margin-right:auto; margin-left:auto">
                        <div class="x-flex x-flex-ycenter" style="width:100%;">
                            <h2>
                                Patient History
                            </h2>
                        </div>
                    <br><br>

                    <div class="">
                        <div style="overflow-y: auto; padding-bottom:1em">
                            <div class="x-flex x-flex-ycenter x-gap-1">
                                <div>
                                    <x-atom.profile-photo size="3em" path="{{ $this->storage($pt['avatar']) }}" />
                                </div>
                                <div>
                                    <div style="font-weight:bold">{{ $this->fullName($patientId) }}</div>
                                    <div>{{ $this->AGE_ADDR($patientId) }}</div>
                                </div>
                            </div><br>

                            <div class="full_w x-flex x-flex-xend x-flex-ycenter">
                                    <div class="mr_10">
                                        @switch($historyPage)
                                            @case(1) Exams: {{ $this->countExam($patientId) }} @break
                                            @case(2) Purchase: {{ $this->countPurchase($patientId) }} @break
                                            @default
                                        @endswitch
                                    </div>
                                    <x-molecules.ui.group-buttons>
                                        <x-molecules.ui.group-buttons.button 
                                            wire-click="$set('historyPage', 1)" 
                                            active="{{ $historyPage == 1 }}"
                                            label="Exam" />
                                        <x-molecules.ui.group-buttons.button 
                                            wire-click="$set('historyPage', 2)" 
                                            active="{{ $historyPage == 2 }}"
                                            label="Purchase" />
                                    </x-molecules.ui.group-buttons.button>
                            </div><br>

                            @switch($historyPage)
                                @case(1)
                                        @foreach (App\Models\Exam::where('patient_id', $patientId)->latest()->get() as $exam)
                                            <div class="x-flex x-flex-xbetween x-flex-ycenter mb_3">
                                                <div>
                                                    <p style="opacity: 0.7;">{{ $this->date($exam->created_at) }}</p>
                                                </div>
                                                <div class="x-flex x-gap-1">
                                                    <i title="Edit" class="pointer fa-regular fa-pen-to-square"></i>
                                                    <i title="Delete" class="pointer fa-regular fa-trash-can"></i>
                                                </div>
                                            </div>
                                            <div style="overflow-x:auto">
                                                <x-organisms.ui.table class="celled unstackable blue">
                                                    <x-slot name="thead">
                                                        <x-organisms.ui.table.th label="RX"/>
                                                        <x-organisms.ui.table.th label="SPH"/>
                                                        <x-organisms.ui.table.th label="CYL"/>
                                                        <x-organisms.ui.table.th label="AXIS"/>
                                                        <x-organisms.ui.table.th label="NVA"/>
                                                        <x-organisms.ui.table.th label="PH"/>
                                                        <x-organisms.ui.table.th label="CVA"/>
                                                    </x-slot>
                                                    <x-slot name="tbody">
                                                        <tr>
                                                            <x-organisms.ui.table.td 
                                                                text="OD"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OD_SPH }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OD_CYL }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OD_AXIS }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OD_NVA }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OD_PH }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OD_CVA }}"/>
                                                        </tr>
                                                        <tr>
                                                            <x-organisms.ui.table.td 
                                                                text="OS"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OS_SPH }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OS_CYL }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OS_AXIS }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OS_NVA }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OS_PH }}"/>
                                                            <x-organisms.ui.table.td 
                                                                text="{{ $exam->exam_OS_CVA }}"/>
                                                        </tr>
                                                        <tr>
                                                            <x-organisms.ui.table.td colspan="4">
                                                                <span style="opacity:0.5; margin-right:0.4em">ADD:</span>{{ $exam->exam_ADD }}
                                                            </x-organisms.ui.table.td>
                                                            <x-organisms.ui.table.td colspan="4">
                                                                <span style="opacity:0.5; margin-right:0.4em">P.D:</span>{{ $exam->exam_PD }}
                                                            </x-organisms.ui.table.td>
                                                        </tr>
                                                        <tr>
                                                            <x-organisms.ui.table.td colspan="4">
                                                                <span style="opacity:0.5; margin-right:0.4em">REMARKS:</span>{{ $exam->exam_remarks }}
                                                            </x-organisms.ui.table.td>
                                                        </tr>
                                                    </x-slot>
                                                </x-organisms.ui.table>
                                            </div>
                                            <br>
                                        @endforeach
                                    @break
                                @case(2)
                                    @foreach (App\Models\Purchase::where('patient_id', $patientId)->latest()->get() as $purchase)
                                        <div class="x-flex x-flex-xbetween x-flex-ycenter mb_3">
                                            <div>
                                                <p style="opacity: 0.7;">{{ $this->date($purchase->created_at) }}</p>
                                            </div>
                                            <div class="x-flex x-gap-1">
                                                <i title="Edit" class="pointer fa-regular fa-pen-to-square"></i>
                                                <i title="Delete" class="pointer fa-regular fa-trash-can"></i>
                                            </div>
                                        </div>
                                        <div style="overflow-x:auto">
                                            <x-organisms.ui.table class="celled unstackable blue">
                                                <x-slot name="thead">
                                                    <x-organisms.ui.table.th label="Item"/>
                                                    <x-organisms.ui.table.th label="Quantity"/>
                                                    <x-organisms.ui.table.th label="Price"/>
                                                    <x-organisms.ui.table.th label="Sub Total"/>
                                                </x-slot>
                                                <x-slot name="tbody">
                                                    @foreach (App\Models\Purchased_item::with('item')->where('purchase_id', $purchase->id)->get() as $purchase_item)
                                                        <tr>
                                                            <x-organisms.ui.table.td text="{{ $purchase_item->item->item_name }}"/>
                                                            <x-organisms.ui.table.td text="{{ $purchase_item->qty}}"/>
                                                            <x-organisms.ui.table.td text="{{ $purchase_item->item_price }}"/>
                                                            <x-organisms.ui.table.td text="{{ $purchase_item->qty * $purchase_item->item_price }}"/>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="3" style="font-weight:bold; text-align:right;">DISCOUNT</td>
                                                        <x-organisms.ui.table.td text="{{ $purchase->discount }}"/>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="font-weight:bold; text-align:right;">TOTAL</td>
                                                        <x-organisms.ui.table.td text="{{ $purchase->total }}"/>
                                                    </tr>
                                                </x-slot>
                                            </x-organisms.ui.table>
{{-- 
                                            <table class="ui celled table unstackable">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (App\Models\Purchased_item::with('item')->where('purchase_id', $purchase->id)->get() as $purchase_item)
                                                        <tr>
                                                            <td>{{ $purchase_item->item->item_name }}</td>
                                                            <td>{{ $purchase_item->qty}}</td>
                                                            <td>{{ $purchase_item->item_price }}</td>
                                                            <td>{{ $purchase_item->qty * $purchase_item->item_price }}</td>
                                                        </tr>
                                                    @endforeach
                                                        <tr>
                                                            <td colspan="3" style="font-weight:bold; text-align:right;">DISCOUNT </td>
                                                            <td>{{ $purchase->discount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" style="font-weight:bold; text-align:right;">TOTAL </td>
                                                            <td>{{ $purchase->total }}</td>
                                                        </tr>
                                                </tbody>
                                            </table> --}}
                                        </div>
                                        <br>
                                    @endforeach

                                    @break
                                @default
                                    
                            @endswitch
                        </div>
                    </div>
                </div>
                @break
            @default
                
        @endswitch
        




{{-- 
        <div class="items">
            @switch($tab)
                @case(1)
                    <x-layout.lists-section>
                        @switch($showInPatient)
                            @case(1)
                                <x-layout.details>
                                    <x-slot name="details_summary">
                                        Queue List
                                    </x-slot>
                                    <x-slot name="details_content">
                                        @foreach ($pts->where('patient_status', 1) as $pt)   
                                            <x-layout.lists-section.lists-container>
                                                <x-layout.lists-section.lists-list list-for="grid_patient list">
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_center">
                                                            <input type="checkbox" class="pointer">
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                    <x-layout.lists-section.list-item 
                                                        item-name="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}} fontBold" 
                                                        item-desc="{{ $pt->patient_address }}" 
                                                        item-desc-icon="fa-location-dot" 
                                                        avatar="storage/photos/avatars/default-avatar-pt.png"
                                                    />
                                                    <x-layout.lists-section.list-item 
                                                        item-name="{{ $pt->patient_mobile }}" 
                                                        item-name-icon="fa-phone"
                                                    />
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex full_w">
                                                            <p class="py_2 px_6" style="border-radius: 3em; color: {{ $statusColor['1'] }}">
                                                                {{ $status['1'] }}
                                                            </p>
                                                        </div>
                                                    </x-layout.lists-section.list-item>        
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_y_center full_w" style="gap:0.8em">
                                                            <div>
                                                                <div wire:click.prevent="patientShowModal('isExam', {{ $pt->id }})" class="clickable_icon">
                                                                    <i class="fa-solid fa-pen  green"></i>
                                                                </div>
                                                            </div>
                                                            <div wire:click.prevent="patientShowModal('isPurchase', {{ $pt->id }})">
                                                                <div class="clickable_icon">
                                                                    <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 81, 0)"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_center">
                                                            <x-atom.more>
                                                                <x-atom.more.option wire-click="patientShowModal('isUpdate', {{ $pt->id }})" option-name="Edit" />
                                                                @if ($pt->patient_status === 1)
                                                                    <x-atom.more.option wire-click="addToQueue({{ $pt->id }})" option-name="Add to Queue" />
                                                                @endif
                                                            </x-atom.more>
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                </x-layout.lists-section.lists-list>
                                            </x-layout.lists-section.lists-container>
                                        @endforeach
                                    </x-slot>
                                </x-layout.details>


                                <x-layout.details>
                                    <x-slot name="details_summary">
                                        Recently Examined
                                    </x-slot>
                                    <x-slot name="details_content">
                                        @foreach ($pts->where('patient_status', 1) as $pt)   
                                            <x-layout.lists-section.lists-container>
                                                <x-layout.lists-section.lists-list list-for="grid_patient list">
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_center">
                                                            <input type="checkbox" class="pointer">
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                    <x-layout.lists-section.list-item 
                                                        item-name="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}} fontBold" 
                                                        item-desc="{{ $pt->patient_address }}" 
                                                        item-desc-icon="fa-location-dot" 
                                                        avatar="storage/photos/avatars/default-avatar-pt.png"
                                                    />
                                                    <x-layout.lists-section.list-item 
                                                        item-name="{{ $pt->patient_mobile }}" 
                                                        item-name-icon="fa-phone"
                                                    />
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex full_w">
                                                            <p class="py_2 px_6" style="border-radius: 3em; color: {{ $statusColor['1'] }}">
                                                                {{ $status['1'] }}
                                                            </p>
                                                        </div>
                                                    </x-layout.lists-section.list-item>        
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_y_center full_w" style="gap:0.8em">
                                                            <div>
                                                                <div wire:click.prevent="patientShowModal('isExam', {{ $pt->id }})" class="clickable_icon">
                                                                    <i class="fa-solid fa-pen  green"></i>
                                                                </div>
                                                            </div>
                                                            <div wire:click.prevent="patientShowModal('isPurchase', {{ $pt->id }})">
                                                                <div class="clickable_icon">
                                                                    <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 81, 0)"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_center">
                                                            <x-atom.more>
                                                                <x-atom.more.option wire-click="patientShowModal('isUpdate', {{ $pt->id }})" option-name="Edit" />
                                                                <x-atom.more.option wire-click="addToQueue({{ $pt->id }})" option-name="Add to Queue" />
                                                            </x-atom.more>
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                </x-layout.lists-section.lists-list>
                                            </x-layout.lists-section.lists-container>
                                        @endforeach
                                    </x-slot>
                                </x-layout.details>

                                <x-layout.details>
                                    <x-slot name="details_summary">
                                        To operate
                                    </x-slot>
                                    <x-slot name="details_content">
                                        @foreach ($pts->where('patient_status', 1) as $pt)   
                                            <x-layout.lists-section.lists-container>
                                                <x-layout.lists-section.lists-list list-for="grid_patient list">
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_center">
                                                            <input type="checkbox" class="pointer">
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                    <x-layout.lists-section.list-item 
                                                        item-name="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}} fontBold" 
                                                        item-desc="{{ $pt->patient_address }}" 
                                                        item-desc-icon="fa-location-dot" 
                                                        avatar="storage/photos/avatars/default-avatar-pt.png"
                                                    />
                                                    <x-layout.lists-section.list-item 
                                                        item-name="{{ $pt->patient_mobile }}" 
                                                        item-name-icon="fa-phone"
                                                    />
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex full_w">
                                                            <p class="py_2 px_6" style="border-radius: 3em; color: {{ $statusColor['1'] }}">
                                                                {{ $status['1'] }}
                                                            </p>
                                                        </div>
                                                    </x-layout.lists-section.list-item>        
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_y_center full_w" style="gap:0.8em">
                                                            <div>
                                                                <div wire:click.prevent="patientShowModal('isExam', {{ $pt->id }})" class="clickable_icon">
                                                                    <i class="fa-solid fa-pen  green"></i>
                                                                </div>
                                                            </div>
                                                            <div wire:click.prevent="patientShowModal('isPurchase', {{ $pt->id }})">
                                                                <div class="clickable_icon">
                                                                    <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 81, 0)"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                                        <div class="flex flex_center">
                                                            <x-atom.more>
                                                                <x-atom.more.option wire-click="patientShowModal('isUpdate', {{ $pt->id }})" option-name="Edit" />
                                                                <x-atom.more.option wire-click="addToQueue({{ $pt->id }})" option-name="Add to Queue" />
                                                            </x-atom.more>
                                                        </div>
                                                    </x-layout.lists-section.list-item>
                                                </x-layout.lists-section.lists-list>
                                            </x-layout.lists-section.lists-container>
                                        @endforeach
                                    </x-slot>
                                </x-layout.details>


                                @break

                            @case(2)
    
                                <x-layout.lists-section.lists-list list-for="grid_patient_list title">
                                    <x-atom.column-title/>
                                    <x-atom.column-title  
                                        wire-click="sortBy('item', 'item_name')"
                                        col-title="Name"
                                    />
                                    <x-atom.column-title  
                                        wire-click=""
                                        col-title="Contact"
                                    />
                                    <x-atom.column-title  
                                        wire-click=""
                                        col-title=""
                                    />
                                    <x-atom.column-title/>
                                </x-layout.lists-section.lists-list>
                                @forelse ($pts as $pt)
                                    <x-layout.lists-section.lists-container>
                                        <x-layout.lists-section.lists-list list-for="grid_patient_list list">
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex flex_center">
                                                    <input type="checkbox" class="pointer">
                                                </div>
                                            </x-layout.lists-section.list-item>
                                            <x-layout.lists-section.list-item 
                                                avatar="storage/photos/avatars/default-avatar-pt.png"
                                                item-name="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}} fontBold" 
                                                item-desc="{{ $pt->patient_address }}"
                                                item-desc-icon="fa-location-dot"
                                            />
                                            <x-layout.lists-section.list-item 
                                                item-name="{{ $pt->patient_mobile }}" 
                                                item-desc="{{ $pt->patient_email }}"
                                                item-desc-icon="fa-envelope"
                                            />
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex flex_y_center full_w" style="gap:0.8em">
                                                    <div>
                                                        <div wire:click.prevent="patientShowModal('isExam', {{ $pt->id }})" class="clickable_icon">
                                                            <i class="fa-solid fa-pen  green"></i>
                                                        </div>
                                                    </div>
                                                    <div wire:click.prevent="patientShowModal('isPurchase', {{ $pt->id }})">
                                                        <div class="clickable_icon">
                                                            <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 81, 0)"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-layout.lists-section.list-item>
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex flex_center">
                                                    <x-atom.more>
                                                        <x-atom.more.option wire-click="patientShowModal('isUpdate', {{ $pt->id }})" option-name="Edit" />
                                                    </x-atom.more>
                                                </div>
                                            </x-layout.lists-section.list-item>
                                        </x-layout.lists-section.lists-list>
                                    </x-layout.lists-section.lists-container>
                                @empty
                                    
                                @endforelse
                           
                                @break
                        
                            @default
                                
                        @endswitch
                        
                        
                    </x-layout.lists-section>
                    @break

                @case(2)
                    queue
                    @break
            
                @case(3)
                    case 3
                    @break
                @default
                    
            @endswitch
        </div> --}}

    @endsection

</x-layout.page-content>

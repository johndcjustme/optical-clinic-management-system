<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Patients"
            desc="All Patients • {{ $this->patientTotal() }}"/>
    @endsection

    @section('section-links')
        @if ($subPage != 3)
            <div class="ui compact tiny menu">
                <div wire:click.prevent="subPage(1)" class="link item @if($subPage == 1) active @endif">Exam List</div>
                <div wire:click.prevent="subPage(4)" class="link item @if($subPage == 4) active @endif">Patient List</div>
                <div wire:click.prevent="subPage(2)" class="link item @if($subPage == 2) active @endif">Purchase</div>
            </div>
        @endif

    @endsection

    @section('section-heading-left')
        @if ($subPage != 3)
            @if (count($selectedPatients) > 0)
                <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedPatients', [])" class="left pointing tiny">
                    <x-slot name="label">
                        {{ count($selectedPatients) }} Selected 
                    </x-slot>
                    <x-slot name="menu"> 
                        @switch($subPage)
                            @case(1)
                                <div wire:click.prevent="batchRemoveFromQueue" class="item"><i class="delete icon"></i> Remove from exam list</div>
                                @break
                            @case(2)
                                
                                @break
                        
                            @case(3)
                                
                                @break
                            @case(4)
                                <div class="item"><i class="edit icon"></i> Edit</div>
                                <div class="item"><i class="add icon"></i> Add to exam list</div>
                                <div wire:click.prevent="deletingPatients" class="item"><i class="delete icon"></i> Delete</div>
                                @break
                            @default
                        @endswitch
                    </x-slot>
                </x-atoms.ui.header-dropdown-menu>                
            @else
                <x-atoms.ui.header-add-btn label="Add Patient" wire-click="patientShowModal('isAdd', null)"/>
            @endif
        @endif
    @endsection

    @section('section-heading-right')

        @switch($subPage)
            @case(1)
                <div><x-atoms.ui.search wire-model="searchPatient" placeholder="Search..."/></div>
                @break
            @case(2)
                <div><x-atoms.ui.search wire-model="searchPatient" placeholder="Search..."/></div>
                <x-atoms.ui.header-dropdown-menu class="right pointing tiny">
                    <x-slot name="menu"> 
                        <div class="item">
                            <x-molecules.ui.dropdown.icon/>
                            <span class="text">Filter</span>
                            <x-molecules.ui.dropdown.menu>
                                <div wire:click.prevent="$set('filter', 'DATE_RANGE')" class="item">
                                    Date Range
                                </div>
                                <div wire:click.prevent="$set('filter', 'DATE_SINGLE')" class="item">
                                    Single Date
                                </div>
                                <div class="header">
                                    Filter by tag
                                </div>
                                <div class="divider"></div>
                                <div class="item">
                                    Today
                                </div>
                                <div class="item">
                                    This Week
                                </div>
                                <div class="item">
                                    This Month
                                </div>
                            </x-molecules.ui.dropdown.menu>
                        </div>
                    </x-slot>
                </x-atoms.ui.header-dropdown-menu>
                @break
            @case(3)
                @break
            @case(4)

                @switch($filter)
                    @case('DATE_RANGE')
                        <div class="x-flex x-gap-1 x-flex-ycenter">
                            <div><span class="ui text">Found {{ $filterResults }} results.</span></div>
                            
                            <div class="ui right mini labeled input">
                                <div class="ui dropdown label">
                                    <div class="text">From</div>
                                </div>
                                <input wire:model="date_from" type="date">
                            </div>

                            <div class="ui right mini labeled input @if ($date_to < $date_from) error @endif">
                                <div class="ui dropdown label">
                                    <div class="text">To</div>
                                </div>
                                <input wire:model="date_to" type="date">
                            </div>

                            <button wire:click.prevent="$set('filter', '')" class="ui tertiary tiny icon button">
                                <i class="close icon"></i>
                            </button>
                        </div>
                        @break

                    @case('DATE_SINGLE')
                        <div class="x-flex x-gap-1 x-flex-ycenter">
                            <div><span class="ui text">Found {{ $filterResults }} results.</span></div>
                            <div class="ui right mini input">
                                <input wire:model="DATE_SINGLE" type="date">
                            </div>
                            <button wire:click.prevent="$set('filter', '')" class="ui tertiary tiny icon button">
                                <i class="close icon"></i>
                            </button>
                        </div>
                        @break

                    @default
                        <div><x-atoms.ui.search wire-model="searchPatient" placeholder="Search..."/></div>
                @endswitch
                <div>
                    <x-atoms.ui.header-dropdown-menu class="right pointing tiny">
                        <x-slot name="menu"> 
                            <div class="item">
                                <x-molecules.ui.dropdown.icon/>
                                <span class="text">Filter</span>
                                <x-molecules.ui.dropdown.menu>
                                    <div wire:click.prevent="$set('filter', 'DATE_RANGE')" class="item">
                                        Date Range
                                    </div>
                                    <div wire:click.prevent="$set('filter', 'DATE_SINGLE')" class="item">
                                        Single Date
                                    </div>
                                    <div class="ui divider"></div>
                                    <div class="item">
                                        Today
                                    </div>
                                    <div class="item">
                                        This Week
                                    </div>
                                    <div class="item">
                                        This Month
                                    </div>
                                </x-molecules.ui.dropdown.menu>
                            </div>
                            <div class="item">
                                <x-molecules.ui.dropdown.icon/>
                                <span class="text">Showing {{ $pageNumber }} Entries</span>
                                <x-molecules.ui.dropdown.menu>
                                    <x-organisms.ui.paginator-number/>
                                </x-molecules.ui.dropdown.menu>
                            </div>
                        </x-slot>
                    </x-atoms.ui.header-dropdown-menu>
                </div>
                @break
                
            @default
        @endswitch
    @endsection

    @section('section-main')
        {{-- @switch($subPage)
            @case(1) --}}
                <div style="display: {{ $subPage == 1 ? 'block' : 'none'}}">
                    @if ($inqueue->where('patient_exam_status', true)->count() > 0) 
                        <x-organisms.ui.table class="selectable unstackable">
                            <x-slot name="thead"></x-slot>
                            <x-slot name="tbody">
                                @foreach ($inqueue->where('patient_exam_status', true) as $pt)   
                                    @include('livewire.components.organisms.pagecontents.patient-content.in-list-table')
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                    @endif
                        
                    @if (($inqueue->where('patient_exam_status', true)->count()) > 0 && ($inqueue->where('patient_exam_status', false)->count() > 0))
                        <center>
                            ...
                        </center>
                    @endif
    
                    @if ((! $inqueue->where('patient_exam_status', true)->count()) > 0 && (! $inqueue->where('patient_exam_status', false)->count() > 0))
                        <x-atoms.ui.message 
                            icon="frown open"
                            class="mt_20"
                            header="Exam list is empty."
                            message="This section will contain patients to be examined."/>
                    @endif
    
                    @if ($inqueue->where('patient_exam_status', false)->count() > 0)
                        <x-organisms.ui.table class="selectable unstackable">
                            <x-slot name="thead"></x-slot>
                            <x-slot name="tbody">
                                @foreach ($inqueue->where('patient_exam_status', false) as $pt)   
                                    @include('livewire.components.organisms.pagecontents.patient-content.in-list-table')
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                    @endif
                </div>

                {{-- @break
            @case(2) --}}
                <div style="display: {{ $subPage == 2 ? 'block' : 'none'}}">

                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th label="Date Purchased" style="width:10em;"/>
                            <x-organisms.ui.table.th label="Total" order-by="total"/>
                            <x-organisms.ui.table.th label="Balance" order-by="balance"/>
                            <x-organisms.ui.table.th label="Due Date" order-by="dudate"/>
                            <x-organisms.ui.table.th label="Purchased By" order-by="supplier_name"/>
                            <x-organisms.ui.table.th label="Payment Type"/>
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($allPurchases as $purchase)
                                <tr class="{{ $purchase->balance > 0 ? 'warning' : ''; }}">
                                    <x-organisms.ui.table.td 
                                        desc="{{ $this->date($purchase->created_at) }}"/>
                                    <x-organisms.ui.table.td
                                        text="{{ number_format($purchase->total) }}"
                                        text-icon="fa-peso-sign"/>
                                    <x-organisms.ui.table.td
                                        text="{{ empty($purchase->balance) || ($purchase->balance == 0) ? 'Paid' : number_format($purchase->balance); }}"
                                        text-icon="{{ empty($purchase->balance) || ($purchase->balance == 0) ? '' : 'fa-peso-sign';}}"
                                        desc="{{ !empty($purchase->deposit) || ($purchase->deposit > 0) ?  number_format($purchase->deposit) . ' Depo' : ''; }}"
                                        desc-icon="{{ !empty($purchase->deposit) || ($purchase->deposit > 0) ? 'fa-peso-sign' : '' }}"/>
                                    <x-organisms.ui.table.td
                                        text="{{ empty($purchase->duedate) || ($purchase->duedate == null) ? '--' : $this->date($purchase->duedate); }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $purchase->patient->patient_lname . ', ' . $purchase->patient->patient_fname . ' ' . $purchase->patient->patient_mname }}"
                                        avatar="{{ $this->storage($purchase->patient->patient_avatar) }}"/>
                                    <x-organisms.ui.table.td
                                        text="On Hand"/>
                                    <x-organisms.ui.table.td-more>
                                        <x-atom.more.option
                                            wire-click="patientShowModal('purchase', {{ $purchase->patient->id }})"
                                            option-name="Details"/>
                                    </x-organisms.ui.table.td>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse
                        </x-slot>
                    </x-organisms.ui.table>
                </div>
                {{-- @break
            @case(3) --}}
                {{-- <div style="n --}}
                {{-- @break
            @case(4)  --}}
                <div style="display: {{ $subPage == 4 ? 'block' : 'none'}}">
                    <x-organisms.ui.table class="selectable unstackable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="" style="width: 9em"/>
                            <x-organisms.ui.table.th label="Name" order-by="patient_lname" />
                            <x-organisms.ui.table.th label=""/>
                            <x-organisms.ui.table.th label=""/>
                            <x-organisms.ui.table.th label="Date Added" order-by="created_at"/>
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @php
                                $count = 1;
                            @endphp
                            @forelse ($pts as $pt)   
                                <tr class="{{ $this->examListIndicator($pt->id) ? 'positive' : ''; }}">
                                    <x-organisms.ui.table.td 
                                        checkbox="selectedPatients" 
                                        checkbox-value="{{ $pt->id }}"
                                        style="width: 3em"/>
                                    <x-organisms.ui.table.td>
                                        <div class="flex flex_y_center full_w" style="gap:0.8em">
                                            <div>
                                                <div wire:click.prevent="patientShowModal('exam', {{ $pt->id }})" class="clickable_icon">
                                                    <span class="ui text teal">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div wire:click.prevent="patientShowModal('purchase', {{ $pt->id }})">
                                                <div class="clickable_icon">
                                                    <span class="ui text blue">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>  
                                    </x-organisms.ui.table.td>
                                    <x-organisms.ui.table.td 
                                        text="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}}"
                                        desc="{{ !empty($pt->patient_address) || ($pt->patient_address != NULL) ? $pt->patient_address : ''; }}"
                                        desc-icon="{{ !empty($pt->patient_address) || ($pt->patient_address != NULL) ? 'fa-location-dot' : ''; }}"
                                        avatar="{{ $this->storage($pt->patient_avatar) }}"/>
                                    <x-organisms.ui.table.td 
                                        desc="Exams: {{ $this->countExam($pt->id) }}"/>
                                    <x-organisms.ui.table.td 
                                        desc="Purchases: {{ $this->countPurchase($pt->id) }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $this->date($pt->created_at) }}"/>
                                    <x-organisms.ui.table.td-more style="width: 3em">
                                        <x-atom.more.option
                                            wire-click="patientShowModal('isUpdate', {{ $pt->id }})"
                                            option-name="Edit"/>
                                        <x-atom.more.option 
                                            wire-click="deletingPatient({{ $pt->id }})"
                                            option-name="Delete"/>
                                        <x-atom.more.option 
                                            wire-click="history(1, {{ $pt->id }})"
                                            option-name="Exam History"/>
                                        <x-atom.more.option 
                                            wire-click="history(2, {{ $pt->id }})"
                                            option-name="Purchase History"/>
                                        <div class="divider"></div>
                                        @if ($this->currentlyInPaientList($pt->id))
                                            <x-atom.more.option 
                                                wire-click="removeFromQueue({{ $pt->id }})"
                                                option-name="Remove from exam list" />
                                        @else
                                            <x-atom.more.option 
                                                wire-click="addToQueue({{ $pt->id }})"
                                                option-name="Add to exam list" />
                                        @endif
                                    </x-organisms.ui.table.td>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse
                        </x-slot>
                    </x-organisms.ui.table>
                    {{ $pts->links('livewire.components.paginator') }}
                </div>
                {{-- @break
            @default
                
        @endswitch --}}
        





        



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
                                                                <div wire:click.prevent="patientShowModal('exam', {{ $pt->id }})" class="clickable_icon">
                                                                    <i class="fa-solid fa-pen  green"></i>
                                                                </div>
                                                            </div>
                                                            <div wire:click.prevent="patientShowModal('purchase', {{ $pt->id }})">
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
                                                                <div wire:click.prevent="patientShowModal('exam', {{ $pt->id }})" class="clickable_icon">
                                                                    <i class="fa-solid fa-pen  green"></i>
                                                                </div>
                                                            </div>
                                                            <div wire:click.prevent="patientShowModal('purchase', {{ $pt->id }})">
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
                                                                <div wire:click.prevent="patientShowModal('exam', {{ $pt->id }})" class="clickable_icon">
                                                                    <i class="fa-solid fa-pen  green"></i>
                                                                </div>
                                                            </div>
                                                            <div wire:click.prevent="patientShowModal('purchase', {{ $pt->id }})">
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
                                                        <div wire:click.prevent="patientShowModal('exam', {{ $pt->id }})" class="clickable_icon">
                                                            <i class="fa-solid fa-pen  green"></i>
                                                        </div>
                                                    </div>
                                                    <div wire:click.prevent="patientShowModal('purchase', {{ $pt->id }})">
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

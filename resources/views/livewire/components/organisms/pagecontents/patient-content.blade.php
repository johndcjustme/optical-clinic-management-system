<x-layout.page-content>

    @section('section-page-title', 'Patients')

    @section('section-links')
        <x-atom.tab-links.link tab-title="Today" wire-click="$set('tab', 1)" sub-page="{{ $tab === 1}}" />
        <x-atom.tab-links.link tab-title="Queue (4)" wire-click="$set('tab', 2)" sub-page="{{ $tab === 2}}" />
        <x-atom.tab-links.link tab-title="Patient list" wire-click="$set('tab', 3)" sub-page="{{ $tab === 3}}" />
    @endsection

    @section('section-heading-left')
        <div>
            <x-atoms.ui.button wire:click.prevent="patientShowModal('isAdd', null)" class="primary basic tiny">
                <i class="icon plus"></i> New
            </x-atoms.ui.button>
        </div>
        <div class="flex flex_y_center gap_1">
            {{-- <p>Show</p> --}}
            <select wire:model="showInPatient" class="input_small">
                <option value="1">In list Patints</option>
                <option value="2">All Patients</option>
            </select>
        </div>
    @endsection

    @section('section-heading-right')
        <div class="flex gap_1">
            <x-atom.sort>
                <x-atom.sort.sort-content 
                    for=""
                    span="Entries"
                    wire-model="le_paginateVal"
                    name=""
                    val="" 
                />                                
                <x-atom.sort.sort-content 
                    for="az"
                    span="A-Z"
                    wire-model="le_sortDirection"
                    name="sort"
                    val="asc" 
                />
                <x-atom.sort.sort-content 
                    for="za"
                    span="Z-A"
                    wire-model="le_sortDirection"
                    name="sort"
                    val="desc" 
                />
                <x-atom.sort.sort-content 
                    for="l_modified"
                    span="Last Modified"
                    wire-model="sortBy('le', 'created_at')"
                    name="sort"
                    val="" 
                />
                <x-atom.sort.sort-content 
                    for="f_modified"
                    span="First Modified"
                    wire-model="le_sortDirection"
                    name="sort"
                    val="first_modified" 
                />
            </x-atom.sort>
        </div>
        <div>
            <x-atom.btn-circle wire-click="patientShowModal('isAdd', null)"/>
        </div>
        <div> <x-atoms.ui.search wire-model="searchItem" placeholder="Search..."/> </div>
    @endsection

    @section('section-main')

        <x-organisms.ui.table class="selectable">
            <x-slot name="thead">
                <x-organisms.ui.table.th-checkbox/>
                <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                <x-organisms.ui.table.th label="" order-by="item_type" />
                <x-organisms.ui.table.th label="Status" />
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
                            desc="{{ $pt->patient_address }}"
                            desc-icon="fa-location-dot"
                            avatar="{{ $this->storage('avatars', $pt->patient_avatar) }}"/>
                        <x-organisms.ui.table.td 
                            text="Scheduled"/>
                        <x-organisms.ui.table.td 
                            text=""
                            desc=""/>
                        <x-organisms.ui.table.td-more>
                            <x-atom.more.option
                                wire-click="showModal('update', 'supplier', {{ $pt->id }})"
                                option-name="Edit" />
                            <x-atom.more.option 
                                wire-click="deletingSupplier({{ $pt->id }})"
                                option-name="Delete" />
                        </x-organisms.ui.table.td>
                    </tr>
                @empty
                    <x-organisms.ui.table.search-no-results colspan="7"/>
                @endforelse
            </x-slot>
        </x-organisms.ui.table>


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

<x-layout.page-content>

    @section('section-page-title', 'Appointments')

    @section('section-links')
            <x-atom.tab-links.link tab-title="Ongoing" wire-click="myTab(1)" sub-page="{{ $this->myTab == 1 }}"/>
            <x-atom.tab-links.link tab-title="For Approval" wire-click="myTab(2)" sub-page="{{ $this->myTab == 2 }}">
                <span class="absolute right bg_red flex flex_center" style="top: -1.2em; background:red; color:white; font-size: 0.55rem; height: 1.9em; width: 1.9em; border-radius: 50%;">{{ $appts->where('appt_confirmed', null)->where('appt_confirmed', 0)->count() }}</span>
            </x-atom.tab-links.link>
    @endsection

    @section('section-heading-left')

        <h5>
            @switch($this->myTab)
                @case(1)
                    ONGOING
                    @break
                @case(2)
                    FOR APPROVAL
                    @break
                @default
                    
            @endswitch
        </h5>
    @endsection

    @section('section-heading-right')
        @switch($this->myTab)
            @case(1)
                <div>
                    <x-input.search wire-model="searchAppt"/>
                </div>
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
                    <x-atom.btn-circle wire-click="inventoryShowModal('isAdd', 'le', null)"/>
                </div>
                @break

            @case(2)
                <div>
                    <x-input.search wire-model="searchAppt"/>
                </div>
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
                    <x-atom.btn-circle wire-click="inventoryShowModal('isAdd', 'le', null)"/>
                </div>
                @break
            @default
        @endswitch
    @endsection

    @section('section-main')

        <div class="items">

            @if($this->myTab == 1)
                <x-layout.lists-section>               
        
                    <x-layout.lists-section.lists-list list-for="grid_appointment title">
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_name')"
                            col-title="Patient Name"
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_desc')"
                            col-title="Appointment Date"
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_qty')"
                            col-title="Reschedule"
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_price')"
                            col-title="Status"
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_price')"
                            col-title="Phone No."
                            arrow-direction=""
                        />
                    </x-layout.lists-section.lists-list>

                    @forelse ($appts->where('appt_confirmed', 1) as $appt)
                        <x-layout.lists-section.lists-container>
                            <x-layout.lists-section.lists-list list-for="grid_appointment list">

                                <div>{{ $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname . ' ' . $appt->patient->patient_lname  }}</div>
                                <div style="padding: 0 1em 0 0">
                                    <input type="date" name="" id="" value="{{ $appt->appt_date }}" class="noformat"> 
                                </div>
                                <div style="padding: 0 1em 0 0">
                                    <input type="date" value="{{ $appt->appt_resched }}" class="noformat">
                                </div>
                                <div style="padding: 0">
                                    <select name="" id="" class="noformat" style="color:{{ Str::title($appt->appt_status) === 'Missed' ? 'red' : '' }}">
                                        <option value=""selected>{{ Str::title($appt->appt_status) }}</option>
                                        <option value="">Reschedule</option>
                                        <option value="">Missed</option>
                                        <option value="">Ongoing</option>
                                    </select>
                                </div>
                                <div>{{ $appt->patient->patient_mobile }}</div>

                            </x-layout.lists-section.lists-list>
                            <div class="actions" style="pointer-events:none">
                                <x-layout.lists-section.action 
                                    item-id="{{ $appt->id }}" 
                                    wire-click-delete="deleteInventory('le', {{ $appt->id }})"
                                    wire-click-edit="inventoryShowModal('isUpdate', 'le', '{{ $appt->id }}')"
                                    photo=""
                                >
                                    {{-- <label for="">Tint</label>
                                    <p>{{ $lense->lense_tint }}</p>
                                    <label for="">Date Added</label>
                                    <p>{{ $lense->created_at }}</p> --}}
                                </x-layout.lists-section.action>
                            </div>
                        </x-layout.lists-section.lists-container>
                    @empty
                        <x-layout.lists-section.list-empty empty-message="No Results."/>
                    @endforelse
                    
                </x-layout.lists-section>
                

            @elseif($this->myTab == 2)

                <x-layout.lists-section>               
    
                    <x-layout.lists-section.lists-list list-for="grid_appointment title">
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_name')"
                            col-title="Patient Name"
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_desc')"
                            col-title="Appointment Date"
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_qty')"
                            col-title="Status"
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_price')"
                            col-title="Phone No."
                            arrow-direction=""
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_price')"
                            col-title="Action"
                            arrow-direction=""
                        />
                    </x-layout.lists-section.lists-list>
                    
                    @forelse ($appts->where('appt_confirmed', 0) as $appt)
                        <x-layout.lists-section.lists-container>
                            <x-layout.lists-section.lists-list list-for="grid_appointment list">
                              
                                <x-layout.lists-section.list-item 
                                    item-name="{{ $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname . ' ' . $appt->patient->patient_lname  }}" 
                                    item-desc=""
                                />

                                {{-- <div></div> --}}
                                <div style="padding: 0">
                                    <input type="date" name="" id="" value="{{ $appt->appt_date }}" class="noformat"> 
                                </div>
                                <div style="padding: 0">
                                    <select name="" id="" class="noformat" style="color:{{ Str::title($appt->appt_status) === 'Missed' ? 'red' : '' }}">
                                        <option value=""selected>{{ Str::title($appt->appt_status) }}</option>
                                    </select>
                                </div>
                                <div>{{ $appt->patient->patient_mobile }}</div>
                                <div style="padding: 0">
                                    <div class="flex flex_center gap_1 full_w">
                                        <div><button class="circle small"><i class="fa-solid fa-check"></i></button></div>
                                        <div><button class="circle small bg_red"><i class="fa-solid fa-xmark"></i></button></div>
                                    </div>
                                </div>
                            </x-layout.lists-section.lists-list>
                            <div class="actions" style="pointer-events:none">
                                <x-layout.lists-section.action 
                                    item-id="{{ $appt->id }}" 
                                    wire-click-delete="deleteInventory('le', {{ $appt->id }})"
                                    wire-click-edit="inventoryShowModal('isUpdate', 'le', '{{ $appt->id }}')"
                                    photo=""
                                >
                                </x-layout.lists-section.action>
                            </div>
                        </x-layout.lists-section.lists-container>
                    @empty
                        <x-layout.lists-section.list-empty empty-message="No Results."/>
                    @endforelse
                </x-layout.lists-section>
            @endif

        </div>


        @if ($this->shedsettings_isOpen) 
            <x-organisms.panel-settings title="Schedule Settings" wire-toggle="shedsettings_isOpen">
                @includeIf('livewire.components.organisms.pagecontents.appointments-content.appointment-settings')
                {{-- <x-organisms.panel-settings.appointment-settings/> --}}
            </x-organisms.panel-settings>
        @endif

        <button wire:click="$toggle('shedsettings_isOpen')" class="circle panel_settings_button">
            <i class="fa-solid fa-gear"></i>
        </button>

    @endsection

</x-layout.page-content>

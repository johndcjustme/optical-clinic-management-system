<x-layout.page-content>

    @section('section-page-title', 'Appointments')

    @section('section-links')
            <x-atom.tab-links.link tab-title="Ongoing" wire-click="myTab(1)" sub-page="{{ $this->myTab == 1 }}"/>
            <x-atom.tab-links.link tab-title="Completed" wire-click="myTab(2)" sub-page="{{ $this->myTab == 2 }}"/>
    @endsection

    @section('section-heading-left')

        <h5>
            @switch($this->myTab)
                @case(1)
                    ONGOING
                    @break
                @case(2)
                    COMPLETED
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
                COMPLETED
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

                    @forelse ($appts as $appt)
                        <x-layout.lists-section.lists-container>
                            <x-layout.lists-section.lists-list list-for="grid_appointment list">

                                <div>{{ $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname . ' ' . $appt->patient->patient_lname  }}</div>
                                <div style="padding: 0">
                                    <input type="date" name="" id="" value="{{ $appt->appt_date }}" class="noformat"> 
                                </div>
                                <div>{{ $appt->appt_resched }}</div>
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
                    
                    {{-- @forelse ($lenses as $lense)

                        <x-layout.lists-section.lists-container>
                            <x-layout.lists-section.lists-list list-for="grid_lens list">

                                <div>{{ $lense->lense_name }}</div>
                                <div>{{ $lense->lense_desc }}</div>
                                @isset ($lense->supplier_id)
                                    <div>{{ $lense->supplier->supplier_name }}</div>                                            
                                @endisset
                                <div>{{ $lense->lense_qty }}</div>
                                <div>{{ $lense->lense_price }}</div>

                            </x-layout.lists-section.lists-list>
                            <div class="actions">
                                <x-layout.lists-section.action 
                                    item-id="{{ $lense->id }}" 
                                    wire-click-delete="deleteInventory('le', {{ $lense->id }})"
                                    wire-click-edit="inventoryShowModal('isUpdate', 'le', '{{ $lense->id }}')"
                                    photo="{{ asset('images/sample-image.jpg') }}"
                                >
                                    <label for="">Tint</label>
                                    <p>{{ $lense->lense_tint }}</p>
                                    <label for="">Date Added</label>
                                    <p>{{ $lense->created_at }}</p>
                                </x-layout.lists-section.action>
                            </div>

                        </x-layout.lists-section.lists-container>

                    @empty
                        <x-layout.lists-section.list-empty empty-message="No Results."/>
                    @endforelse --}}

                    
                </x-layout.lists-section>
                

            @elseif($this->myTab == 2)

                <x-layout.lists-section>               
    
                    <x-layout.lists-section.lists-list list-for="grid_appointment title">
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_name')"
                            col-title="Patient Name"
                            arrow-direction="{{ $this->le_sortColumn === 'lense_name' && $this->le_sortDirection === 'asc' }}"
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_desc')"
                            col-title="Appointment Date"
                            arrow-direction="{{ $this->le_sortColumn === 'lense_desc' && $this->le_sortDirection === 'asc' }}"
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_qty')"
                            col-title="Reschedule"
                            arrow-direction="{{ $this->le_sortColumn === 'lense_qty' && $this->le_sortDirection === 'asc' }}"
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_price')"
                            col-title="Status"
                            arrow-direction="{{ $this->le_sortColumn === 'lense_price' && $this->le_sortDirection === 'asc' }}"
                        />
                        <x-atom.column-title  
                            wire-click="sortBy('le', 'lense_price')"
                            col-title="Phone No>"
                            arrow-direction="{{ $this->le_sortColumn === 'lense_price' && $this->le_sortDirection === 'asc' }}"
                        />
                    </x-layout.lists-section.lists-list>
                    
                    {{-- @forelse ($lenses as $lense)

                        <x-layout.lists-section.lists-container>
                            <x-layout.lists-section.lists-list list-for="grid_lens list">

                                <div>{{ $lense->lense_name }}</div>
                                <div>{{ $lense->lense_desc }}</div>
                                @isset ($lense->supplier_id)
                                    <div>{{ $lense->supplier->supplier_name }}</div>                                            
                                @endisset
                                <div>{{ $lense->lense_qty }}</div>
                                <div>{{ $lense->lense_price }}</div>

                            </x-layout.lists-section.lists-list>
                            <div class="actions">
                                <x-layout.lists-section.action 
                                    item-id="{{ $lense->id }}" 
                                    wire-click-delete="deleteInventory('le', {{ $lense->id }})"
                                    wire-click-edit="inventoryShowModal('isUpdate', 'le', '{{ $lense->id }}')"
                                    photo="{{ asset('images/sample-image.jpg') }}"
                                >
                                    <label for="">Tint</label>
                                    <p>{{ $lense->lense_tint }}</p>
                                    <label for="">Date Added</label>
                                    <p>{{ $lense->created_at }}</p>
                                </x-layout.lists-section.action>
                            </div>

                        </x-layout.lists-section.lists-container>

                    @empty
                        <x-layout.lists-section.list-empty empty-message="No Results."/>
                    @endforelse --}}

                    
                </x-layout.lists-section>

                @for ($i=1; $i<12; $i++)
                    <div class="grid grid_appointment list">
                        <div>
                            <input class="noformat" list="suggest_name" type="text" value="John Doe">
                            <datalist id="suggest_name">
                                <option value="data 1">Lianga</option>
                                <option value="data 2"></option>
                                <option value="data 3"></option>
                                <option value="data 4"></option>
                            </datalist>
                        </div>
                        <div><input class="noformat" type="date"></div>
                        <div><input class="noformat" type="date"></div>
                        <div>
                            <select class="noformat" name="" id="">
                                <option value="" selected>Completed</option>
                                <option value="">Missed</option>
                            </select>
                        </div>
                        <div>
                            <input class="noformat" type="number" min="0" value="0947482393457">
                        </div>
                        <div>
                            <input id="barcolor" class=" action noformat" type="color"value="#2B4FFF" style="height: 20px; width:20px; border-radius: 50%;">
                        </div>
                        <div class="flex flex_x_end">
                            <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                            <a wire:click="showModalOnLensUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                        </div>
                    </div>
                @endfor
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

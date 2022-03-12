@php
    $forApprovalCount = $appts->where('appt_confirmed', null)->where('appt_confirmed', 0)->count()
@endphp 

<x-layout.page-content>

    @section('section-page-title', 'Appointments')

    @section('section-links')
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla, similique.</p>
    @endsection

    @section('section-heading-left')
        <h5>
            @switch($this->myTab)
                @case(1)
                    @if (count($selectedAppts) > 0)
                        <div class="flex gap_1 flex_y_center animate_opacity">
                            <button wire:click.prevent="deleteAppts" class="btn_small bg_red">Delete</button>        
                            <button wire:click.prevent="approveAppts" class="btn_small bg_red">Approve</button>        
                            <p style="font-weight: normal">
                                {{ count($selectedAppts) }} item{{ count($selectedAppts) > 1 ? 's' : '' }} selected
                            </p>
                        </div>
                    @endif
                    @break                   
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
                    <x-atom.btn-circle wire-click="apptShowModal('isAdd', null)"/>
                </div>
                @break
        @endswitch
    @endsection

    @section('section-main')
        <div class="items">
            @if($this->myTab == 1)
                <x-layout.lists-section>               
                    @if (count($appts->where('appt_confirmed', 0)) > 0)
                        <x-layout.details>
                            <x-slot name="details_summary">
                                New Appointments ({{ $this->countForApprovalAppts() }})
                            </x-slot>
                            <x-slot name="details_content">

                                @forelse ($appts->where('appt_confirmed', null) as $appt)
                                    <div>
                                        <x-layout.lists-section.lists-container>
                                            <x-layout.lists-section.lists-list list-for="grid_appointment list">
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center">
                                                        <input wire:model="selectedAppts" type="checkbox" class="pointer" value="{{ $appt->id }}">
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex gap_1 flex_y_center">
                                                        <div>
                                                            <x-atom.profile-photo size="2.5em" path="storage/photos/avatars/default-avatar-pt.png"/>
                                                        </div>
                                                        <div>
                                                            <p class="font_400">
                                                                <strong>
                                                                    {{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}
                                                                </strong>
                                                            </p>
                                                            @if (isset($appt->patient->patient_address))
                                                                <p class="dark_200 mt_2"><small>{{ $appt->patient->patient_address }}</small></p>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex">
                                                        <div class="mr_3">
                                                            <i class="fa-solid fa-calendar-check accent_1"></i>
                                                        </div>
                                                        <div>
                                                            <div>
                                                                <p class="accent_1">
                                                                    <strong>
                                                                        {{ $this->date($appt->appt_date) }}
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <p class="dark_200 mt_2">
                                                                    <small>
                                                                        {{ $this->day($appt->appt_date) }}
                                                                        {{ $this->time($appt->appt_time) }}
                                                                    </small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center text_center full_w">
                                                        <p class="py_2 px_6 light_100" style="border-radius: 3em; font-size:0.75rem; background:{{ $this->statusColor($appt->appt_status) }}">
                                                            {{ $apptStatus['fa'] }}
                                                        </p>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <p>
                                                        <i class="fa-solid fa-phone mr_2"></i>
                                                        {{ $appt->patient->patient_mobile }}
                                                    </p>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center">
                                                        <x-atom.more>
                                                            <x-atom.more.option wire-click="apptShowModal('isUpdate', {{ $appt->id }})" option-name="Edit" />
                                                        </x-atom.more>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                            </x-layout.lists-section.lists-list>
                                        </x-layout.lists-section.lists-container>
                                    </div>
                                @empty
                                    <x-layout.lists-section.list-empty empty-message="No Results."/>
                                @endforelse
                            </x-slot>
                        </x-layout.details>
                    @endif

                    @if (count($appts->where('appt_confirmed', 1)) > 0)
                        <x-layout.details>
                            <x-slot name="details_summary">
                                Approved Appointments ({{ $this->countApprovedAppts() }})
                            </x-slot>
                            <x-slot name="details_content">
                                @forelse ($appts->where('appt_confirmed', 1)  as $appt)
                                    @if ($appt->appt_status != 'fu')
                                        <x-layout.lists-section.lists-container>
                                            <x-layout.lists-section.lists-list list-for="grid_appointment list">
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center">
                                                        <input wire:model="selectedAppts" type="checkbox" class="pointer" value="{{ $appt->id }}">
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex gap_1 flex_y_center">
                                                        <div>
                                                            <x-atom.profile-photo size="2.5em" path="storage/photos/avatars/default-avatar-pt.png" />
                                                        </div>
                                                        <div>
                                                            <p class="font_400">
                                                                <strong>
                                                                    {{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}
                                                                </strong>
                                                            </p>
                                                            @if (! empty($appt->patient->patient_address))
                                                                <p class="dark_200 mt_2" style="font-size: 0.75rem">{{ $appt->patient->patient_address }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex">
                                                        <div class="mr_3">
                                                            <i class="fa-solid fa-calendar-check accent_1"></i>
                                                        </div>
                                                        <div>
                                                            <div>
                                                                <p class="accent_1">
                                                                    <strong>
                                                                        {{ $this->date($appt->appt_date) }}
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <p class="dark_200 mt_2">
                                                                    <small>
                                                                        {{ $this->day($appt->appt_date) }}
                                                                        {{ $this->time($appt->appt_time) }}
                                                                    </small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center text_center full_w">
                                                        <p class="py_2 px_6 light_100" style="border-radius: 3em; font-size:0.75rem; background: {{ $this->statusColor($appt->appt_status) }}">
                                                            @switch($appt->appt_status)
                                                                    @case('fa')
                                                                        {{ $apptStatus['fa'] }}
                                                                        @break
                                                                    @case('on')
                                                                        {{ $apptStatus['on'] }}
                                                                        @break
                                                                    @case('re')
                                                                        {{ $apptStatus['re'] }}
                                                                        @break
                                                                    @case('fu')
                                                                        {{ $apptStatus['fu'] }}
                                                                        @break
                                                                    @case('mi')
                                                                        {{ $apptStatus['mi'] }}
                                                                        @break
                                                                
                                                                    @default
                                                                        
                                                                @endswitch
                                                        </p>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <p>
                                                        <i class="fa-solid fa-phone mr_2"></i>
                                                        {{ $appt->patient->patient_mobile }}
                                                    </p>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center">
                                                        <x-atom.more>
                                                            <x-atom.more.option wire-click="apptShowModal('isUpdate', {{ $appt->id }})" option-name="Edit" />
                                                        </x-atom.more>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                            </x-layout.lists-section.lists-list>
                                        </x-layout.lists-section.lists-container>
                                    @endif
                                @empty
                                    <x-layout.lists-section.list-empty empty-message="No Results."/>
                                @endforelse
                            </x-slot>
                        </x-layout.details>
                    @endif


                    @if (count($appts->where('appt_status', 'fu')) > 0)
                        <x-layout.details>
                            <x-slot name="details_summary">
                                Fulfilled ({{ $this->countFulfilledAppts() }})
                            </x-slot>
                            <x-slot name="details_content">
                                @forelse ($appts->where('appt_status', 'fu')  as $appt)
                                    <x-layout.lists-section.lists-container>
                                        <x-layout.lists-section.lists-list list-for="grid_appointment list">
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex flex_center">
                                                    <input wire:model="selectedAppts" type="checkbox" class="pointer" value="{{ $appt->id }}">
                                                </div>
                                            </x-layout.lists-section.list-item>
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex gap_1 flex_y_center">
                                                    <div>
                                                        <x-atom.profile-photo size="2.5em" path="storage/photos/avatars/default-avatar-pt.png" />
                                                    </div>
                                                    <div>
                                                        <p class="font_400">
                                                            <strong>
                                                                {{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}
                                                            </strong>
                                                        </p>
                                                        @if (! empty($appt->patient->patient_address))
                                                            <p class="dark_200 mt_2" style="font-size: 0.75rem">{{ $appt->patient->patient_address }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </x-layout.lists-section.list-item>
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex">
                                                    <div class="mr_3">
                                                        <i class="fa-solid fa-calendar-check accent_1"></i>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <p class="accent_1">
                                                                <strong>
                                                                    {{ $this->date($appt->appt_date) }}
                                                                </strong>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="dark_200 mt_2">
                                                                <small>
                                                                    {{ $this->day($appt->appt_date) }}
                                                                    {{ $this->time($appt->appt_time) }}
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-layout.lists-section.list-item>
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex flex_center text_center full_w">
                                                    <p class="py_2 px_6 light_100" style="border-radius: 3em; font-size:0.75rem; background: {{ $this->statusColor($appt->appt_status) }}">
                                                        @switch($appt->appt_status)
                                                                @case('fa')
                                                                    {{ $apptStatus['fa'] }}
                                                                    @break
                                                                @case('on')
                                                                    {{ $apptStatus['on'] }}
                                                                    @break
                                                                @case('re')
                                                                    {{ $apptStatus['re'] }}
                                                                    @break
                                                                @case('fu')
                                                                    {{ $apptStatus['fu'] }}
                                                                    @break
                                                                @case('mi')
                                                                    {{ $apptStatus['mi'] }}
                                                                    @break
                                                            
                                                                @default
                                                                    
                                                            @endswitch
                                                    </p>
                                                </div>
                                            </x-layout.lists-section.list-item>
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <p>
                                                    <i class="fa-solid fa-phone mr_2"></i>
                                                    {{ $appt->patient->patient_mobile }}
                                                </p>
                                            </x-layout.lists-section.list-item>
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex flex_center">
                                                    <x-atom.more>
                                                        <x-atom.more.option wire-click="apptShowModal('isUpdate', {{ $appt->id }})" option-name="Edit" />
                                                    </x-atom.more>
                                                </div>
                                            </x-layout.lists-section.list-item>
                                        </x-layout.lists-section.lists-list>
                                    </x-layout.lists-section.lists-container>
                                @empty
                                    <x-layout.lists-section.list-empty empty-message="No Results."/>
                                @endforelse
                            </x-slot>
                        </x-layout.details>
                    @endif

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
            <i id="settings_con" class="fa-solid fa-gear"></i>
        </button>

    @endsection

</x-layout.page-content>

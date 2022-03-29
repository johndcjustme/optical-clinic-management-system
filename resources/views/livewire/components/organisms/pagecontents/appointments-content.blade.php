@php
    $forApprovalCount = $appts->where('appt_confirmed', null)->where('appt_confirmed', 0)->count()
@endphp 

<x-layout.page-content>

    @section('section-page-title', 'Appointments')

    @section('section-links')
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla, similique.</p>
    @endsection

    @section('section-heading-left')
        <div>
            @if (count($selectedAppts) > 0)
                <div class="ui tiny basic icon buttons">
                    <x-atoms.ui.button wire:click.prevent="$set('selectedAppts', [])">
                        <i class="fa-solid fa-xmark"></i>
                    </x-atoms.ui.button>
                    <x-atoms.ui.button wire:click.prevent="deletingAppts">
                        <i class="fa-solid fa-trash ui text red mr_2"></i>
                        {{ 'items (' . count($selectedAppts) . ')' }}
                    </x-atoms.ui.button>
                    <x-atoms.ui.button wire:click.prevent="approveAppts">
                        <i class="fa-solid fa-thumbs-up ui text green mr_2"></i>
                        Approve
                    </x-atoms.ui.button>
                </div>
            @else
                <x-atoms.ui.button wire:click.prevent="apptShowModal('isAdd', null)" class="primary basic tiny">
                    <i class="icon plus"></i> Add
                </x-atoms.ui.button>
            @endif
        </div>
    @endsection

    @section('section-heading-right')
        <div> <x-atoms.ui.search wire-model="searchAppt" placeholder="Search Patient..."/> </div>
    @endsection

    @section('section-main')
        <div class="items">
            @if($this->myTab == 1)
                <x-layout.lists-section>               
                    @if (!empty($appts))
                        {{-- <x-layout.details>
                            <x-slot name="details_summary">
                                New Appointments ({{ $this->countForApprovalAppts() }})
                            </x-slot>
                            <x-slot name="details_content"> --}}

                                <x-organisms.ui.table class="selectable">
                                    <x-slot name="thead">
                                        <x-organisms.ui.table.th-checkbox/>
                                        <x-organisms.ui.table.th label="Date" order-by="appt_date" style="width:9em"/>
                                        <x-organisms.ui.table.th label="Status" order-by="appt_status" style="width:10em"/>
                                        <x-organisms.ui.table.th label="Patient Name" order-by="patient_name"/>
                                        <x-organisms.ui.table.th label="Contact Number" style="width:14em"/>
                                        <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:14em"/>
                                        <x-organisms.ui.table.th-more/>
                                    </x-slot>
                                    <x-slot name="tbody">
                                        @foreach ($appts->where('appt_status', 1) as $appt)
                                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                                        @endforeach

                                        @foreach ($appts->where('appt_status', 2)  as $appt)
                                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                                        @endforeach

                                        @foreach ($appts->where('appt_status', 3)  as $appt)
                                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                                        @endforeach

                                        @foreach ($appts->where('appt_status', 4)  as $appt)
                                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                                        @endforeach

                                        @foreach ($appts->where('appt_status', 6)  as $appt)
                                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                                        @endforeach

                                        @foreach ($appts->where('appt_status', 5)  as $appt)
                                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                                        @endforeach
                                    </x-slot>
                                </x-organisms.ui.table>

                                {{-- @forelse ($appts->where('appt_confirmed', null) as $appt)
                                    <div>
                                        <x-layout.lists-section.lists-container>
                                            <x-layout.lists-section.lists-list list-for="grid_appointment list">
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center">
                                                        <input wire:model="selectedAppts" type="checkbox" class="pointer" value="{{ $appt->id }}">
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item 
                                                    item-name="{{ $this->date($appt->appt_date) }} fontBold" 
                                                    item-desc=" {{ $this->day($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . $this->time($appt->appt_time) : '' }}"
                                                />
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_y_center full_w">
                                                        <p class="py_2 px_6 light_100" style="border-radius: 3em; color:{{ $this->statusColor($appt->appt_status) }}">
                                                            {{ $apptStatus['fa'] }}
                                                        </p>
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item 
                                                    avatar="storage/photos/avatars/default-avatar-pt.png"
                                                    item-name="{{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}" 
                                                    item-desc="{{ $appt->patient->patient_address }}"
                                                    item-desc-icon="fa-location-dot"
                                                />
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <p>
                                                        <i class="fa-solid fa-square-phone mr_2"></i>
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
                        </x-layout.details> --}}
                    @endif

                    
                    {{-- @if (count($appts->where('appt_confirmed', 1)) > 0)
                        <x-layout.details>
                            <x-slot name="details_summary">
                                Approved Appointments ({{ $this->countApprovedAppts() }})
                            </x-slot>
                            <x-slot name="details_content">
                                <x-organisms.ui.table class="selectable">
                                    <x-slot name="thead"></x-slot>
                                    <x-slot name="tbody">
                                        @forelse ($appts->where('appt_confirmed', 1)  as $appt)
                                            @if ($appt->appt_status != 'fu')
                                                <tr>
                                                    <x-organisms.ui.table.td style="width: 3em"
                                                        checkbox="selectedAppts" 
                                                        checkbox-value="{{ $appt->id }}"/>
                                                    <x-organisms.ui.table.td style="width:9em"
                                                        text="{{ $this->date($appt->appt_date) }}"
                                                        desc="{{ $this->day($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . $this->time($appt->appt_time) : '' }}"/>
                                                    <x-organisms.ui.table.td style="width: 10em">
                                                        <div class="flex flex_y_center full_w">
                                                            <p class="py_2 px_6 light_100" style="border-radius: 3em; color:{{ $this->statusColor($appt->appt_status) }}">
                                                                {{ $apptStatus['fa'] }}
                                                            </p>
                                                        </div>
                                                    </x-organisms.ui.table.td>
                                                    <x-organisms.ui.table.td 
                                                        text="{{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}"
                                                        desc="{{ $appt->patient->patient_address }}"
                                                        desc-icon="fa-location-dot"
                                                        avatar="{{ $this->storage($appt->patient->patient_avatar) }}"/>
                                                    <x-organisms.ui.table.td 
                                                        text="{{ $appt->patient->patient_mobile }}"
                                                        text-icon="fa-square-phone"/>
                                                    <x-organisms.ui.table.td 
                                                        desc="{{ $appt->created_at }}" />
                                                    <x-organisms.ui.table.td-more style="width: 1em">
                                                        <x-atom.more.option wire-click="apptShowModal('isUpdate', {{ $appt->id }})" option-name="Edit" />
                                                    </x-organisms.ui.table.td>
                                                </tr>
                                            @endif
                                        @empty
                                            <x-organisms.ui.table.search-no-results colspan="7"/>
                                        @endforelse
                                    </x-slot>
                                </x-organisms.ui.table>


                                @forelse ($appts->where('appt_confirmed', 1)  as $appt)
                                    @if ($appt->appt_status != 'fu')
                                        <x-layout.lists-section.lists-container>
                                            <x-layout.lists-section.lists-list list-for="grid_appointment list">
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_center">
                                                        <input wire:model="selectedAppts" type="checkbox" class="pointer" value="{{ $appt->id }}">
                                                    </div>
                                                </x-layout.lists-section.list-item>
                                                <x-layout.lists-section.list-item 
                                                    item-name="{{ $this->date($appt->appt_date) }} fontBold" 
                                                    item-desc=" {{ $this->day($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . $this->time($appt->appt_time) : '' }}"
                                                />
                                                <x-layout.lists-section.list-item item-name="" item-desc="">
                                                    <div class="flex flex_y_center full_w">
                                                        <p class="py_2 px_6 light_100" style="border-radius: 3em; color: {{ $this->statusColor($appt->appt_status) }}">
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
                                                <x-layout.lists-section.list-item 
                                                    avatar="storage/photos/avatars/default-avatar-pt.png"
                                                    item-name="{{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}" 
                                                    item-desc="{{ $appt->patient->patient_address }}"
                                                    item-desc-icon="fa-location-dot"
                                                />
                                                <x-layout.lists-section.list-item 
                                                    item-name="{{ $appt->patient->patient_mobile }}" 
                                                    item-name-icon="fa-square-phone"
                                                />
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
                    @endif --}}


                    {{-- @if (count($appts->where('appt_status', 'fu')) > 0)
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
                                            <x-layout.lists-section.list-item 
                                                item-name="{{ $this->date($appt->appt_date) }} fontBold" 
                                                item-desc=" {{ $this->day($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . $this->time($appt->appt_time) : '' }}"
                                            />
                                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                                <div class="flex flex_y_center full_w">
                                                    <p class="py_2 px_6 light_100" style="border-radius: 3em; color: {{ $this->statusColor($appt->appt_status) }}">
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
                                            <x-layout.lists-section.list-item 
                                                avatar="storage/photos/avatars/default-avatar-pt.png"
                                                item-name="{{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}" 
                                                item-desc="{{ $appt->patient->patient_address }}"
                                                item-desc-icon="fa-location-dot"
                                            />
                                            <x-layout.lists-section.list-item
                                                item-name="{{ $appt->patient->patient_mobile }}"
                                                item-name-icon="fa-square-phone"
                                            />
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
                    @endif --}}

                </x-layout.lists-section>
            @endif
            

        </div>



        @if ($shedsettings_isOpen) 
            <x-organisms.panel-settings title="Schedule Settings" wire-toggle="shedsettings_isOpen">
                @include('livewire.components.organisms.pagecontents.appointments-content.appointment-settings')
            </x-organisms.panel-settings>
        @endif
        

            {{-- <x-organisms.panel-settings.appointment-settings/> --}}
{{-- 
        <div class="ui sidebar vertical right menu" style="width: 300px">
            <div style="padding:1rem">
                <h3>Schedule settings</h3>
                @include('livewire.components.organisms.pagecontents.appointments-content.appointment-settings')
            </div>
    
        </div>
        <div class="pusher">
            <!-- Site content !-->
            
        </div> --}}
        
        
        <button wire:click.prevent="$toggle('shedsettings_isOpen')"  class="ui button primary" style="padding:0; height:3em; width:3em; border-radius:50%; position:fixed; right:2em; bottom:2em">
            <i id="settings_con" class="fa-solid fa-gear"></i>
        </button>

    @endsection

</x-layout.page-content>

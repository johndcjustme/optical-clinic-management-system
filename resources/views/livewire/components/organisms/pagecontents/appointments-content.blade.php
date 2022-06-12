@php
    $forApprovalCount = $appts
        ->where('appt_confirmed', null)
        ->where('appt_confirmed', 0)
        ->count();   
@endphp

<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Appointments"
            desc="Lorem Ipsum dolor sit amet."/>        
    @endsection

    @section('section-links')
        <x-organisms.ui.tabs>
            <x-organisms.ui.tabs.tab class="tab-active">
                <div class="dropdown">{{ $this->categoryName($activeMenu) }} 
                    <span style="margin-left:0.4em; opacity:0.5">{{ $this->categoryCount($activeMenu) }}</span>
                    <label tabindex="0" class="ml-2"><i class="fa-solid fa-caret-down"></i></label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-lg rounded-box w-52 mt-3 bg-neutral">
                        <li>
                            <a wire:click.prevent="$set('activeMenu', 'all')" class="text-white">All
                                <span class="badge bg-info-content badge-md">{{ $this->categoryDesc('all') }}</span>
                            </a>
                        </li>
                        @foreach (\App\Models\Appointment_category::all() as $ac)
                            <li class="{{ $this->categoryDesc($ac->id) == 0 ? 'tab-disabled' : '' }}">
                                <a wire:click.prevent="$set('activeMenu', {{ $ac->id }})" class="text-white">{{ $ac->title }}
                                    <span class="badge bg-info-content badge-md">{{ $this->categoryDesc($ac->id) }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>   
            </x-organisms.ui.tabs.tab>
        </x-organisms.ui.tabs>
    @endsection

    @section('section-heading-left')
        @if (count($selectedAppts) > 0)
            <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedAppts', [])" class="left pointing tiny">
                <x-slot name="label">
                    {{ count($selectedAppts) }} Selected
                </x-slot>
                <x-slot name="menu">
                    {{-- <div wire:click.prevent="approveAppts" class="item"><i class="check icon"></i> Approve</div> --}}
                    <li wire:click.prevent="deletingAppts" class="item"><a><i class="delete icon"></i> Delete</a></li>
                </x-slot>
            </x-atoms.ui.header-dropdown-menu>
        @else
            <x-atoms.ui.header-add-btn label="Add" wire-click="apptShowModal('isUpdate', null)" />
        @endif
    @endsection

    @section('section-heading-right')
        @if (count($appts) > 0)
            <x-atoms.ui.search wire-model="searchAppt" placeholder="Search..." />
        @endif
        <x-organisms.ui.dropdown-end>
            <x-organisms.ui.dropdown-entries :pagenumber="$pageNumber"/>
            <div class="ui divider"></div>
            <li wire:click.prevent="apptShowModal('settings', null)">
                <a>
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>
            </li>
        </x-organisms.ui.dropdown-end>
    @endsection

    @section('section-main')

        @if ($this->myTab == 1)
            @if (count($appts) > 0)
                <x-organisms.ui.table class="selectable unstackable">
                    <x-slot name="thead">
                        <x-organisms.ui.table.th-checkbox />
                        <x-organisms.ui.table.th style="width:0.5em; padding:0" />
                        <x-organisms.ui.table.th label="Status" order-by="appointment_category_id" style="width:10em" />
                        <x-organisms.ui.table.th label="Appointment" order-by="appt_date" style="width:12em" />
                        <x-organisms.ui.table.th label="" style="width:2em" />
                        <x-organisms.ui.table.th label="Patient Name" order-by="patient_name" />
                        <x-organisms.ui.table.th label="Phone Number" style="width:14em" />
                        <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:10em" />
                        <x-organisms.ui.table.th-more />
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($appts as $appt)
                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                        @endforeach
                    </x-slot>
                </x-organisms.ui.table>
                {{ $appts->links('livewire.components.paginator') }}
            @else
                <x-atoms.ui.message 
                    icon="frown open" 
                    class="mt_20" 
                    header="No Appointments yet."
                    message="This section will contain all appointments." />
            @endif
        @endif

    @endsection

</x-layout.page-content>

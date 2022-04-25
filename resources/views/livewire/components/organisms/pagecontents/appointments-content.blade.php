@php
    $forApprovalCount = $appts
        ->where('appt_confirmed', null)
        ->where('appt_confirmed', 0)
        ->count();



   
@endphp

<x-layout.page-content>

    @section('section-page-title')
        <div class="">
            <div>
                <x-atoms.ui.header title="Appointments" />
            </div>
            <div>
                <small>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla, similique.</small>
            </div>
        </div>
    @endsection

    @section('section-links')
        <div class="ui tiny menu" style="z-index:1;">
            <div class="ui floating labeled icon dropdown item">
                <i class="filter icon" style="margin-right:0.8em;"></i>
                {{ $this->categoryName($activeMenu) }} 
                <span style="margin-left:0.4em; opacity:0.5">{{ $this->categoryCount($activeMenu) }}</span>
                <div class="menu">
                    <div wire:click.prevent="$set('activeMenu', 'all')" class="vertical item">
                        <span class="text">All <span style="margin-left:0.4em; opacity:0.5;">{{ $this->categoryDesc('all') }}</span></span>
                    </div>
                    @foreach (\App\Models\Appointment_category::all() as $ac)
                        <div wire:click.prevent="$set('activeMenu', {{ $ac->id }})" class="vertical item {{ $this->categoryDesc($ac->id) == 0 ? 'disabled' : '' }}">
                            <span class="text">{{ $ac->title }} <span style="margin-left:0.4em; opacity:0.5;">{{ $this->categoryDesc($ac->id) }}</span></span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection

    @section('section-heading-left')
        @if (count($selectedAppts) > 0)
            <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedAppts', [])" class="left pointing tiny">
                <x-slot name="label">
                    {{ count($selectedAppts) }} Selected
                </x-slot>
                <x-slot name="menu">
                    {{-- <div wire:click.prevent="approveAppts" class="item"><i class="check icon"></i> Approve</div> --}}
                    <div wire:click.prevent="deletingAppts" class="item"><i class="delete icon"></i> Delete</div>
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
        <x-atoms.ui.header-dropdown-menu class="right pointing tiny">
            <x-slot name="menu">
                <div class="item">
                    <x-molecules.ui.dropdown.icon />
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
                <div class="item">
                    <x-molecules.ui.dropdown.icon />
                    <span class="text">Showing {{ $pageNumber }} Entries</span>
                    <x-molecules.ui.dropdown.menu>
                        <x-organisms.ui.paginator-number />
                    </x-molecules.ui.dropdown.menu>
                </div>
                <div class="ui divider"></div>
                <div wire:click.prevent="apptShowModal('settings', null)" class="item icon">
                    <i class="icon settings"></i>
                    Settings
                </div>
            </x-slot>
        </x-atoms.ui.header-dropdown-menu>
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
                        <x-organisms.ui.table.th label="Patient Name" order-by="patient_name" />
                        <x-organisms.ui.table.th label="Phone Number" style="width:14em" />
                        <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:14em" />
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

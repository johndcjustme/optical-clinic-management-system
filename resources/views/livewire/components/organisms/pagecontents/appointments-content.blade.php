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
        <div class="ui compact tiny menu" style="z-index:300;">
            <div class="ui floating labeled icon dropdown item">
                <i class="filter icon" style="margin-right:0.8em;"></i>
                <span class="text">
                    @switch($category)
                        @case(0)
                            {{ $this->category(0) }} <span class="description">{{ $this->categoryDesc(0) }}</span>
                        @break

                        @case(1)
                            {{ $this->category(1) }} <span class="description">{{ $this->categoryDesc(1) }}</span>
                        @break

                        @case(2)
                            {{ $this->category(2) }} <span class="description">{{ $this->categoryDesc(2) }}</span>
                        @break

                        @case(3)
                            {{ $this->category(3) }} <span class="description">{{ $this->categoryDesc(3) }}</span>
                        @break

                        @case(4)
                            {{ $this->category(4) }} <span class="description">{{ $this->categoryDesc(4) }}</span>
                        @break

                        @case(5)
                            {{ $this->category(5) }} <span class="description">{{ $this->categoryDesc(5) }}</span>
                        @break

                        @case(6)
                            {{ $this->category(6) }} <span class="description">{{ $this->categoryDesc(6) }}</span>
                        @break

                        @default
                    @endswitch
                </span>
                <div class="menu">
                    <div wire:click.prevent="$set('category', 0)" class="item vertical"><span
                            class="text">{{ $this->category(0) }}</span><span
                            class="description">{{ $this->categoryDesc(0) }}</span></div>
                    <div wire:click.prevent="$set('category', 1)" class="item vertical"><span
                            class="text">{{ $this->category(1) }}</span><span
                            class="description">{{ $this->categoryDesc(1) }}</span></div>
                    <div wire:click.prevent="$set('category', 2)" class="item vertical"><span
                            class="text">{{ $this->category(2) }}</span><span
                            class="description">{{ $this->categoryDesc(2) }}</span></div>
                    <div wire:click.prevent="$set('category', 3)" class="item vertical"><span
                            class="text">{{ $this->category(3) }}</span><span
                            class="description">{{ $this->categoryDesc(3) }}</span></div>
                    <div wire:click.prevent="$set('category', 4)" class="item vertical"><span
                            class="text">{{ $this->category(4) }}</span><span
                            class="description">{{ $this->categoryDesc(4) }}</span></div>
                    <div wire:click.prevent="$set('category', 5)" class="item vertical"><span
                            class="text">{{ $this->category(5) }}</span><span
                            class="description">{{ $this->categoryDesc(5) }}</span></div>
                    <div wire:click.prevent="$set('category', 6)" class="item vertical"><span
                            class="text">{{ $this->category(6) }}</span><span
                            class="description">{{ $this->categoryDesc(6) }}</span></div>
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
                    <div wire:click.prevent="approveAppts" class="item"><i class="check icon"></i> Approve
                    </div>
                    <div wire:click.prevent="deletingAppts" class="item"><i class="delete icon"></i> Remove
                        from exam list</div>
                </x-slot>
            </x-atoms.ui.header-dropdown-menu>
        @else
            <x-atoms.ui.header-add-btn label="Add" wire-click="apptShowModal('isAdd', null)" />
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
                <div wire:click.prevent="apptShowModal('settings', null)" class="item">
                    Settings
                </div>
            </x-slot>
        </x-atoms.ui.header-dropdown-menu>
    @endsection

    @section('section-main')

        @if ($this->myTab == 1)
            @if (count($appts) > 0)


                <x-organisms.ui.table class="selectable">
                    <x-slot name="thead">
                        <x-organisms.ui.table.th-checkbox />
                        <x-organisms.ui.table.th label="Appointment" order-by="appt_date" style="width:12em" />
                        <x-organisms.ui.table.th label="Status" order-by="appt_status" style="width:10em" />
                        <x-organisms.ui.table.th label="Patient Name" order-by="patient_name" />
                        <x-organisms.ui.table.th label="Contact Number" style="width:14em" />
                        <x-organisms.ui.table.th label="Date Created" order-by="created_at" style="width:14em" />
                        <x-organisms.ui.table.th-more />
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($appts as $appt)
                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                        @endforeach
                        {{-- @foreach ($appts->where('appt_status', 2) as $appt)
                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                        @endforeach

                        @foreach ($appts->where('appt_status', 3) as $appt)
                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                        @endforeach

                        @foreach ($appts->where('appt_status', 4) as $appt)
                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                        @endforeach

                        @foreach ($appts->where('appt_status', 6) as $appt)
                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                        @endforeach

                        @foreach ($appts->where('appt_status', 5) as $appt)
                            @include('livewire.components.organisms.pagecontents.appointments-content.appointment-list')
                        @endforeach --}}
                    </x-slot>
                </x-organisms.ui.table>
                {{ $appts->links('livewire.components.paginator') }}
            @else
                <x-atoms.ui.message icon="frown open" class="mt_20" header="No Appointments yet."
                    message="This section will contain all appointments." />
            @endif
        @endif

    @endsection

</x-layout.page-content>

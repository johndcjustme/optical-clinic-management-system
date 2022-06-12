<tr class="{{ $appt->appt_date < date('Y-m-d') ? 'error' : '' }}">
    <x-organisms.ui.table.td
        checkbox="selectedAppts" 
        checkbox-value="{{ $appt->id }}"/>
    <x-organisms.ui.table.td style="padding: 0">
        @if ($appt->appt_date < date('Y-m-d'))
            <span data-inverted="" data-tooltip="Over due" data-position="top left" data-variation="small">
                <i class="icon attention red"></i>
            </span>
        @endif
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td>
        <x-organisms.ui.dropdown class="dropdown-right">
            <x-organisms.ui.dropdown.dropdown-label>
                <i class="fa-solid fa-circle mr-2" style="color: {{ $appt->appointment_category->color }}"></i>
                {{ $appt->appointment_category->title }}
                <i class="fa-solid fa-caret-down"></i>
            </x-organisms.ui.dropdown.dropdown-label>
            <x-organisms.ui.dropdown.dropdown-content class="mr-2" style="height: 30em; overflow-y:auto">
                <li class="menu-title"><span>Update Status</span></li>
                @foreach (App\Models\Appointment_category::select(['id', 'color', 'title'])->get() as $ac)
                    <li wire:click.prevent="updateApptStatus('{{ $ac->id }}', '{{ $appt->id }}')" class="{{ $ac->id == $appt->appointment_category_id ? 'disabled' : '' }}" @if ($ac->id == $appt->appointment_category_id) style="pointer-events:none;" @endif>
                        <a>
                            <i class="fa-solid fa-circle mr-2" style="color: {{ $ac->color }}"></i>
                            {{ $ac->title }}
                        </a>
                    </li>
                @endforeach
            </x-organisms.ui.dropdown.dropdown-content>
        </x-organisms.ui.dropdown.dropdown-content>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td
        text="{{ humanReadableDate($appt->appt_date) }}"
        desc="{{ humanReadableDay($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . humanReadableTime($appt->appt_time) : '' }}"/>
    <x-organisms.ui.table.td>
        <div class="tooltip" data-tip="{{ $this->hasPayment($appt->id) }}">
            <x-atoms.ui.button wire:click.prevent="apptShowModal('payment_photo', {{ $appt->id }})" class="btn-circle btn-sm"><i class="fa-solid fa-image"></i></x-atoms.ui.button>
        </div>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td 
        text="{{ Str::title($appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname) }}"
        desc="{{ isset($appt->patient->patient_address) ? Str::title($appt->patient->patient_address) : '' }}"
        desc-icon="{{ isset($appt->patient->patient_address) ? 'fa-location-dot' : ''; }}"
        avatar="{{ avatar($appt->patient->patient_avatar) }}"/>
    <x-organisms.ui.table.td
        text="{{ $appt->patient->patient_mobile }}"
        text-icon=" {{ !empty($appt->patient->patient_mobile) ? 'fa-square-phone' : ''; }}"/>
    <x-organisms.ui.table.td
        desc="{{ humanReadableDate($appt->created_at) }}"/>
    <x-organisms.ui.table.td-more style="width: 1em">
        <x-atom.more.option 
            wire-click="apptShowModal('isUpdate', {{ $appt->id }})" 
            option-name="Edit" />
        <x-atom.more.option 
            wire-click="deletingAppt({{ $appt->id }})" 
            option-name="Delete"/>
        <div class="ui divider"></div>
        {{-- <x-atom.more.option 
            wire-click="approvingAppt({{ $appt->id }})" 
            option-name="Approve" class="{{ $this->moreOption_disableApprove($appt->id) ? 'disabled' : '' }}"/>
        <x-atom.more.option 
            wire-click="cancelingAppt({{ $appt->id }})" 
            option-name="Cancel" class="{{ $this->moreOption_disableCancel($appt->id) ? 'disabled' : '' }}"/> --}}
        <x-atom.more.option 
            wire-click="apptShowModal('isUpdate', {{ $appt->id }})" 
            option-name="Reschedule"/>
    </x-organisms.ui.table.td>
</tr>



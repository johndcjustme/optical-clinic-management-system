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
        <div class="ui dropdown">
            <div class="ui {{ $appt->appointment_category->cname }} empty circular label" style="margin-right: 0.5em"></div>
            <small>{{ $appt->appointment_category->title }}</small>
            <div class="menu">
                <div class="scrolling menu">
                    <div class="header">
                        <i class="pen icon"></i>
                        Update Status
                    </div>
                    <div class="ui divider"></div>
                    @foreach (App\Models\Appointment_category::all() as $ac)
                        <div wire:click.prevent="updateStatus('{{ $ac->id }}', '{{ $appt->id }}')" class="item {{ $ac->id == $appt->appointment_category_id ? 'disabled' : '' }}">
                            <div class="ui {{ $ac->cname }} empty circular label"></div>
                            {{ $ac->title }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td
        text="{{ humanReadableDate($appt->appt_date) }}"
        desc="{{ humanReadableDay($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . humanReadableTime($appt->appt_time) : '' }}"/>
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
        <x-atom.more.option 
            wire-click="approvingAppt({{ $appt->id }})" 
            option-name="Approve" class="{{ $this->moreOption_disableApprove($appt->id) ? 'disabled' : '' }}"/>
        <x-atom.more.option 
            wire-click="cancelingAppt({{ $appt->id }})" 
            option-name="Cancel" class="{{ $this->moreOption_disableCancel($appt->id) ? 'disabled' : '' }}"/>
        <x-atom.more.option 
            wire-click="apptShowModal('isUpdate', {{ $appt->id }})" 
            option-name="Reschedule"/>
    </x-organisms.ui.table.td>
</tr>



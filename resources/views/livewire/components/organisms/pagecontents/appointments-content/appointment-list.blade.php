

<tr class="{{ $appt->appt_status == 4 ? 'negative' : ''; }}">
    <x-organisms.ui.table.td
        checkbox="selectedAppts" 
        checkbox-value="{{ $appt->id }}"/>
    <x-organisms.ui.table.td
        text="{{ $this->date($appt->appt_date) }}"
        desc="{{ $this->day($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . $this->time($appt->appt_time) : '' }}"/>
    <x-organisms.ui.table.td>
        <p style="color:{{ $this->statusColor($appt->appt_status) }}">
            @if ($appt->appt_status == 4)
                <i class="attention icon"></i>
            @endif
            {{ $this->apptStatus($appt->appt_status) }}
        </p>
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td 
        text="{{ $appt->patient->patient_lname . ', ' . $appt->patient->patient_fname . ' ' . $appt->patient->patient_mname }}"
        desc="{{ isset($appt->patient->patient_address) ? $appt->patient->patient_address : ''; }}"
        desc-icon="{{ isset($appt->patient->patient_address) ? 'fa-location-dot' : ''; }}"
        avatar="{{ $this->storage($appt->patient->patient_avatar) }}"/>
    <x-organisms.ui.table.td
        text="{{ $appt->patient->patient_mobile }}"
        text-icon=" {{ !empty($appt->patient->patient_mobile) ? 'fa-square-phone' : ''; }}"/>
    <x-organisms.ui.table.td
        desc="{{ $this->date($appt->created_at) . ' @ ' . $this->time($appt->created_at) }}"/>
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



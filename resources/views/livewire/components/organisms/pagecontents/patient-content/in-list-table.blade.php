<tr>
    <x-organisms.ui.table.td 
        checkbox="selectedPatients" 
        checkbox-value="{{ $pt->id }}"
        style="width: 3em"/>
    <x-organisms.ui.table.td style="width:8em">
        <div class="flex flex_y_center full_w" style="gap:0.8em">
            <div>
                <div wire:click.prevent="patientShowModal('isExam', {{ $pt->id }})" class="clickable_icon">
                    <span class="ui text teal">
                        <i class="fa-solid fa-pen"></i>
                    </span>
                </div>
            </div>
            <div wire:click.prevent="patientShowModal('isPurchase', {{ $pt->id }})">
                <div class="clickable_icon">
                    <span class="ui text blue">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                </div>
            </div>
        </div>  
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td style="width:11em">
        @if ($pt->patient_exam_status == true)
            <x-atoms.ui.button wire:click.prevent="doneExam({{ $pt->id }})" class="mini basic">
                Done Exam
            </x-atoms.ui.button>
        @else
            <x-atoms.ui.button wire:click.prevent="revertExam({{ $pt->id }})" class="mini basic">
                Revert
            </x-atoms.ui.button>
        @endif
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td 
        text="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}}"
        desc="{{ isset($pt->patient_address) ? $pt->patient_address : ''; }}"
        desc-icon="{{ isset($pt->patient_address) ? 'fa-location-dot' : ''; }}"
        avatar="{{ $this->storage($pt->patient_avatar) }}"/>
    <x-organisms.ui.table.td text="Scheduled" style="width:15em"/>
    <x-organisms.ui.table.td-more style="width: 3em">
        <x-atom.more.option
            wire-click="patientShowModal('isUpdate', {{ $pt->id }})"
            option-name="Edit" />
        <x-atom.more.option 
            wire-click="deletingSupplier({{ $pt->id }})"
            option-name="Delete" />
        <x-atom.more.option 
            wire-click="history(1, {{ $pt->id }})"
            option-name="Exam History" />
        <x-atom.more.option 
            wire-click="history(2, {{ $pt->id }})"
            option-name="Purchase History" />
        <x-atom.more.option 
            wire-click="removeFromQueue({{ $pt->id}})"
            option-name="Remove from exam list" />
    </x-organisms.ui.table.td>
</tr>
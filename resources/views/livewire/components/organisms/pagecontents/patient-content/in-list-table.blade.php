<tr>
    {{-- <x-organisms.ui.table.td 
        checkbox="selectedPatients" 
        checkbox-value="{{ $pt->id }}"
        style="width: 3em"/> --}}
    <x-organisms.ui.table.td class="" style="width:8em">
        <div class="flex justify-end" style="gap:1em">
            <div class="tooltip" data-tip="Exam" style="z-index:100">
                <x-atoms.ui.button wire:click.prevent="patientShowModal('exam', {{ $pt->id }})" class="btn-sm btn-circle btn-ghost">
                    <i class="text-blue-500 fa-solid fa-pen"></i>
                </x-atoms.ui.button>
            </div>


            @if (! $pt->patient_exam_status)
                <div class="tooltip" data-tip="Purchase" style="z-index:100">
                    <x-atoms.ui.button  -atoms.ui.button wire:click.prevent="patientShowModal('purchase', {{ $pt->id }})" class="btn-sm btn-circle btn-ghost">
                        <i class="text-blue-500 fa-solid fa-cart-shopping"></i>
                    </x-atoms.ui.button>
                </div>
            @endif

        </div>  
    </x-organisms.ui.table.td>
    <x-organisms.ui.table.td class="text-center" style="width:15em">
        @if ($pt->patient_exam_status == true)
            <x-atoms.ui.button wire:click.prevent="doneExam({{ $pt->id }})" class="btn-sm btn-outline btn-primary">
                Done Exam
            </x-atoms.ui.button>
        @else
            @if ($this->isBooked($pt->id)) 
                <x-atoms.ui.button wire:click.prevent="apptCompleted({{ $pt->id }})" class="btn-sm btn-outline btn-success">
                    Completed
                </x-atoms.ui.button>
            @else
                <x-atoms.ui.button wire:click.prevent="removeFromQueue({{ $pt->id }})" class="btn-sm btn-outline btn-primary">
                    Done Payment
                </x-atoms.ui.button>
            @endif
        @endif
    </x-organisms.ui.table.td>
    
    <x-organisms.ui.table.td 
        text="{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}}"
        desc="{{ isset($pt->patient_address) ? $pt->patient_address : ''; }}"
        desc-icon="{{ isset($pt->patient_address) ? 'fa-location-dot' : ''; }}"
        avatar="{{ $this->storage($pt->patient_avatar) }}"/>
    <x-organisms.ui.table.td text="{{ $this->isScheduled($pt->id) }}" style="width:15em"/>

    <x-organisms.ui.table.td style="width: 9em;">
        {{-- @if ($pt->patient_exam_status == false)
            <div class="tooltip" data-tip="Back to exam list">
                <x-atoms.ui.button wire:click.prevent="revertExam({{ $pt->id }})" class="btn-sm btn-primary btn-circle">
                    <i class="fa-solid fa-arrow-up"></i>
                </x-atoms.ui.button>
            </div>
        @endif --}}
    </x-organisms.ui.table.td>

    <x-organisms.ui.table.td style="width: 9em;">
        @if ($this->isBooked($pt->id)) 
            <span class="badge badge-sm badge-info">Booked</span>
        @endif
    </x-organisms.ui.table.td>

    <x-organisms.ui.table.td-more style="width:3em">
        <x-atom.more.option
            wire-click="patientShowModal('isUpdate', {{ $pt->id }})"
            option-name="Edit" />
        <x-atom.more.option 
            wire-click="deletingPatient({{ $pt->id }})"
            option-name="Delete" />
        <div class="divider mt-1 mb-1"></div>
        <x-atom.more.option 
            wire-click="removeFromQueue({{ $pt->id}})"
            option-name="Move to patient list" />
    </x-organisms.ui.table.td>
</tr>
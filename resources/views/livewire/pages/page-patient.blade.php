    {{-- Because she competes with no one, no one can compete with her. --}}


{{-- active page  --}}
@section('patients', 'active')
{{-- current page --}}
@section('pageTitle', 'Patients')


<div class="flex flex_x_between full_w main_content_inner overflow_hidden relative">

        {{-- modal    --}}
    @if($modalPatientShow)
        @includeIf('livewire.components.organisms.modal.modal-patient')
    @endif

    @if ($viewPatientProfile)
        @includeIf('livewire.components.organisms.forms.patient-profile')
    @else
        <div class="full_w full_h flex flex_center">
            <center>
                <i class="fas fa-sad-tear" style="font-size: 2rem"></i><br><br>
                <span>Looks like no patient is selected</span>
            </center>
        </div>
    @endif
    
    @includeIf('livewire.components.organisms.forms.patient-list')                   

    @if(session()->has('message'))
        <x-alert type="error" message="{{ session('message') }}" />
    @endif
</div>






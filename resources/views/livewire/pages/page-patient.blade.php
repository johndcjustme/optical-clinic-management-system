    {{-- Because she competes with no one, no one can compete with her. --}}


{{-- active page  --}}
@section('patients', 'active')
{{-- current page --}}
@section('pageTitle', 'Patients')


<x-layout.main-page>

    <div class="full_w main_content_inner overflow_y_scroll">
        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.patient-content')      
        </div>

        @if ($modal['show'])
            @include('livewire.components.organisms.modal.modal-patient');
        @endif

        {{-- <x-alert type="error" message="{{ session('message') }}" /> --}}

        <x-organisms.ui.confirm-dialog 
            wire-confirm="confirm"
            content="Confirm Delete?"
        />

    </div>


</x-layout.main-page>
        {{-- modal    --}}
    {{-- @if($modalPatientShow)
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
    
    @includeIf('livewire.components.organisms.forms.patient-list')                    --}}

    









    
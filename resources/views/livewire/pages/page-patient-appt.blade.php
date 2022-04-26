    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('patientAppt', 'active')
{{-- current page --}}
@section('pageTitle', 'Book')

<x-layout.main-page>

    <div class="full_w main_content_inner overflow">

        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.patient-appt-content')      
        </div>

        {{-- @if ($apptShowModal)
            @include('livewire.components.organisms.modal.modal-appointment');
        @endif --}}


        <x-organisms.ui.confirm-dialog wire-confirm="confirm"/>
    {{-- <x-alert type="error" message="{{ session('message') }}" /> --}}

    </div>

</x-layout.main-page>
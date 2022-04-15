    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('appointments', 'active')
{{-- current page --}}
{{-- @section('pageTitle', 'Appointment') --}}
<x-layout.main-page>
    <div class="full_w main_content_inner overflow_y_scroll">
    
        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.appointments-content')      
        </div>

        @if ($modal['show'])
            @include('livewire.components.organisms.modal.modal-appointment')
        @endif

        <x-alert type="error" message="{{ session('message') }}" />

        <x-organisms.ui.confirm-dialog 
            wire-confirm="confirm"
            content="{{ $confirmationMessage }}"
        />
    
    </div>

    

</x-layout.main-page>

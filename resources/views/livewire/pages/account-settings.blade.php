    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
{{-- @section('appointments', 'active') --}}
{{-- current page --}}
{{-- @section('pageTitle', 'Appointment') --}}
<x-layout.main-page>

    <div class="full_w main_content_inner overflow">
    
        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.account-settings-content')      
        </div>

        {{-- <x-alert type="error" message="{{ session('message') }}" /> --}}

        <x-organisms.ui.confirm-dialog wire-confirm="confirm"/>
    
    </div>

</x-layout.main-page>

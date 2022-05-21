    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('ledger', 'active')
{{-- current page --}}
{{-- @section('pageTitle', 'Inventory') --}}


<x-layout.main-page>

    <div class="full_w main_content_inner overflow_y_scroll">

        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.ledger-content')      
        </div>

        @if ($modal['show'])
            @include('livewire.components.organisms.modal.modal-ledger')
        @endif

        {{-- @if ($modal['show_image'])
            @include('livewire.components.organisms.modal.modal-inventory-image')
        @endif --}}

        <x-alert type="error" message="{{ session('message') }}" />

        <x-organisms.ui.confirm-dialog wire-confirm="confirm"/>
    </div>

</x-layout.main-page>




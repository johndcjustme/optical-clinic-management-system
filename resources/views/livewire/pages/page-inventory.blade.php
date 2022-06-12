    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('inventory', 'active')
{{-- current page --}}
{{-- @section('pageTitle', 'Inventory') --}}


<x-layout.main-page>

    {{-- <div class="full_w main_content_inner overflow_y_scroll"> --}}

        {{-- <div class="inner_content"> --}}
            @include('livewire.components.organisms.pagecontents.inventory-content')      
        {{-- </div> --}}

        @if ($modal['show'])
            @include('livewire.components.organisms.modal.modal-inventory')
        @endif

        @if ($modal['show_image'])
            @include('livewire.components.organisms.modal.modal-inventory-image')
        @endif

        <x-organisms.ui.confirm-dialog wire-confirm="confirm"/>
        
        <x-alert type="error" message="{{ session('message') }}" />
    {{-- </div> --}}

</x-layout.main-page>




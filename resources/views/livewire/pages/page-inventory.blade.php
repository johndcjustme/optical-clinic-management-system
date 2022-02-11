    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('inventory', 'active')
{{-- current page --}}
{{-- @section('pageTitle', 'Inventory') --}}




    <div class="full_w main_content_inner overflow_scroll">

        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.inventory-content')      
        </div>

        @if ($this->inventoryShowModal)
            @includeIf('livewire.components.organisms.modal.modal-inventory');
        @endif

        <x-alert type="error" message="{{ session('message') }}" />

    </div>
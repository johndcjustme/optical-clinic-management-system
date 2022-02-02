    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('inventory', 'active')
{{-- current page --}}
@section('pageTitle', 'Inventory')




    <div class="flex full_w main_content_inner overflow_hidden">

        @include('livewire.components.organisms.table.inventory-tables')
       
        @if ($this->inventoryShowModal)

           @includeIf('livewire.components.organisms.modal.modal-inventory');

        @endif

    </div>
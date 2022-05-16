    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('forum', 'active')
{{-- current page --}}
{{-- @section('pageTitle', 'Inventory') --}}


<x-layout.main-page>

    <div class="full_w main_content_inner overflow_y_scroll">

        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.forum-content')      
        </div>

        {{-- @if ($modal['show']) --}}
        {{-- @includeIf('livewire.components.organisms.modal.modal-inventory') --}}
        {{-- @endif --}}
        @if ($viewPhoto)
            @include('livewire.components.organisms.modal.modal-forum-image')
        @endif


        <x-alert type="error" message="{{ session('message') }}" />

        <x-organisms.ui.confirm-dialog 
            wire-confirm="confirm"
            content="Confirm Delete?"
        />
    </div>

</x-layout.main-page>




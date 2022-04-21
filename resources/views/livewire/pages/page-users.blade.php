
{{-- active page  --}}
@section('users', 'active')
{{-- current page --}}
@section('pageTitle', 'Users')


<x-layout.main-page>

    <div class="full_w main_content_inner overflow_scroll">
        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.user-content')      
        </div>

        @if ($modal['show'])
            @includeIf('livewire.components.organisms.modal.modal-user');
        @endif

        {{-- <x-alert type="error" message="{{ session('message') }}" /> --}}

        <x-organisms.ui.confirm-dialog 
            wire-confirm="confirm"
            content="Confirm Delete?"
        />


    </div>


</x-layout.main-page>
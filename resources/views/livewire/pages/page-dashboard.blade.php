    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('dashboard', 'active')
{{-- current page --}}
@section('pageTitle', 'Dashboard')

<x-layout.main-page>

    <div class="full_w main_content_inner overflow_scroll">

        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.dashboard-content')      
        </div>

    </div>
    
</x-layout.main-page>
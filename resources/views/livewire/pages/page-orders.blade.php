    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('orders', 'active')
{{-- current page --}}
@section('pageTitle', 'Orders')

<x-layout.main-page>

    <div class="full_w main_content_inner overflow">

        <div class="inner_content">
            @include('livewire.components.organisms.pagecontents.orders-content')      
        </div>

    </div>

</x-layout.main-page>
    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('patients', 'active')
{{-- current page --}}
@section('pageTitle', 'Patients')



{{-- main page div  --}}
<div class="flex full_vh overflow_hidden relative">
        {{-- sidenav  --}}
        @includeIf('livewire.components.organisms.layouts.sidenav')
        <section class="full_vh full_w">
                {{-- top bar  --}}
                @includeIf('livewire.components.organisms.layouts.topbar')
                {{-- main content --}}
                <div class="main_content">

                    <div class="flex flex_x_between full_w main_content_inner overflow_hidden">

                         {{-- modal    --}}
                        @if($modalPatientShow)
                            @includeIf('livewire.components.organisms.modal.modal-patient')
                        @endif


                        @if ($viewPatientProfile)
                            @includeIf('livewire.components.organisms.forms.patient-profile')
                        @else
                            <center>select patient</center>
                        @endif
                        
                        @includeIf('livewire.components.organisms.forms.patient-list')                   


                    </div>
                </div>
        </section>

        @if(session()->has('message'))
            <div class="alert mr_20 mb_20 absolute bottom right">{{ session('message') }} <i class="fas fa-close ml_3"></i></div>
        @endif
</div>
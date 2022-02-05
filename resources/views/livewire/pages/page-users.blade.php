    {{-- Because she competes with no one, no one can compete with her. --}}


    
{{-- active page  --}}
@section('users', 'active')
{{-- current page --}}
@section('pageTitle', 'Users')


    <div class="flex full_w main_content_inner overflow_hidden">
        <div class="overflow full_w">
            <div>

                <div class="p_15">
                    <div class="mb_10"><h3>Admin</h3></div>
                    <div class="grid card_profile gap_1">
                        @includeIf('livewire.components.organisms.layouts.user-profile')
                        @includeIf('livewire.components.organisms.layouts.user-profile')
                    </div>
                </div>
                <div class="p_15">
                    <div class="mb_10"><h3>Staff</h3></div>
                    <div class="grid card_profile gap_1">
                        @includeIf('livewire.components.organisms.layouts.user-profile')
                        @includeIf('livewire.components.organisms.layouts.user-profile')
                        @includeIf('livewire.components.organisms.layouts.user-profile')
                    </div>
                </div>

            </div>
        </div>



        {{-- // modal  --}}
        {{-- @includeIf('livewire.components.organisms.modal.modal-user') --}}

    </div>

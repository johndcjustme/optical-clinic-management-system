@php
    if ($modal['isAddUser']) {
        $wireSubmitTo = 'addUser';
        $label = 'Add User';
        $formId = 'addUser';
    }
    if ($modal['isUpdateUser']) {
        $wireSubmitTo = 'updateUser';
        $label = 'Update User';
        $formId = 'updateUser';
    }
@endphp


<x-organisms.modal>

    @section('modal_title')
        <div class="full_w flex flex_x_between">
            <div></div>
            <div>
                <x-atom.btn-close-modal wire-click="userCloseModal"/>  
                <x-atom.btn-save-modal form="{{ $formId }}" val="{{ $label }}"/>  
            </div>
        </div>
    @endsection
    
    @section('modal_body')
        <form wire:submit.prevent="{{ $wireSubmitTo }}" id="{{ $formId }}">
            <input wire:model='user.id' type="hidden" name="">
                <div class="flex flex_y_center gap_1">
                    <div>                        
                        @if ($avatar)
                            <x-atom.profile-photo size="75px" path="">
                                <div class="full_h full_w" style="background: #fff">
                                    <img src="{{ $avatar->temporaryUrl() }}" height="100%" width="auto">
                                </div>
                            </x-atom.profile-photo>
                        @else
                            <x-atom.profile-photo size="75px" path="images/john-profile2.png"/>
                        @endif
                    </div>
                    <div>
                        <input wire:model="user.avatar" type="file" name="" id="">
                    </div>
                </div>
                <br><br>
            <fieldset>
                <legend>User details</legend><br>
                <div class="grid grid_col_2 gap_1">
                    <div>
                        <label for="">User name</label>
                        <input wire:model.defer="user.name" type="text">
                        <label for="">Email Address</label>
                        <input wire:model.defer="user.email" type="email" required>
                    </div>
                    <div>
                        <label for="">Password</label>
                        <input wire:model.defer="user.password" type="password" name="" id="" placeholder="Minimum of 6 characters">
                        <label for="">Confirm Password</label>
                        <input wire:model.defer="user.password_confirm" type="password" name="" id="">
                        @if (session()->has('errorPass'))
                            {{ session('errorPass') }}
                        @endif
                    </div>
                </div>
                
            </fieldset>
            <br>
            <fieldset>
                <legend>Role</legend><br>
                <select wire:model.defer="user.role" name="" id="" required>
                    <option value="" selected hidden>--select--</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </fieldset>
        </form>
    @endsection

</x-organisms.modal>
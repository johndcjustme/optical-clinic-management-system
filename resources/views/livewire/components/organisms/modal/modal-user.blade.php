@php
    if ($isAddUser) {
        $wireSubmitTo = 'addUser';
        $label = 'Add User';
        $formId = 'addUser';
    }
    if ($isUpdateUser) {
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
            <fieldset>
                <legend>User details</legend>
                <div class="grid grid_col_2 gap_1">
                    <div>
                        <label for="">User name</label>
                        <input type="text">
                        <label for="">User Email</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="">Password</label>
                        <input type="password" name="" id="">
                        <label for="">Confirm Password</label>
                        <input type="password" name="" id="">
                    </div>
                </div>
                
            </fieldset>
            <br>
            <fieldset>
                <legend>Role</legend>
                <select name="" id="">
                    <option value="" selected hidden>--select--</option>
                    <option value="">Staff</option>
                    <option value="">Admin</option>
                </select>
            </fieldset>
        </form>
    @endsection

</x-organisms.modal>
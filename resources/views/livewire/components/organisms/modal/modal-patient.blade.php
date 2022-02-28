@php
    if ($isAddPatient) {
        $wireSubmitTo = 'addUser';
        $label = 'Add Patient';
        $formId = 'addPatient';
    }
    if ($isUpdatePatient) {
        $wireSubmitTo = 'updateUser';
        $label = 'Update Patient';
        $formId = 'updatePatient';
    }
@endphp


<x-organisms.modal>

    @section('modal_title')
        <div class="full_w flex flex_x_between">
            <div></div>
            <div>
                <x-atom.btn-close-modal wire-click="closeModal"/>  
                <x-atom.btn-save-modal form="{{ $formId }}" val="{{ $label }}"/>  
            </div>
        </div>
    @endsection

    @section('modal_body')
        <form wire:submit.prevent="{{ $wireSubmitTo }}" id="{{ $formId }}">
            <fieldset>
                <legend>Select Photo</legend>
                <div class="flex gap_1 flex_y_center">
                    <div>
                        <x-atom.profile-photo size="5em" path="images/john-profile2.png" />
                    </div>
                    <div>
                        <input type="file" name="" id="">
                    </div>
                </div>
            </fieldset>
            <br>
            <fieldset>
                <legend>Patient Details</legend>
                <br>
                <div class="grid grid_col_2 gap_1">
                    <div>
                        <label for="">First Name</label>
                        <input type="text">
                        <label for="">Last Name</label>
                        <input type="text">
                        <label for="">M.I.</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="">Gender</label>
                        <select name="" id="">
                            <option value="" selected>--None--</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        <label for="">Occupation</label>
                        <input type="text" name="" id="">
                        <label for="">Address</label>
                        <input type="text" name="" id="">
                    </div>
                </div>
                
            </fieldset>
            <br>
            <fieldset>
                <legend>Contact Information</legend>
                <br>
                <div class="grid grid_col_2 gap_1">
                    <div>
                        <label for="">Contact Number</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="">Email Address</label>
                        <input type="text">
                    </div>
                </div>
            </fieldset>
        </form>
    @endsection

</x-organisms.modal>

{{-- @include('livewire.components.organisms.modal.modal-include-top')

    @if ($modalPatientUpdate)
        @include('livewire.components.molecules.modal.modal-patient-update')
    @endif

    @if ($modalPatientAdd)
        @include('livewire.components.molecules.modal.modal-patient-add')
    @endif

@include('livewire.components.organisms.modal.modal-include-bottom') --}}
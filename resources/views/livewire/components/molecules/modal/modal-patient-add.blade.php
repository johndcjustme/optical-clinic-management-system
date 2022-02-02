<form wire:submit.prevent="addPatient">

    <div class="text_right">
        @includeIf('livewire.components.atoms.btn-patient-modal-close')
        <button type="submit" class="ml_3">Add Patient</button>
    </div>

    <br>

    <fieldset>
        <legend>Select Photo</legend><br>
        <input type="file" name="" id=""><br>   
    </fieldset>

    <br>

    <fieldset>
        <legend>Perosnal Information</legend><br>
        <div class="grid grid_col_2 gap_1">
            <div>
                <label for="">First Name</label>
                <input type="text" name="new_patient_fname" wire:model="new_patient_fname">
                @error('new_patient_fname') <span>{{ $message }}</span> @enderror <br>
                <label for="">Last Name</label>
                <input type="text" wire:model="new_patient_lname">
                @error('new_patient_lname') <span>{{ $message }}</span> @enderror <br>
                <label for="">Middle Name</label>
                <input type="text" wire:model="new_patient_mname">
                <label for="">Age</label>
                <input type="number" min="0" wire:model="new_patient_age">
            </div>
            <div>
                <label for="">Gender</label>
                <select wire:model="new_patient_gender">
                    <option selected>Male</option>
                    <option>Female</option>
                </select>
                <label for="">Occupation</label>
                <input type="text" wire:model="new_patient_occupation">
                <label for="">Address</label>
                <input type="text" wire:model="new_patient_address">
            </div>
        </div>
    </fieldset>

    <br>

    <fieldset>
        <legend>Contact Information</legend><br>

        <div class="grid grid_col_2 gap_1">
            <div>
                <label for="">Email</label>
                <input type="email" wire:model="new_patient_email">
            </div>
            <div>
                <label for="">Mobile number</label>
                <input type="number" min="0" wire:model="new_patient_mobile">
            </div>
        </div>
    </fieldset>

  
</form>
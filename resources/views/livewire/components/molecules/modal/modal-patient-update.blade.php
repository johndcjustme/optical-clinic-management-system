<form wire:submit.prevent="updatePatient({{ $this->update_patient_id }})">
    <div class="text_right">
        @includeIf('livewire.components.atoms.btn-patient-modal-close')
        <button class="ml_3">Save changes</button>
    </div>

    <br>

    <fieldset>
        <legend>Select Photo</legend>
        <br>
        <input type="file" name="" id="">
    </fieldset>

    <br>

    <fieldset>
        <legend>Personal Information</legend>
        <br>

        <div class="grid grid_col_2 gap_1">
            <div>
                <label for="">First Name</label>
                <input type="text" wire:model="update_patient_fname">
                @error('patient_fname') <span>{{ $message }}</span> @enderror <br>
                <label for="">Last Name</label>
                <input type="text" wire:model="update_patient_lname">
                @error('patient_lname') <span>{{ $message }}</span> @enderror <br> 
                <label for="">Middle Name</label>
                <input type="text" wire:model="update_patient_mname">
                <label for="">Age</label>
                <input type="number" min="0" wire:model="update_patient_age">
            </div>
            <div>  
                <label for="">Gender</label>
                <select name="" id="" wire:model="update_patient_gender">
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <label for="">Occupation</label>
                <input type="text" wire:model="update_patient_occupation">
                <label for="">Address</label>
                <input type="text" wire:model="update_patient_address">
            </div>
        </div>
    </fieldset>
  
    <br>

    <fieldset>
        <legend>Contact Information</legend>
        <br>

        <div class="grid grid_col_2 gap_1">
            <div>
                <label for="">Email</label>
                <input type="email" wire:model="update_patient_email">
            </div>
            <div>
                <label for="">Mobile number</label>
                <input type="number" min="0" wire:model="update_patient_mobile">
            </div>
        </div> 
    </fieldset>
</form>
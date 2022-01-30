{{-- put to modals  --}}
<div id="1" class="modal" style="display: block">
    <div class="modal_content" style="margin-bottom: 100px;">
        <div class="card">
            @if ($modalPatientUpdate)
                {{-- <h3>Edit Patient</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam amet voluptate sunt voluptatum beatae. At enim cumque numquam porro quidem.</p>
                <br><br> --}}
                @include('livewire.components.molecules.modal.modal-patient-update')
            @endif

            @if ($modalPatientAdd)
                {{-- <h3>Add Patient</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam amet voluptate sunt voluptatum beatae. At enim cumque numquam porro quidem.</p>
                <br><br> --}}
                @include('livewire.components.molecules.modal.modal-patient-add')
            @endif
            
        </div>
    </div>
</div>
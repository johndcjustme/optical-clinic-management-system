@includeIf('livewire.components.organisms.modal.modal-include-top')

    <button wire:click.prevent="inventoryShowModal('xxx')">Close modal</button>

    @if ($this->addLens)
        @includeIf('livewire.components.molecules.modal.modal-inventory-addlens')
    @elseif ($this->addFrame)
        @includeIf('livewire.components.molecules.modal.modal-inventory-addframe')
    @elseif ($this->addAccessory)
        @includeIf('livewire.components.molecules.modal.modal-inventory-addaccessory')
    @elseif ($this->addSupplier)
        @includeIf('livewire.components.molecules.modal.modal-inventory-addsupplier')
    @endif


@includeIf('livewire.components.organisms.modal.modal-include-bottom')
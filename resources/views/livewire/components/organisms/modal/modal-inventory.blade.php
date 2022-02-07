@includeIf('livewire.components.organisms.modal.modal-include-top')

    <div class="flex flex_x_between flex_y_center">
        <div></div>
        <div>
            <button class="mr_5" wire:click.prevent="inventoryShowModal('xxx')">Cancel</button>

            @if ($this->isAddItem)

                @if ($this->addLens)        
                    <label class="button" for="submitLens">save lens</label>
                @elseif ($this->addFrame)
                    <label class="button" for="submitFrame">save frame</label>
                @elseif ($this->addAccessory)
                    <label class="button" for="submitAccessory">save Accessory</label>
                @elseif ($this->addSupplier)
                    <label class="button" for="submitSupplier">save Supplier</label>
                @endif

            @elseif ($this->isUpdateItem)

                @if ($this->updateLens)        
                    <label class="button" for="updateLens">update lens</label>
                @elseif ($this->updateFrame)
                    <label class="button" for="updateFrame">update frame</label>
                @elseif ($this->updateAccessory)
                    <label class="button" for="updateAccessory">update Accessory</label>
                @elseif ($this->updateSupplier)
                    <label class="button" for="updateSupplier">update Supplier</label>
                @endif

            @endif
        </div>
    </div>

    <br>

    @if($this->isAddItem)

        @if ($this->addLens)
            <form wire:submit.prevent="addInventory('le')">
                <fieldset>
                    <legend>Add Photo</legend><br>
                    <input type="file" name="" id="">

                </fieldset>

                <br>

                <fieldset>
                    <legend>Lens Details</legend><br>

                    <div class="grid grid_col_2 gap_1">
                        <div>
                            <label for="">Lens Name</label>
                            <input type="text">
                            <label for="">Lens Type</label>
                            <input type="text">
                            <label for="">Lens Tint</label>
                            <input type="text">
                        </div>
                        <div>
                            <label for="">Supplier</label>
                            <input type="text" list="supplier">
                            <datalist id="supplier">
                                <option value="supplier name">Address</option>
                                <option value="supplier name">Address</option>
                                <option value="supplier name">Address</option>
                            </datalist>
                            <label for="">Lens Qty</label>
                            <input type="number">
                            <label for="">Lens Price</label>
                            <input type="number">
                        </div>
                    </div>
                </fieldset>
                <input type="submit" id="submitLens" value="" hidden>
            </form>

        @elseif ($this->addFrame)

            <form action="" wire:submit.prevent="addInventory('fr')">
                <fieldset>
                    <legend>Add Photo</legend><br>
                    <input type="file" name="" id="">

                </fieldset>

                <br>

                <fieldset>
                    <legend>Frame Details</legend><br>

                    <div class="grid grid_col_2 gap_1">
                        <div>
                            <label for="">Frame Name</label>
                            <input type="text">
                            <label for="">Frame Type</label>
                            <input type="text">
                            <label for="">Size</label>
                            <input type="text">
                        </div>
                        <div>
                            <label for="">Supplier</label>
                            <input type="text" list="supplier">
                            <datalist id="supplier">
                                <option value="supplier name">Address</option>
                                <option value="supplier name">Address</option>
                                <option value="supplier name">Address</option>
                            </datalist>
                            <label for="">Frame Qty</label>
                            <input type="number">
                            <label for="">Frame Price</label>
                            <input type="number">
                        </div>
                    </div>
                </fieldset>
                <input id="submitFrame" type="submit" value="" hidden>
            </form>

        @elseif ($this->addAccessory)

            <form action="" wire:submit.prevent="addInventory('ac')">
                <fieldset>
                    <legend>Add Photo</legend><br>
                    <input type="file" name="" id="">

                </fieldset>

                <br>

                <fieldset>
                    <legend>Accessory Details</legend><br>

                    <div class="grid grid_col_2 gap_1">
                        <div>
                            <label for="">Accessory Name</label>
                            <input type="text">
                            <label for="">Accessory Type</label>
                            <input type="text">
                        </div>
                        <div>
                            <label for="">Supplier</label>
                            <input type="text" list="supplier">
                            <datalist id="supplier">
                                <option value="supplier name">Address</option>
                                <option value="supplier name">Address</option>
                                <option value="supplier name">Address</option>
                            </datalist>
                            <label for="">Acessory Qty</label>
                            <input type="number">
                            <label for="">Accessory Price</label>
                            <input type="number">
                        </div>
                    </div>
                </fieldset>
                <input id="submitAccessory" type="submit" value="" hidden>
            </form>

        @elseif ($this->addSupplier)


            <form action="" wire:submit.prevent="addInventory('su')">

                <fieldset>
                    <legend>Add Photo</legend><br>
                    <input type="file" name="" id="">

                </fieldset>

                <br>

                <fieldset>
                    <legend>Supplier Details</legend><br>

                    <div class="grid grid_col_2 gap_1">
                        <div>
                            <label for="">Supplier Name</label>
                            <input wire:model.defer="su_name" type="text" required>
                            <label for="">Contact No.</label>
                            <input wire:model.defer="su_contact" type="number">
                            <label for="">Address</label>
                            <input wire:model.defer="su_address" type="text">
                        </div>
                        <div>
                            <label for="">Bank</label>
                            <input wire:model.defer="su_bank" type="text">
                            <label for="">Account No.</label>
                            <input wire:model.defer="su_acc" type="text">
                            <label for="">Branch</label>
                            <input wire:model.defer="su_branch" type="text">
                        </div>
                    </div>
                </fieldset>
                <input id="submitSupplier" type="submit" value="" hidden>
            </form>

        @endif
    

    @elseif($this->isUpdateItem)

        @if($this->updateLens)        
            update lens
        @elseif($this->updateFrame)
            update frame
        @elseif($this->updateAccessory)

              accessory

        @elseif($this->updateSupplier)   
            
                <form action="" wire:submit.prevent="updateInventory('su', {{ $this->su_id }})">

                    <input type="hidden" wire:model.defer="su_id">

                    <fieldset>
                        <legend>Add Photo</legend><br>
                        <input type="file" name="" id="">

                    </fieldset>

                    <br>

                    <fieldset>
                        <legend>Supplier Details</legend><br>

                        <div class="grid grid_col_2 gap_1">
                            <div>
                                <label for="">Supplier Name</label>
                                <input wire:model.defer="su_name" type="text" required>
                                <label for="">Contact No.</label>
                                <input wire:model.defer="su_contact" type="number">
                                <label for="">Address</label>
                                <input wire:model.defer="su_address" type="text">
                            </div>
                            <div>
                                <label for="">Bank</label>
                                <input wire:model.defer="su_bank" type="text">
                                <label for="">Account No.</label>
                                <input wire:model.defer="su_acc" type="text">
                                <label for="">Branch</label>
                                <input wire:model.defer="su_branch" type="text">
                            </div>
                        </div>
                    </fieldset>
                    <input id="updateSupplier" type="submit" value="Update" hidden>
                </form>
                
        @endif

    @endif

@includeIf('livewire.components.organisms.modal.modal-include-bottom')
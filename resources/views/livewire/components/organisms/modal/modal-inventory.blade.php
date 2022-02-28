{{-- @includeIf('livewire.components.organisms.modal.modal-include-top') --}}
@php
    if ($isAddItem) {
        if ($addLense)      { $formId = 'addLense'; }
        if ($addFrame)      { $formId = 'addFrame'; }
        if ($addAccessory)  { $formId = 'addAccessory'; }
        if ($addSupplier)   { $formId = 'addSupplier'; }
    }
    if ($isUpdateItem) {
        if ($updateLense)      { $formId = 'updateLense'; }
        if ($updateFrame)      { $formId = 'updateFrame'; }
        if ($updateAccessory)  { $formId = 'updateAccessory'; }
        if ($updateSupplier)   { $formId = 'updateSupplier'; }
    }
@endphp

<x-organisms.modal>

    @section('modal_title')

        <div></div>
        <div>
            <x-atom.btn-close-modal wire-click="inventoryCloseModal"/>
            @if ($isAddItem)
                <x-atom.btn-save-modal form="{{ $formId }}" val="save" />  
            @elseif ($isUpdateItem)
                <x-atom.btn-save-modal form="{{ $formId }}" val="update" />  
            @endif
        </div>


    @endsection


    @section('modal_body')

        @if($this->isAddItem)

            @if ($this->addLense)
                <form id="addLense" wire:submit.prevent="addInventory('le')">
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
                                <input wire:model.defer="le_name" type="text" required>
                                <label for="">Lens Type</label>
                                <input wire:model.defer="item_type" type="text">
                                <label for="">Lens Tint</label>
                                <input wire:model.defer="le_tint" type="text">
                            </div>
                            <div>
                     
                                <label for="">Supplier</label>
                                <select wire:model.defer="le_supplier" name="" id="">
                                    <option value="" selected hidden> --select-- </option>
                                    @forelse ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                                <label for="">Lens Description</label>
                                <input wire:model.defer="le_desc" type="text">
                                <label for="">Lens Qty</label>
                                <input wire:model.defer="le_qty" type="number">
                                <label for="">Lens Price</label>
                                <input wire:model.defer="le_price" type="number">
                            </div>
                        </div>
                    </fieldset>
                </form>

            @elseif ($this->addFrame)

                <form id="addFrame" wire:submit.prevent="addInventory('fr')">
                    <fieldset>
                        <legend>Add Photo</legend><br>
                        <input type="file" name="" id="">
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Lens Details</legend><br>

                        <div class="grid grid_col_2 gap_1">
                            <div>
                                <label for="">Frame Name</label>
                                <input wire:model.defer="fr_name" type="text" required>
                                <label for="">Frame Type</label>
                                <input wire:model.defer="item_type" type="text">
                                <label for="">Fram Size</label>
                                <input wire:model.defer="fr_size" type="text">
                            </div>
                            <div>
                                <label for="">Supplier</label>
                                <select wire:model.defer="fr_supplier">
                                    <option value="" selected hidden>--select--</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <label for="">Frame Description</label>
                                <input wire:model.defer="fr_desc" type="text">
                                <label for="">Frame Qty</label>
                                <input wire:model.defer="fr_qty" type="number">
                                <label for="">Frame Price</label>
                                <input wire:model.defer="fr_price" type="number">
                            </div>
                        </div>
                    </fieldset>
                </form>

            @elseif ($this->addAccessory)

                <form id="addAccessory" wire:submit.prevent="addInventory('ac')">
                    <fieldset>
                        <legend>Add Photo</legend><br>
                        <input type="file" name="" id="">
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Acessory Details</legend><br>

                        <div class="grid grid_col_2 gap_1">
                            <div>
                                <label for="">Accessory Name</label>
                                <input wire:model.defer="ac_name" type="text" required>
                                <label for="">Accessory Description</label>
                                <input wire:model.defer="ac_desc" type="text">
                            </div>
                            <div>
                                <label for="">Supplier</label>
                                <select wire:model.defer="ac_supplier">
                                    <option value="" selected hidden>--select--</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <label for="">Qunatiry</label>
                                <input wire:model.defer="ac_qty" type="number">
                                <label for="">Price</label>
                                <input wire:model.defer="ac_price" type="number">
                            </div>
                        </div>
                    </fieldset>
                </form>

            @elseif ($this->addSupplier)

                <form id="addSupplier" wire:submit.prevent="addInventory('su')">

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
                                <input wire:model.defer="su_name" type="text" placeholder="Last name, First name" required>
                                <label for="">Contact No.</label>
                                <input wire:model.defer="su_contact" type="number">
                                <label for="">Address</label>
                                <input wire:model.defer="su_address" type="text">
                                <label for="">Email</label>
                                <input wire:model.defer="su_email" type="text">
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
                </form>

            @endif


        @elseif($this->isUpdateItem)

            @if($this->updateLense)        
                <form id="{{ $formId }}" wire:submit.prevent="updateInventory('le', {{ $this->le_id }})">
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
                                <input wire:model.defer="le_name" type="text">
                                <label for="">Lens Type</label>
                                <input wire:model.defer="item_type" type="text">
                                <label for="">Lens Tint</label>
                                <input wire:model.defer="le_tint" type="text">
                            </div>
                            <div>
                                <label for="">Supplier</label>
                                <select wire:model.defer="le_supplier" name="" id="">
                                    <option value="" selected hidden>--select--</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <label for="">Lens Description</label>
                                <input wire:model.defer="le_desc" type="text">
                                <label for="">Lens Qty</label>
                                <input wire:model.defer="le_qty" type="number">
                                <label for="">Lens Price</label>
                                <input wire:model.defer="le_price" type="number">
                            </div>
                        </div>
                    </fieldset>
                </form>

            @elseif($this->updateFrame)

                <form id="{{ $formId }}" wire:submit.prevent="updateInventory('fr', {{ $this->fr_id }})">
                    <fieldset>
                        <legend>Add Photo</legend><br>
                        <input type="file" name="" id="">
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Lens Details</legend><br>

                        <div class="grid grid_col_2 gap_1">
                            <div>
                                <label for="">Frame Name</label>
                                <input wire:model.defer="fr_name" type="text">
                                <label for="">Frame Type</label>
                                <input wire:model.defer="item_type" type="text">
                                <label for="">Fram Size</label>
                                <input wire:model.defer="fr_size" type="text">
                            </div>
                            <div>
                                <label for="">Supplier</label>
                                <select wire:model.defer="fr_supplier">
                                    <option value="" selected hidden>--select--</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <label for="">Frame Description</label>
                                <input wire:model.defer="fr_desc" type="text">
                                <label for="">Frame Qty</label>
                                <input wire:model.defer="fr_qty" type="number">
                                <label for="">Frame Price</label>
                                <input wire:model.defer="fr_price" type="number">
                            </div>
                        </div>
                    </fieldset>
                </form>

            @elseif($this->updateAccessory)

                <form id="{{ $formId }}" wire:submit.prevent="updateInventory('ac', {{ $this->ac_id }})">
                    <fieldset>
                        <legend>Add Photo</legend><br>
                        <input type="file" name="" id="">
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Acessory Details</legend><br>

                        <div class="grid grid_col_2 gap_1">
                            <div>
                                <label for="">Accessory Name</label>
                                <input wire:model.defer="ac_name" type="text">
                                <label for="">Accessory Description</label>
                                <input wire:model.defer="ac_desc" type="text">
                            </div>
                            <div>
                                <label for="">Supplier</label>
                                <select wire:model.defer="ac_supplier">
                                    <option value="" selected hidden>--select--</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <label for="">Qunatiry</label>
                                <input wire:model.defer="ac_qty" type="number">
                                <label for="">Price</label>
                                <input wire:model.defer="ac_price" type="number">
                            </div>
                        </div>
                    </fieldset>
                </form>

            @elseif($this->updateSupplier)   
                
                    <form id="{{ $formId }}" action="" wire:submit.prevent="updateInventory('su', {{ $this->su_id }})">

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
                                    <label for="">Email</label>
                                    <input wire:model.defer="su_email" type="text">
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
                    </form>
                    
            @endif

        @endif


    @endsection

</x-organisms.modal>

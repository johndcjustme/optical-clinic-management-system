@php
    $formId = '';
    $wireSubmit = '';
    $btnLabel = '';
        
    if ($modal['add']) {
        $wireSubmit = 'addSupplier';
        $formId = $wireSubmit;
    }
    elseif($modal['update']) {
        $formId = 'updateSupplier';
        $wireSubmit = 'updateSupplier(' . $su['id'] . ')';
    }
    
@endphp

<x-organisms.modal>

    @section('modal_title')
        <div>
            <label for="supplier_avatar" class="btn"><i class="fa-solid fa-add mr-2"></i> {{ !empty($su['avatar']) || !empty($previewAvatar) ? 'Change Avatar' : 'Add Avatar'}}</label>
        </div>
        <div>
            <x-atoms.ui.modal-title>
                {{ !empty($su['id']) ? 'UPDATE SUPPLIER' : 'ADD SUPPLIER' }}
            </x-atoms.ui.modal-title>
        </div>
        <div class="">
            <x-atoms.ui.btn-close-modal>Close</x-atoms.ui.btn-close-modal>
            <x-atoms.ui.button class="btn-primary ml-2" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
        </div>
    @endsection

    @section('modal_body')

        <form id="{{ $formId }}" wire:submit.prevent="{{ $wireSubmit }}" class="ui form"><br>

            <x-molecules.ui.field class="justify-items-center">
                <label for="supplier_avatar">
                    @if ($previewAvatar) 
                        <x-atoms.ui.avatar src="{{ $previewAvatar->temporaryUrl() }}" size="5em"/>
                    @else 
                        <x-atoms.ui.avatar src="{{ $this->storage($su['avatar']) }}" size="5em"/>
                    @endif
                    <input wire:model="previewAvatar" type="file" name="" id="supplier_avatar" style="opacity:0; width:0; height:0;" hidden>     
                </label>
                <div>
                    @error('previewAvatar') <br><span class="ui text error">{{ $message }}</span> @enderror
                </div>
            </x-molecules.ui.field>

            <x-molecules.ui.field class="grid-cols-2">
                <div>
                    <x-atoms.ui.label class="">Name <x-atoms.ui.required/> @error('su.name') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="su.name" type="text" class="mb-3" placeholder="Enter name..."/>
                    <x-atoms.ui.label class="">Address</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="su.address" type="text" class="mb-3" placeholder="Enter address..."/>
                    <x-atoms.ui.label class="">Branch</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="su.branch" type="text" class="mb-3" placeholder="Enter branch..."/>
                </div>
                <div>
                    <x-atoms.ui.label class="">Account Name</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="su.bank" type="text" class="mb-3" placeholder="Enter account name..."/>
                    <x-atoms.ui.label class="">Account Number</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="su.acc" type="text" class="mb-3" placeholder="Enter account number..."/>
                </div>
            </x-molecules.ui.field>

            <x-molecules.ui.field class="grid-cols-2">
                    <div>
                        <x-atoms.ui.label class="">Contact No <x-atoms.ui.required/>@error('su.no') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-molecules.ui.input-group wire-modal="su.no" placeholder="e.g 9091293802">
                            +63
                        </x-molecules.ui.input-group>
                    </div>
                    <div>
                        <x-atoms.ui.label class="">Email <x-atoms.ui.required/>@error('su.email') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.email" type="text" class="mb-3" placeholder="example@gmail.com..."/>
                    </div>
            </x-molecules.ui.field>
        </form>
    @endsection

</x-organisms.modal>

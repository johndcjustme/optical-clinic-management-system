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
            <label for="supplier_avatar" class="ui button tiny icon"><i class="icon add"></i> {{ !empty($su['avatar']) || !empty($previewAvatar) ? 'Change Avatar' : 'Add Avatar'}}</label>
        </div>
        <div>
            <h5>
                {{ !empty($su['id']) ? 'UPDATE SUPPLIER' : 'ADD SUPPLIER' }}
            </h5>
        </div>
        <div class="">
            <x-atoms.ui.button wire:click.prevent="closeModal" class="tiny">Close</x-atoms.ui.button>
            <x-atoms.ui.button class="secondary tiny" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
        </div>
    @endsection

    @section('modal_body')
        <br>
        <form id="{{ $formId }}" wire:submit.prevent="{{ $wireSubmit }}" class="ui form"><br>

            <div>
                <div class="x-flex x-flex-center x-flex-column">
                    <div>
                        @if ($previewAvatar) 
                            <x-atoms.ui.avatar src="{{ $previewAvatar->temporaryUrl() }}" size="5em"/>
                        @else 
                            <x-atom.profile-photo size="5em" path="{{ $this->storage($su['avatar']) }}" />
                        @endif
                        <input wire:model="previewAvatar" type="file" name="" id="supplier_avatar" hidden>     
                    </div>
                    <div>
                        @error('previewAvatar') <br><span class="ui text error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <br><br>
            <div class="ui form">
                <div class="two fields">
                    <div class="field">
                        <x-atoms.ui.label class="">Name <x-atoms.ui.required/> @error('su.name') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.name" type="text" class="mb_7" placeholder="Enter name..."/>
                        <x-atoms.ui.label class="">Address</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.address" type="text" class="mb_7" placeholder="Enter address..."/>
                        <x-atoms.ui.label class="">Branch</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.branch" type="text" class="mb_7" placeholder="Enter branch..."/>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label class="">Account Name</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.bank" type="text" class="mb_7" placeholder="Enter bank name..."/>
                        <x-atoms.ui.label class="">Account Number</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.acc" type="text" class="mb_7" placeholder="Enter account number..."/>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <x-atoms.ui.label class="">Contact No <x-atoms.ui.required/>@error('su.no') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <div class="ui labeled input">
                            <div class="ui label">
                              +63
                            </div>
                            <input wire:model.defer="su.no" type="text" placeholder="e.g 9512558699">
                        </div>
                        {{-- <x-atoms.ui.input wire-model="su.no" type="text" class="mb_7" placeholder="e.g 9512558699..."/> --}}
                    </div>
                    <div class="field">
                        <x-atoms.ui.label class="">Email <x-atoms.ui.required/>@error('su.email') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.email" type="text" class="mb_7" placeholder="e.g. example@gmail.com..."/>
                    </div>
                </div>
            </div>
        </form>
    @endsection

</x-organisms.modal>

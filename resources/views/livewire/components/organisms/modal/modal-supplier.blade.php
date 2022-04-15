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
            
        </div>
        <div class="">
            <x-atoms.ui.button wire:click.prevent="closeModal" class="basic tiny">Close</x-atoms.ui.button>
            <x-atoms.ui.button class="secondary tiny" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
        </div>
    @endsection

    @section('modal_body')

        <form id="{{ $formId }}" wire:submit.prevent="{{ $wireSubmit }}" class="ui form"><br>

            <div>
                <div class="flex gap_1 flex_y_center">
                    <div>
                        @if ($previewAvatar)
                            <x-atoms.ui.avatar src="{{ $previewAvatar->temporaryUrl() }}" size="4em"/>
                        @else
                            <x-atom.profile-photo size="4em" path="{{ $this->storage($su['avatar']) }}" />
                        @endif
                    </div>
                    <div>
                        <label class="ui blue tertiary button" for="patient_avatar">Choose Photo</label>
                        <input wire:model="previewAvatar" type="file" name="" id="patient_avatar" hidden>     
                    </div>
                </div>
                @error('previewAvatar') <span class="ui text error">{{ $message }}</span> @enderror
            </div>
            <br><br>
            <div class="ui form">
                <div class="two fields">
                    <div class="field">
                        <x-atoms.ui.label class="">Name <x-atoms.ui.required/> @error('su.name') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.name" type="text" class="mb_7 error"/>
                        <x-atoms.ui.label class="">Address</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.address" type="text" class="mb_7"/>
                        <x-atoms.ui.label class="">Branch</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.branch" type="text" class="mb_7"/>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label class="">Bank</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.bank" type="text" class="mb_7"/>
                        <x-atoms.ui.label class="">Account</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.acc" type="text" class="mb_7"/>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <x-atoms.ui.label class="">Contact No</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.no" type="text" class="mb_7"/>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label class="">Email <x-atoms.ui.required/>@error('su.email') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="su.email" type="text" class="mb_7"/>
                    </div>
                </div>
            </div>
        </form>
    @endsection

</x-organisms.modal>

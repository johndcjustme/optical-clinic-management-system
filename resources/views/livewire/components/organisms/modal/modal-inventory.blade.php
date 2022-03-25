@php
     $formId = '';
        $wireSubmit = '';
        $btnLabel = '';
        
    if ($modal['add']) {
        if ($modal['item']) {
            $wireSubmit = 'addItem';
            $formId = $wireSubmit;
        }
        elseif ($modal['supplier']) {
            $wireSubmit = 'addSupplier';
            $formId = $wireSubmit;
        }
    }
    elseif($modal['update']) {
        if ($modal['item']) {
            $formId = 'updateItem';
            $wireSubmit = 'updateItem(' . $item['id'] . ')';
        } elseif ($modal['supplier']) {
            $formId = 'updateSupplier';
            $wireSubmit = 'updateSupplier(' . $su['id'] . ')';
        }
    }
    
@endphp

<x-organisms.modal>

    @section('modal_title')

        <div></div>
        <div class="">
            {{-- <div class="ui small buttons"> --}}
                <a href="#" class="ui button tiny basic" rel="modal:close">Close</a>
                {{-- <x-atoms.ui.button wire:click.prevent="closeModal" class="basic tiny">Close</x-atoms.ui.button> --}}
                <x-atoms.ui.button class="secondary tiny" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
        </div>
    @endsection


    @section('modal_body')

        <form id="{{ $formId }}" wire:submit.prevent="{{ $wireSubmit }}" class="ui form"><br>

            @switch($modal['add'] || $modal['update'])
                @case($modal['item'])
                    @include('livewire.components.organisms.modal.modal-inventory.add-edit-item')
                    @break

                @case($modal['supplier'])
                    @include('livewire.components.organisms.modal.modal-inventory.add-edit-supplier')
                    @break
                @default            
            @endswitch

        </form>
    @endsection

</x-organisms.modal>



{{-- 
<script>
    $('.ui.dropdown').dropdown();
</script> --}}

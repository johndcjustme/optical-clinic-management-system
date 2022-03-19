@php
     $formId = 'addItem';
            $wireSubmit = 'addItem';
            $btnLabel = 'Add';
    if ($modal['add']) {
        if ($modal['item']) {
            $formId = 'addItem';
            $wireSubmit = 'addItem';
        }
        elseif ($modal['supplier']) {
            $formId = 'addSupplier';
            $wireSubmit = 'addSupplier';
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
                {{-- <x-atoms.ui.button rel="modal:close" class="basic tiny">Close</x-atoms.ui.button> --}}
                <x-atoms.ui.button class="secondary tiny" form="{{ $formId }}" type="submit">Save</i></x-atoms.ui.button>
            {{-- </div> --}}
        </div>


    @endsection


    @section('modal_body')
        @if($modal['add'] || $modal['update'])
            <br><br>
            <form id="{{ $formId }}" wire:submit.prevent="{{ $wireSubmit }}" class="ui form">
                @if ($modal['item'])
                        <div class="ui form">
                            <div class="two fields">
                                <div class="field">
                                    <x-atoms.ui.label>Type</x-atoms.ui.label>
                                    <x-atoms.ui.select wire:model.defer="item.type" class="mb_7">
                                        <option value="" selected hidden>Select</option>
                                        <option class="item" value="le">Lense</option>
                                        <option class="item" value="fr">Frame</option>
                                        <option class="item" value="ac">Accessory</option>
                                    </x-atoms.ui.select>
                                    <x-atoms.ui.label>Item Name</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="item.name" type="text" class="mb_7" required/>
                                    <x-atoms.ui.label>Item Description</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="item.desc" type="text" class="mb_7"/>
                                    <x-atoms.ui.label>Item Size</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="item.size" type="text" class="mb_7"/>
                                </div>
                                <div class="field">
                                    <x-atoms.ui.label>Supplier</x-atoms.ui.label>
                                    <x-atoms.ui.select wire:model.defer="item.supplier" class="fluid mb_7" tabindex="0">
                                        <option value="" selected hidden>Select</option>
                                        @foreach ($suppliers as $supplier)
                                            <option class="item" value="{{ $supplier->id }}">
                                                {{ $supplier->supplier_name }}
                                            </option>
                                        @endforeach
                                    </x-atoms.ui.select>
                                    <x-atoms.ui.label>Item Quantity</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="item.qty" type="number" class="mb_7"/>
                                    <x-atoms.ui.label>Item Price</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="item.price" type="number" class="mb_7"/>
                                </div>
                            </div>
                        </div>

                @elseif ($modal['supplier'])
                  <form action="">
                        <div class="ui form">
                            <div class="two fields">
                                <div class="field">
                                    <x-atoms.ui.label class="">Name</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="su.name" type="text" class="mb_7"/>
                                    <x-atoms.ui.label class="">Address</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="su.address" type="text" class="mb_7"/>
                                    <x-atoms.ui.label class="">Contact No</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="su.no" type="text" class="mb_7"/>
                                    <x-atoms.ui.label class="">Email</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="su.email" type="text" class="mb_7"/>
                                </div>
                                <div class="field">
                                    <x-atoms.ui.label class="">Branch</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="su.branch" type="text" class="mb_7"/>
                                    <x-atoms.ui.label class="">Bank</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="su.bank" type="text" class="mb_7"/>
                                    <x-atoms.ui.label class="">Account</x-atoms.ui.label>
                                    <x-atoms.ui.input wire-model="su.acc" type="text" class="mb_7"/>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div>
                        <input type="file" name="" id="">
                    </div>

                @endif
            </form>



           
        @endif

    @endsection

</x-organisms.modal>



{{-- 
<script>
    $('.ui.dropdown').dropdown();
</script> --}}

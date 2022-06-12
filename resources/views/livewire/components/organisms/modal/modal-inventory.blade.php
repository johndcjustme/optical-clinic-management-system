@php
    $formId = '';

    $wireSubmit = '';

    $btnLabel = '';

    $disabledInputIn = '';
    $disabledBtnIn = '';

    $item_type = $this->itemType($item['type']);

    if (empty($item['id']))
        $disabledInputIn = 'disabled';
    if (empty($item['in']))
        $disabledBtnIn = 'disabled';


        
    if ($modal['add']) {
        if ($modal['item']) {
            $wireSubmit = 'addItem';
            $formId = $wireSubmit;
        }
        // elseif ($modal['supplier']) {
        //     $wireSubmit = 'addSupplier';
        //     $formId = $wireSubmit;
        // }
    }
    elseif($modal['update']) {
        if ($modal['item']) {
            $formId = 'updateItem';
            $wireSubmit = 'updateItem(' . $item['id'] . ')';
        } 
        // elseif ($modal['supplier']) {
        //     $formId = 'updateSupplier';
        //     $wireSubmit = 'updateSupplier(' . $su['id'] . ')';
        // }
    }


    
@endphp

<x-organisms.modal>

    @section('modal_title')

        <div class="x-flex x-flex-ycenter x-gap-1">
            {{-- @if ($modal['add'] || $modal['update'])
                <label for="item_image" class="btn"><i class="fa-solid fa-add mr-2"></i> {{ !empty($item['image']) || !empty($item['preview']) ? 'Change Photo' : 'Add Photo'}}</label>
            @endif --}}
            {{-- @if ($modal['inItem'])                
                <div class="ui dropdown floating icon button tiny blue" x-init="$('.ui.dropdown').dropdown()" style="z-index: 400" title="Search item">
                    <i class="search icon"></i>
                    Choose Item
                    <div class="menu fluid right">
                        <div class="ui icon search input">
                            <i class="search icon"></i>
                            <input type="text" placeholder="Search Items...">
                        </div>
                        <div class="divider"></div>
                        <div class="scrolling menu">
                            @foreach (App\Models\Item::all() as $item)
                                <div class="item">
                                    <div class="x-flex x-flex-xbetween x-gap-1">
                                        <div>
                                            <div>
                                                {{ $item->item_name }}
                                            </div>
                                            <small>
                                                <i class="fa-solid fa-peso-sign"></i> {{ $item->item_price }} • {{ $item->item_desc }}
                                            </small>
                                        </div>
                                        <div>
                                            <button class="ui circular button icon mini" wire:click.prevent="selectedItem({{ $item->id }})" title="Select this one">
                                                <i class="icon arrow right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="x-flex x-flex-ycenter x-gap-1">
                    @if ($modal['edit_in_inItem'])
                        <label class="ui tiny button circular icon" for="updateItem_from_inItem" title="Confirm">
                            <i class="icon check"></i>
                        </label>
                        <label wire:click.prevent="$set('modal.edit_in_inItem', false)" class="ui tiny button circular icon ml_5" title="Cancel">
                            <i class="icon arrow left"></i>
                        </label>
                    @else
                        <x-atoms.ui.button-circular wire:click.prevent="$toggle('modal.edit_in_inItem')" class="tiny basic {{ $disabledInputIn }}" title="Edit">
                            <i class="icon edit"></i>
                        </x-atoms.ui.button-circular>
                    @endif
                </div>
            @endif --}}
        </div>

        <div>
            <x-atoms.ui.modal-title>
                @if ($modal['inItem'])                
                    IN ITEM
                @elseif ($modal['add'])
                    ADD ITEM
                @elseif ($modal['update'])
                    EDIT ITEM
                @endif
            </x-atoms.ui.modal-title>
        </div>
        <div class="">
            <x-atoms.ui.btn-close-modal/>
            @if ($modal['add'] || $modal['update'])
                <label class="btn btn-primarym ml-2" for="createOrUpdateItem">Save</label>
            @elseif($modal['category'])
                <label for="1001" class="btn btn-primarym ml-2" >Save</label>
            @endif
        </div>


    @endsection


    @section('modal_body')
        @if ($modal['add'] || $modal['update'])
            <form id="{{ $formId }}" wire:submit.prevent="updateOrCreateItem" class="ui form">
                <x-molecules.ui.field class="justify-items-center">
                    <label  for="item_image">
                        @if ($item['preview'])
                            <x-atoms.ui.avatar src="{{ $item['preview']->temporaryUrl() }}" size="5em"/>
                        @else
                            <x-atom.profile-photo size="5em" path="{{ storage('items', $item['image']) }}" />
                        @endif
                    </label>
                    <div>
                        @error('item.preview') <span class="error">{{ $message }}</span> @enderror
                        <input id="item_image" type="file" wire:model="item.preview" style="opacity:0; display:none; width:0; height:0;" hidden>
                    </div>
                </x-molecules.ui.field>
                <x-molecules.ui.field class="grid-cols-1">
                    <div>
                        <x-atoms.ui.label>Category @error('item.type') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.select wire:model.defer="item.cat" class="">
                            <option value="" selected hidden>Select</option>
                            <option value="None">--None--</option>
                            @foreach ($categories as $category)
                                <option class="item" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-atoms.ui.select>
                    </div>
                </x-molecules.ui.field>


                <x-molecules.ui.field class="grid-cols-2">
                    <div>
                        <x-atoms.ui.label>Item Name <x-atoms.ui.required/> @error('item.name') <span class="error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="item.name" type="text" class="mb-3" placeholder="Enter item name..."/>

                        <x-atoms.ui.label>Item Desc</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="item.desc" type="text" class="mb-3" placeholder="Enter item name..."/>
                        
                        <x-atoms.ui.label>Item Size</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="item.size" type="text" class="mb-3" placeholder="Enter item size..."/>

                        <x-atoms.ui.label>Low Stock Level/Reserved</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="item.buffer" type="text" class="mb-3" placeholder="Enter low stock level..."/>
                    </div>
                    <div>
                        <x-atoms.ui.label>Supplier</x-atoms.ui.label>
                        <x-atoms.ui.select wire:model.defer="item.supplier" class="mb-3">
                            <option value="null" selected>--None--</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </x-atoms.ui.select>
                        <x-atoms.ui.label>Item Price</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="item.price" type="number" class="mb-3" placeholder="Enter price..."/>

                        <x-atoms.ui.label>Item Quantity</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="item.qty" type="number" class="mb-3" placeholder="Enter quantity..."/>

                        <x-atoms.ui.label>Item Cost</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="item.cost" type="number" class="mb-3" placeholder="Enter cost..."/>
                    </div>
                </x-molecules.ui.field>
                
                {{-- <x-molecules.ui.field class="grid-cols-1">
                    <div>
                        <x-atoms.ui.label>Item Description</x-atoms.ui.label>
                        <textarea class="input input-bordered w-full" wire:model.defer="item.desc" name="" id="" rows="2" placeholder="Enter description..."></textarea>
                    </div>
                </x-molecules.ui.field> --}}
                <input id="createOrUpdateItem" type="submit" value="" style="opacity: 0; width:0; height:0;" hidden>
            </form>
        @endif



        {{-- @if ($modal['inItem'])
            @if ($modal['displayItem'])
                <br>
                <form wire:submit.prevent="inItem" class="">`
                    <div class="x-flex x-flex-xend x-gap-1 x-flex-ycenter">
                        <div>
                            <div class="ui input {{ $disabledInputIn }} {{ $modal['edit_in_inItem'] ? 'disabled' : '' }}">
                                <input wire:model.lazy="item.in" type="number" min="0" laceholder="Enter In-Item Quantity...">
                            </div>
                        </div>
                        <div>
                            <label for="inItem" class="ui button icon right labeled {{ $disabledBtnIn }} {{ $modal['edit_in_inItem'] ? 'disabled' : '' }}">In <i class="icon right arrow"></i></label>
                        </div>
                    </div>
                    <input id="inItem" type="submit" value="" style="opacity: none;" hidden>
                </form>

                
                <form id="" wire:submit.prevent="updateItemFromInItem">
                    <br>
                    @if (session()->has('hey'))
                        <x-atoms.ui.message message="{{ session('hey') }}" class="success" close="close"/>
                    @endif

                    <div>
                        <x-organisms.ui.table class="unstackable">
                            <x-slot name="thead"></x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <x-organisms.ui.table.td text="Name" style="width:8em"/>
                                    <td>
                                        <div class="ui input fluid">
                                            <input wire:model.defer="item.name" type="text" placeholder="Enter Name..." @if (!$modal['edit_in_inItem']) readonly @endif>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <x-organisms.ui.table.td text="Category"/>
                                    <td>
                                        @if (!$modal['edit_in_inItem']) 
                                            <div class="ui input fluid">
                                                <input value="{{ $item_type }}" type="text" placeholder="Enter Size..." @if (!$modal['edit_in_inItem']) readonly @endif>
                                            </div>
                                        @else
                                            <x-atoms.ui.select wire:model.defer="item.type" class="fluid">
                                                <option value="" selected hidden>Select</option>
                                                <option class="item" value="le">Lense</option>
                                                <option class="item" value="fr">Frame</option>
                                                <option class="item" value="ac">Accessory</option>
                                            </x-atoms.ui.select>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <x-organisms.ui.table.td text="Size"/>
                                    <td>
                                        <div class="ui input fluid">
                                            <input wire:model.defer="item.size" type="text" placeholder="Enter Size..." @if (!$modal['edit_in_inItem']) readonly @endif>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <x-organisms.ui.table.td text="Price"/>
                                    <td>
                                        <div class="ui input fluid">
                                            <input wire:model.defer="item.price" type="number" min="0" step="0.01" placeholder="Enter Price..." @if (!$modal['edit_in_inItem']) readonly @endif>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <x-organisms.ui.table.td text="Current Balance"/>
                                    <td>
                                        <div class="ui input fluid">
                                            <input wire:model.defer="item.qty" type="number" min="0" placeholder="Enter Stocks..." @if (!$modal['edit_in_inItem']) readonly @endif>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <x-organisms.ui.table.td text="Low Stock Level"/>
                                    <td>
                                        <div class="ui input fluid">
                                            <input wire:model.defer="item.buffer" type="number" min="0" placeholder="Enter Low Stock Level..." @if (!$modal['edit_in_inItem']) readonly @endif>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <x-organisms.ui.table.td text="Description"/>
                                    <td>
                                        <div class="ui input fluid">
                                            <input wire:model.defer="item.desc" type="text" placeholder="Enter Description..." @if (!$modal['edit_in_inItem']) readonly @endif>
                                        </div>
                                    </td>
                                </tr>
                            
                            </x-slot>
                        </x-organisms.ui.table>
                    </div>
                    <input id="updateItem_from_inItem" type="submit" style="opacity: 0" hidden>
                </form>
                <br>
            @else
                <br>
                <x-atoms.ui.message 
                    class="warning"
                    header="Choose item first."
                    message="Lorem ipsum, dolor sit amet consectetur adipisicing elit."/>
            @endif 
        @endif--}}
        @if ($modal['category'])
                <form wire:submit.prevent="updateOrCreateCategory">
                    <x-molecules.ui.field>
                        <div>
                            <x-atoms.ui.label>Name <x-atoms.ui.required/></x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="cat.name" type="text" placeholder="Enter Name..." class="mb-3"/>
                        </div>
                    </x-molecules.ui.field>

                    <x-molecules.ui.field>
                        <div>
                            <x-atoms.ui.label>Description</x-atoms.ui.label>
                            <textarea wire:model.defer="cat.desc" class="input input-bordered w-full" placeholder="Enter Description..." style="height: 5em"></textarea>
                        </div>
                    </x-molecules.ui.field>

                    <x-molecules.ui.field>
                        <div>
                            <input id="1001" type="submit" value="" style="opacity:0; width:0; height:0;" hidden>
                        </div>
                    </x-molecules.ui.field>
                </form>
            @endif


    @endsection

</x-organisms.modal>


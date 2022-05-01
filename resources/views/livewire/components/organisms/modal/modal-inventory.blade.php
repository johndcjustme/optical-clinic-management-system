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
            @if ($modal['add'] || $modal['update'])
                <label for="item_image" class="ui button tiny icon"><i class="icon add"></i> {{ !empty($item['image']) || !empty($item['preview']) ? 'Change Photo' : 'Add Photo'}}</label>
            @endif
            @if ($modal['inItem'])                
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
            @endif
        </div>

        <div>
            <h5 class="ui header">
                @if ($modal['inItem'])                
                    IN ITEM
                @elseif ($modal['add'])
                    ADD ITEM
                @elseif ($modal['update'])
                    EDIT ITEM   
                @endif
            </h5>
        </div>
        <div class="">
            <x-atoms.ui.button wire:click.prevent="closeModal" class="tiny">Close</x-atoms.ui.button>
            @if ($modal['add'] || $modal['update'])
                <label class="ui button secondary tiny" for="createOrUpdateItem">Save</label>
            @elseif($modal['category'])
                <label for="1001" class="ui button secondary tiny" >Save</label>
            @endif
        </div>


    @endsection


    @section('modal_body')
        @if ($modal['add'] || $modal['update'])
            <br>
            <form id="{{ $formId }}" wire:submit.prevent="updateOrCreateItem" class="ui form"><br>
                <div class="ui form">
                    <div class="field">
                        <div class="x-flex x-flex-center x-gap-1">
                            <div>
                                @if ($item['preview'])
                                    <x-atoms.ui.avatar src="{{ $item['preview']->temporaryUrl() }}" size="5em"/>
                                @else
                                    <x-atom.profile-photo size="5em" path="{{ storage('items', $item['image']) }}" />
                                @endif
                            </div>
                            <div>
                                <div>
                                    @error('item.preview') <span class="error">{{ $message }}</span> @enderror
                                    <input id="item_image" type="file" wire:model="item.preview" style="opacity:0; display:none" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label>Category @error('item.type') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                        <x-atoms.ui.select wire:model.defer="item.cat" class="">
                            <option value="" selected hidden>Select</option>
                            <option value="">--None--</option>
                            @foreach ($categories as $category)
                                <option class="item" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-atoms.ui.select>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <x-atoms.ui.label>Item Name <x-atoms.ui.required/> @error('item.name') <span class="error">{{ $message }}</span> @enderror</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="item.name" type="text" class="mb_7"/>
                            {{-- <x-atoms.ui.label>Item Description</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="item.desc" type="text" class="mb_7"/> --}}
                            <x-atoms.ui.label>Item Size</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="item.size" type="text" class="mb_7"/>
                            <x-atoms.ui.label>Low Stock Level</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="item.buffer" type="text" class="mb_7"/>
                        </div>
                        <div class="field">
                            <x-atoms.ui.label>Supplier</x-atoms.ui.label>
                            <x-atoms.ui.select wire:model.defer="item.supplier" class="fluid mb_7" tabindex="0">
                                <option value="" selected hidden>Select</option>
                                <option value="null" >--None--</option>
                                @foreach ($suppliers as $supplier)
                                    <option class="item" value="{{ $supplier->id }}">
                                        {{ $supplier->supplier_name }}
                                    </option>
                                @endforeach
                            </x-atoms.ui.select>
                            {{-- <x-atoms.ui.label>Item Quantity</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="item.qty" type="number" class="mb_7"/> --}}
                            <x-atoms.ui.label>Item Price</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="item.price" type="number" class="mb_7"/>
                            <x-atoms.ui.label>Item Cost</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="item.cost" type="number" class="mb_7"/>
                        </div>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label>Item Description</x-atoms.ui.label>
                        <div class="ui input">
                            <textarea wire:model.defer="item.desc" name="" id="" rows="2"></textarea>
                        </div>
                        {{-- <x-atoms.ui.input wire-model="item.desc" type="text" class="mb_7"/> --}}
                    </div>
                </div>
                <input id="createOrUpdateItem" type="submit" value="" style="opacity: 0" hidden>
            </form>
        @endif



        @if ($modal['inItem'])
            @if ($modal['displayItem'])
                <br>
                <form wire:submit.prevent="inItem" class="">`
                    <div class="x-flex x-flex-xend x-gap-1 x-flex-ycenter">
                        <div>
                            <div class="ui input {{ $disabledInputIn }} {{ $modal['edit_in_inItem'] ? 'disabled' : '' }}">
                                <input wire:model.lazy="item.in" type="number" min="0" laceholder="Enter In-Item Quantity...">
                            </div>
                            {{-- <x-atoms.ui.input wire-model="item.in" type="number" min="0" class="{{ $disabled }} {{ $modal['edit_in_inItem'] ? 'disabled' : '' }}" placeholder="Enter In-Item Quantity..."/> --}}
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
        @endif
        @if ($modal['category'])
                <br>
                <form wire:submit.prevent="updateOrCreateCategory" class="ui form">
                    <div class="field">
                        <x-atoms.ui.label>Name <x-atoms.ui.required/></x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="cat.name" type="text" placeholder="Enter Name..." class="fluid mb_7"/>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label>Description</x-atoms.ui.label>
                        <div class="ui input">
                            <textarea wire:model.defer="cat.desc" placeholder="Enter Description..." cols="30" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="x-flex x-flex-xend x-flex-ycenter">
                        <input id="1001" type="submit" value="" style="opacity: 0;" hidden>
                    </div>
                </form>
            @endif


    @endsection

</x-organisms.modal>


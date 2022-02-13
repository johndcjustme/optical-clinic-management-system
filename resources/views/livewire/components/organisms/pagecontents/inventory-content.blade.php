<x-layout.page-content>
    {{-- head --}}

        @section('section-page-title', 'Inventory')

        @section('section-links')
            <x-atom.tab-links.link tab-title="Lenses" wire-click="inventoryChangeTable(1)" sub-page="{{ $this->myTab() == 1 }}"/>
            <x-atom.tab-links.link tab-title="Frames" wire-click="inventoryChangeTable(2)" sub-page="{{ $this->myTab() == 2 }}"/>
            <x-atom.tab-links.link tab-title="Accessories" wire-click="inventoryChangeTable(3)" sub-page="{{ $this->myTab() == 3 }}"/>
            <x-atom.tab-links.link tab-title="Suppliers" wire-click="inventoryChangeTable(4)" sub-page="{{ $this->myTab() == 4 }}"/>
            <x-atom.tab-links.link tab-title="In / out" wire-click="inventoryChangeTable(5)" sub-page="{{ $this->myTab() == 5 }}"/>
        @endsection

        @section('section-heading')
            <div class="flex gap_1">
                <h5>
                    @switch($this->myTab())
                        @case(1) LENSES
                            @break
                        @case(2) FRAMES
                            @break
                        @case(3) ACCESSORIES 
                            @break
                        @case(4) SUPPLIERS
                            @break
                        @case(5) IN / OUT
                            @break
                    @endswitch
                </h5>
            </div>
            <div class="flex flex_y_center gap_1">

                @switch($this->myTab())
                    @case(1)
                        <div class="flex gap_1">
                            <div class="flex gap_1">
                                <select wire:model.prevent="le_defaultOrder" class="font_small noformat">
                                    <option value="lense_name" selected>Name</option>
                                    <option value="item_type">Type</option>
                                    <option value="lense_qty">Qty</option>
                                    <option value="lense_price">Price</option>
                                </select>
                                <select wire:model.prevent="le_sort_direction" class="font_small noformat">
                                    <option value="asc">ASC</option>
                                    <option value="desc">DESC</option>
                                </select>
                            </div>
                            <div>
                                <x-input.search wire-model="searchLense"/>
                            </div>
                            <div>
                                <button wire:click="inventoryShowModal('isAdd', 'le', null)"><i class="fas fa-plus"></i> add</button>
                            </div>
                        </div>
                        @break
                    
                    @case(2)
                        <div class="flex gap_1">
                            <div class="flex gap_1">
                                <select wire:model.prevent="fr_defaultOrder" class="font_small noformat" name="" id="">
                                    <option value="frame_name" selected>Name</option>
                                    <option value="item_type">Type</option>
                                    <option value="frame_qty">Qty</option>
                                    <option value="frame_price">Price</option>
                                </select>
                                <select wire:model.prevent="fr_sort_direction" class="font_small noformat" name="" id="">
                                    <option value="asc" selected>ASC</option>
                                    <option value="desc">DESC</option>
                                </select>
                            </div>
                            <div>
                                <x-input.search wire-model="searchFrame"/>
                            </div>
                            <div>
                                <button wire:click="inventoryShowModal('isAdd', 'fr', null)"><i class="fas fa-plus"></i> add</button>
                            </div>
                        </div>
                        @break

                    @case(3)
                        <div class="flex gap_1">
                            <div class="flex gap_1">
                                <select wire:model.prevent="ac_defaultOrder" class="font_small noformat" name="" id="">
                                    <option value="accessory_name" selected>Name</option>
                                    <option value="accessory_qty">Qty</option>
                                    <option value="accessory_price">Price</option>
                                </select>
                                <select wire:model.prevent="ac_sort_direction" class="font_small noformat" name="" id="">
                                    <option value="asc" selected>ASC</option>
                                    <option value="desc">DESC</option>
                                </select>
                            </div>
                            <div>
                                <x-input.search wire-model="searchAccessory"/>
                            </div>
                            <div>
                                <button wire:click="inventoryShowModal('isAdd', 'ac', null)"><i class="fas fa-plus"></i> add</button>
                            </div>
                        </div>
                        @break

                    @case(4)
                        <div class="flex gap_1">
                            <div class="flex gap_1">
                                <select wire:model.prevent="su_defaultOrder" class="font_small noformat">
                                    <option value="supplier_name" selected>Name</option>
                                    <option value="created_at">Date Added</option>
                                </select>
                                <select wire:model.prevent="su_sort_direction" class="font_small noformat">
                                    <option value="asc" selected>ASC</option>
                                    <option value="desc">DESC</option>
                                </select>
                            </div>
                            <div>
                                <x-input.search wire-model="searchSupplier"/>
                            </div>
                            <div>
                                <button wire:click="inventoryShowModal('isAdd', 'su', null)"><i class="fas fa-plus"></i> add</button>
                            </div>
                        </div>
                        @break                        

                    @case(5)
                        <div class="flex gap_1">
                            <div class="flex gap_1">
                                <select class="font_small noformat" name="" id="">
                                    <option value="" selected>Name</option>
                                    <option value="">Address</option>
                                    <option value="">Branch</option>
                                </select>
                                <select class="font_small noformat" name="" id="">
                                    <option value="" selected>ASC</option>
                                    <option value="">DESC</option>
                                </select>
                            </div>
                            <div>
                                <input type="search" name="" id="" placeholder="Search Supplier">
                            </div>
                            <div>
                                <button wire:click="inventoryShowModal('addSu')"><i class="fas fa-plus"></i> add</button>
                            </div>
                        </div>
                        @break
                @endswitch



            </div>
        @endsection

        @section('section-main')

            <div class="items">

                @switch($this->myTab())

                    @case(1)
                        <x-layout.lists-section>               
 
                            <x-layout.lists-section.lists-list list-for="grid_lens title">
                                <div>{{ Str::title('Name') }}</div>
                                <div></div>
                                <div>{{ Str::title('Type') }}</div>
                                <div>{{ Str::title('Supplier') }}</div>
                                <div>{{ Str::title('Qty') }}</div>
                                <div>{{ Str::title('Price') }}</div>
                            </x-layout.lists-section.lists-list>

                            @forelse ($lenses as $lense)

                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_lens list">

                                        <div>{{ $lense->lense_name }}</div>
                                        <div class="flex_center">
                                            <x-organisms.more image="{{ asset('images/sample-image.jpg') }}">
                                                <label for="">More details</label><br><br>
                                                <label for="">Tint</label>
                                                <p>{{ $lense->lense_tint }}</p>
                                                <label for="">Description</label>
                                                <p>{{ $lense->lense_desc }}</p>
                                            </x-organisms.more>
                                        </div>
                                        <div>{{ $lense->item_type }}</div>
                                        @if ($lense->supplier_id == null)
                                            <div><i>[Empty]</i></div>
                                        @else
                                            <div>{{ $lense->supplier->supplier_name }}</div>                                            
                                        @endif
                                        <div>{{ $lense->lense_qty }}</div>
                                        <div>{{ $lense->lense_price }}</div>

                                    </x-layout.lists-section.lists-list>
                                    <div class="actions">
                                        <x-organisms.popup-delete item-id="{{ $lense->id  }}" wire-click="deleteInventory('le', {{ $lense->id }})" />
                                        <x-layout.lists-section.action  delete-id="{{ $lense->id }}" wire-click="inventoryShowModal('isUpdate', 'le', '{{ $lense->id }}')"/>
                                    </div>

                                </x-layout.lists-section.lists-container>
                            @empty
                                <x-layout.lists-section.list-empty empty-message="No Results."/>
                            @endforelse
                        </x-layout.lists-section>
                        @break
                
                    @case(2)
                        <x-layout.lists-section>               

                            <x-layout.lists-section.lists-list list-for="grid_lens title">
                                <div>{{ Str::title('Name') }}</div>
                                <div></div>
                                <div>{{ Str::title('Type') }}</div>
                                <div>{{ Str::title('Supplier') }}</div>
                                <div>{{ Str::title('Qty') }}</div>
                                <div>{{ Str::title('Price') }}</div>
                            </x-layout.lists-section.lists-list>

                            @forelse ($frames as $frame)

                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_lens list">

                                        <div>{{ $frame->frame_name }}</div>
                                        <div class="flex_center">
                                            <x-organisms.more image="{{ asset('images/sample-image.jpg') }}">
                                                <label for="">More details</label><br><br>
                                                <label for="">Size</label>
                                                <p>{{ $frame->frame_size }}</p>
                                                <label for="">Description</label>
                                                <p>{{ $frame->frame_desc }}</p>
                                            </x-organisms.more>
                                        </div>
                                        <div>{{ $frame->item_type }}</div>
                                        @if ($frame->supplier_id == null)
                                            <div><i>[Empty]</i></div>
                                        @else
                                            <div>{{ $frame->supplier->supplier_name }}</div>
                                        @endif

                                        <div>{{ $frame->frame_qty }}</div>
                                        <div>{{ $frame->frame_price }}</div>

                                    </x-layout.lists-section.lists-list>
                                    <div class="actions">
                                        <x-organisms.popup-delete item-id="{{ $frame->id  }}" wire-click="deleteInventory('fr', {{ $frame->id }})" />
                                        <x-layout.lists-section.action  delete-id="{{ $frame->id }}" wire-click="inventoryShowModal('isUpdate', 'fr', '{{ $frame->id }}')"/>
                                    </div>

                                </x-layout.lists-section.lists-container>
                            @empty
                                <x-layout.lists-section.list-empty empty-message="No Results."/>
                            @endforelse
                        </x-layout.lists-section>          
                        @break

                    @case(3)
                        <x-layout.lists-section>               

                            <x-layout.lists-section.lists-list list-for="grid_lens title">
                                <div>{{ Str::title('Name') }}</div>
                                <div></div>
                                <div>{{ Str::title('Description') }}</div>
                                <div>{{ Str::title('Supplier') }}</div>
                                <div>{{ Str::title('Qty') }}</div>
                                <div>{{ Str::title('Price') }}</div>
                            </x-layout.lists-section.lists-list>

                            @forelse ($accessories as $accessory)

                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_lens list">

                                        <div>{{ $accessory->accessory_name }}</div>
                                        <div class="flex_center">
                                            <x-organisms.more image="{{ asset('images/sample-image.jpg') }}">
                                                <label for="">More details</label><br><br>
                                                <label for="">Item type</label>
                                                <p>{{ $accessory->item_type }}</p>
                                            </x-organisms.more>
                                        </div>
                                        <div>{{ $accessory->accessory_desc }}</div>
                                        @if ($accessory->supplier_id == null)
                                            <div><i>[Empty]</i></div>
                                        @else
                                            <div>{{ $accessory->supplier->supplier_name }}</div>
                                        @endif
                                        <div>{{ $accessory->accessory_qty }}</div>
                                        <div>{{ $accessory->accessory_price }}</div>

                                    </x-layout.lists-section.lists-list>
                                    <div class="actions">
                                        <x-organisms.popup-delete item-id="{{ $accessory->id  }}" wire-click="deleteInventory('ac', {{ $accessory->id }})" />
                                        <x-layout.lists-section.action  delete-id="{{ $accessory->id }}" wire-click="inventoryShowModal('isUpdate', 'ac', '{{ $accessory->id }}')"/>
                                    </div>

                                </x-layout.lists-section.lists-container>
                            @empty
                                <x-layout.lists-section.list-empty empty-message="No Results."/>
                            @endforelse
                        </x-layout.lists-section>
                        @break

                    @case(4)

                            <x-layout.lists-section>               

                                <x-layout.lists-section.lists-list list-for="grid_supplier title">
                                    <div>{{ Str::title('Supplier name') }}</div>
                                    <div></div>
                                    <div>{{ Str::title('Contact no') }}</div>
                                    <div>{{ Str::title('Email') }}</div>
                                    <div>{{ Str::title('address') }}</div>
                                </x-layout.lists-section.lists-list>

                                @forelse ($suppliers as $supplier)

                                    <x-layout.lists-section.lists-container>
                                        <x-layout.lists-section.lists-list list-for="grid_supplier list">

                                            <div>{{ $supplier->supplier_name }}</div>
                                            <div class="flex_center">
                                                <x-organisms.more image="{{ asset('images/sample-image.jpg') }}">
                                                    <label for="">More details</label><br><br>
                                                    <label for="">Bank</label>
                                                    <p>{{ $supplier->supplier_bank }}</p>
                                                    <label for="">Account no.</label>
                                                    <p>{{ $supplier->supplier_acc_no }}</p>
                                                    <label for="">Branch</label>
                                                    <p>{{ $supplier->supplier_branch }}</p>
                                                </x-organisms.more>
                                            </div>
                                            <div>{{ $supplier->supplier_contact_no }}</div>
                                            <div>{{ $supplier->supplier_email }}</div>
                                            <div>{{ $supplier->supplier_address }}</div>

                                        </x-layout.lists-section.lists-list>
                                        <div class="actions">
                                            <x-organisms.popup-delete item-id="{{ $supplier->id  }}" wire-click="deleteInventory('su', {{ $supplier->id }})" />
                                            <x-layout.lists-section.action  delete-id="{{ $supplier->id }}" wire-click="inventoryShowModal('isUpdate', 'su', '{{ $supplier->id }}')"/>
                                        </div>

                                    </x-layout.lists-section.lists-container>
                                @empty
                                    <x-layout.lists-section.list-empty empty-message="No Results."/>
                                @endforelse
                            </x-layout.lists-section>

                        @break

                    @case(5)

                            <div class="grid grid_inout title">
                                <div>{{ Str::title('Patient name') }}</div>
                                <div>{{ Str::title('date') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('in') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('out') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('balance') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('action') }}</div>
                            </div>

                            @for ($i=1; $i<12; $i++)
                                <div class="list_container">
                                    <x-organisms.popup-delete item-id="{{ $i }}" wire-click="hey('va', {{ $i }})" />

                                    <div class="grid grid_inout list">
                                        <div>content</div>
                                        <div>content</div>
                                        <div class="flex flex_x_end">12</div>
                                        <div class="flex flex_x_end">3</div>
                                        <div class="flex flex_x_end">1</div>
                                        <div class="flex flex_x_end">
                                            <a onclick="getElementById('delete{{ $i  }}').style.right = '0px'" class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                            <a wire:click="showModalOnSupplierUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endfor      
                        @break
                        
                @endswitch
            </div>

        @endsection
        
</x-layout.page-content>
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
                    @if ($this->myTab() == 1)
                        LENSES
                    @elseif ($this->myTab() == 2)
                        FRAMES
                    @elseif ($this->myTab() == 3)
                        ACCESSORRIES
                    @elseif ($this->myTab() == 4)
                        SUPPLIERS
                    @elseif ($this->myTab() == 5)
                        IN / OUT
                    @endif
                </h5>
            </div>
            <div class="flex flex_y_center gap_1">

                @if ($this->myTab() == 1)

                    <div class="flex gap_1">
                        <div class="flex gap_1">
                            <select class="font_small noformat">
                                <option value="" selected>Name</option>
                                <option value="">Type</option>
                                <option value="">Tint</option>
                                <option value="">Qty</option>
                                <option value="">Price</option>
                            </select>
                            <select class="font_small noformat">
                                <option value="">ASC</option>
                                <option value="">DESC</option>
                            </select>
                        </div>
                        <div>
                            <input type="search" name="" id="" placeholder="Search Lens">
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addLe')"><i class="fas fa-plus"></i> add</button>
                        </div>
                    </div>

                @elseif ($this->myTab() == 2)
                    
                    <div class="flex gap_1">
                        <div class="flex gap_1">
                            <select class="font_small noformat" name="" id="">
                                <option value="" selected>Name</option>
                                <option value="">Type</option>
                                <option value="">Tint</option>
                                <option value="">Qty</option>
                                <option value="">Price</option>
                            </select>
                            <select class="font_small noformat" name="" id="">
                                <option value="" selected>ASC</option>
                                <option value="">DESC</option>
                            </select>
                        </div>
                        <div>
                            <input type="search" name="" id="" placeholder="Search Frame">
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addFr')"><i class="fas fa-plus"></i> add</button>
                        </div>
                    </div>
                    
                @elseif ($this->myTab() == 3)
                    
                    <div class="flex gap_1">
                        <div class="flex gap_1">
                            <select class="font_small noformat" name="" id="">
                                <option value="" selected>Name</option>
                                <option value="">Type</option>
                                <option value="">Tint</option>
                                <option value="">Qty</option>
                                <option value="">Price</option>
                            </select>
                            <select class="font_small noformat" name="" id="">
                                <option value="" selected>ASC</option>
                                <option value="">DESC</option>
                            </select>
                        </div>
                        <div>
                            <input type="search" name="" id="" placeholder="Search Accessory">
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addAc')"><i class="fas fa-plus"></i> add</button>
                        </div>
                    </div>
                    
                @elseif ($this->myTab() == 4)
                
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
                            <x-input.search wire-model="searchSupplier"/>
                            {{-- <input type="search" name="" id="" placeholder="Search Supplier"> --}}
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addSu')"><i class="fas fa-plus"></i> add</button>
                        </div>
                    </div>

                @elseif ($this->myTab() == 5)
                
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
                    
                @endif

            </div>
        @endsection

        @section('section-main')

            <div class="items">

                @if ($this->myTab() == 1)
                            <div class="grid grid_lens title">
                                <div>{{ Str::title('lens name') }}</div>
                                <div>{{ Str::title('lens type') }}</div>
                                <div>{{ Str::title('tint') }}</div>
                                <div>{{ Str::title('supplier') }}</div>
                                <div>{{ Str::title('qty') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('Price') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('action') }}</div>
                            </div>

                            @for ($i=1; $i<12; $i++)
                                <div class="list_container">
                                    <x-organisms.popup-delete item-id="{{-- $supplier->id  --}}" wire-click="deleteInventory('su', {{-- $supplier->id --}})" />

                                        
                                    <div class="grid grid_lens list">
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div class="flex flex_x_end">content</div>
                                        <div class="flex flex_x_end">
                                            <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                            <a wire:click="showModalOnLensUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                        </div>
                                    </div>
                                </div>                                
                            @endfor

                @elseif ($this->myTab() == 2)
                
                            <div class="grid grid_frame title">
                                <div>{{ Str::title('frame name') }}</div>
                                <div>{{ Str::title('frame type') }}</div>
                                <div>{{ Str::title('size') }}</div>
                                <div>{{ Str::title('supplier') }}</div>
                                <div>{{ Str::title('qty') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('Price') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('acion') }}</div>
                            </div>


                            @for ($i=1; $i<12; $i++)
                                <div class="list_container">
                                    <x-organisms.popup-delete item-id="{{-- $supplier->id  --}}" wire-click="deleteInventory('su', {{-- $supplier->id --}})" />

                                    <div class="grid grid_frame list">
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div class="flex flex_x_end">content</div>
                                        <div class="flex flex_x_end">
                                            <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                            <a wire:click="showModalOnFrameUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endfor       

                    
                @elseif ($this->myTab() == 3)

                            <div class="grid grid_accessory title">
                                <div>{{ Str::title('accessory name') }}</div>
                                <div>{{ Str::title('accessory type') }}</div>
                                <div>{{ Str::title('type') }}</div>
                                <div>{{ Str::title('supplier') }}</div>
                                <div>{{ Str::title('qty') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('Price') }}</div>
                                <div class="flex flex_x_end">{{ Str::title('acion') }}</div>
                            </div>

                            @for ($i=1; $i<12; $i++)
                                <div class="list_container">
                                    <x-organisms.popup-delete item-id="{{-- $supplier->id  --}}" wire-click="deleteInventory('su', {{-- $supplier->id --}})" />

                                    <div class="grid grid_accessory list">
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div>content</div>
                                        <div class="flex flex_x_end">content</div>
                                        <div class="flex flex_x_end">
                                            <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                            <a wire:click="showModalOnAccessoryUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endfor       

                            
                @elseif ($this->myTab() == 4)
                    
                    <x-layout.lists-section>               

                        <x-layout.lists-section.lists-title list-for="grid_supplier">
                            <div>{{ Str::title('Supplier name') }}</div>
                            <div>{{ Str::title('Contact no') }}</div>
                            <div>{{ Str::title('address') }}</div>
                            <div>{{ Str::title('bank') }}</div>
                            <div>{{ Str::title('account no') }}</div>
                            <div>{{ Str::title('branch') }}</div>
                            <div class="flex flex_x_end">{{ Str::title('action') }}</div>
                        </x-layout.lists-section.lists-title>

                        @forelse ($suppliers as $supplier)

                            <x-layout.lists-section.lists-container>
                                <x-organisms.popup-delete item-id="{{ $supplier->id  }}" wire-click="deleteInventory('su', {{ $supplier->id }})" />
                                <x-layout.lists-section.lists-list list-for="grid_supplier">

                                    <div>{{ $supplier->supplier_name }}</div>
                                    <div>{{ $supplier->supplier_contact_no }}</div>
                                    <div>{{ $supplier->supplier_address }}</div>
                                    <div>{{ $supplier->supplier_bank }}</div>
                                    <div>{{ $supplier->supplier_acc_no }}</div>
                                    <div>{{ $supplier->supplier_branch }}</div>
                                    <div class="flex flex_x_end">
                                        <a onclick="getElementById('delete{{ $supplier->id  }}').style.right = '0px'" class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                        <a wire:click="showModalOnSupplierUpdate({{ $supplier->id }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                    </div>                                  
                                    
                                </x-layout.lists-section.lists-container>
                            </x-layout.lists-section.lists-container>

                        @empty
                            <x-layout.lists-section.list-empty empty-message="No Results."/>
                        @endforelse

                    </x-layout.lists-section>

                @elseif ($this->myTab() == 5)
                    
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
                @endif
            </div>
        @endsection



</x-layout.page-content>

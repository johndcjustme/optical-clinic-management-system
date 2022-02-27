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

        @section('section-heading-left')
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
        @endsection
        @section('section-heading-right')
                @switch($this->myTab())
                    @case(1)
                            <div>
                                <x-input.search wire-model="searchLense"/>
                            </div>
                            <div class="flex gap_1">
                                <x-atom.sort>
                                    <x-atom.sort.sort-content 
                                        for=""
                                        span="Entries"
                                        wire-model="le_paginateVal"
                                        name=""
                                        val="" 
                                    />                                
                                    <x-atom.sort.sort-content 
                                        for="az"
                                        span="A-Z"
                                        wire-model="le_sortDirection"
                                        name="sort"
                                        val="asc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="za"
                                        span="Z-A"
                                        wire-model="le_sortDirection"
                                        name="sort"
                                        val="desc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="l_modified"
                                        span="Last Modified"
                                        wire-model="sortBy('le', 'created_at')"
                                        name="sort"
                                        val="" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="f_modified"
                                        span="First Modified"
                                        wire-model="le_sortDirection"
                                        name="sort"
                                        val="first_modified" 
                                    />
                                </x-atom.sort>
                                
                            </div>
                            <div>
                                <x-atom.btn-circle wire-click="inventoryShowModal('isAdd', 'le', null)"/>
                            </div>
                        @break
                    
                    @case(2)
                        {{-- <div class="flex" style="gap: 0.5em"> --}}
                            <div>
                                <x-input.search wire-model="searchFrame"/>
                            </div>
                            <div class="flex gap_1">
                                <x-atom.sort>
                                    <x-atom.sort.sort-content 
                                        for=""
                                        span="Entries"
                                        wire-model="fr_paginateVal"
                                        name=""
                                        val="" 
                                    /> 
                                    <x-atom.sort.sort-content 
                                        for="az"
                                        span="A-Z"
                                        wire-model="fr_sortDirection"
                                        name="sort"
                                        val="asc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="za"
                                        span="Z-A"
                                        wire-model="fr_sortDirection"
                                        name="sort"
                                        val="desc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="l_modified"
                                        span="Last Modified"
                                        wire-model="fr_sortDirection"
                                        name="sort"
                                        val="last_modified" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="f_modified"
                                        span="First Modified"
                                        wire-model="fr_sortDirection"
                                        name="sort"
                                        val="first_modified" 
                                    />
                                </x-atom.sort>
                            </div>
                            
                            <div>
                                <x-atom.btn-circle wire-click="inventoryShowModal('isAdd', 'fr', null)"/>
                            </div>
                        {{-- </div> --}}
                        @break

                    @case(3)
                        {{-- <div class="flex" style="gap: 0.5em"> --}}
                            <div>
                                <x-input.search wire-model="searchAccessory"/>
                            </div>
                            <div class="flex gap_1">
                                <x-atom.sort>
                                    <x-atom.sort.sort-content 
                                        for=""
                                        span="Entries"
                                        wire-model="ac_paginateVal"
                                        name=""
                                        val="" 
                                    />  
                                    <x-atom.sort.sort-content 
                                        for="az"
                                        span="A-Z"
                                        wire-model="ac_SortDirection"
                                        name="sort"
                                        val="asc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="za"
                                        span="Z-A"
                                        wire-model="ac_SortDirection"
                                        name="sort"
                                        val="desc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="l_modified"
                                        span="Last Modified"
                                        wire-model="ac_SortDirection"
                                        name="sort"
                                        val="last_modified" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="f_modified"
                                        span="First Modified"
                                        wire-model="ac_SortDirection"
                                        name="sort"
                                        val="first_modified" 
                                    />
                                </x-atom.sort>
                            </div>
                          
                            <div>
                                <x-atom.btn-circle wire-click="inventoryShowModal('isAdd', 'ac', null)"/>
                            </div>
                        {{-- </div> --}}
                        @break

                    @case(4)
                        {{-- <div class="flex" style="gap: 0.5em"> --}}
                            <div>
                                <x-input.search wire-model="searchSupplier"/>
                            </div>
                            <div class="flex gap_1">
                                <x-atom.sort>
                                    <x-atom.sort.sort-content 
                                        for=""
                                        span="Entries"
                                        wire-model="su_paginateVal"
                                        name=""
                                        val="" 
                                    /> 
                                    <x-atom.sort.sort-content 
                                        for="az"
                                        span="A-Z"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="asc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="za"
                                        span="Z-A"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="desc" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="l_modified"
                                        span="Last Modified"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="last_modified" 
                                    />

                                    <x-atom.sort.sort-content 
                                        for="f_modified"
                                        span="First Modified"
                                        wire-model="su_sortDirection"
                                        name="sort"
                                        val="first_modified" 
                                    />
                                </x-atom.sort>
                            </div>
                         
                            <div>
                                <x-atom.btn-circle wire-click="inventoryShowModal('isAdd', 'su', null)"/>
                            </div>
                        {{-- </div> --}}
                        @break                        

                    @case(5)
                        
                        @break
                @endswitch
        @endsection

        @section('section-main')

            <div class="items">

                @switch($this->myTab())
                    @case(1)
                        <x-layout.lists-section>               
 
                            <x-layout.lists-section.lists-list list-for="grid_lens title">
                                <x-atom.column-title  
                                    wire-click="sortBy('le', 'lense_name')"
                                    col-title="Name"
                                    arrow-direction="{{ $this->le_sortColumn === 'lense_name' && $this->le_sortDirection === 'asc' }}"
                                />
                                <x-atom.column-title  
                                    wire-click="sortBy('le', 'lense_desc')"
                                    col-title="Description"
                                    arrow-direction="{{ $this->le_sortColumn === 'lense_desc' && $this->le_sortDirection === 'asc' }}"
                                />
                                <x-atom.column-title  
                                    wire-click=""
                                    col-title="Supplier"
                                    arrow-direction=""
                                />
                                <x-atom.column-title  
                                    wire-click="sortBy('le', 'lense_qty')"
                                    col-title="Qty"
                                    arrow-direction="{{ $this->le_sortColumn === 'lense_qty' && $this->le_sortDirection === 'asc' }}"
                                />
                                <x-atom.column-title  
                                    wire-click="sortBy('le', 'lense_price')"
                                    col-title="Price"
                                    arrow-direction="{{ $this->le_sortColumn === 'lense_price' && $this->le_sortDirection === 'asc' }}"
                                />
                            </x-layout.lists-section.lists-list>
                            @forelse ($lenses as $lense)

                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_lens list">

                                        <x-layout.lists-section.list-item 
                                            item-name="{{ $lense->lense_name }} fontBold" 
                                            item-desc="{{ $lense->lense_tint }}"
                                        />
                                        <x-layout.lists-section.list-item 
                                            item-name="{{ $lense->lense_desc }}" 
                                            item-desc=""
                                        />
                                        {{-- <div>
                                            <div>
                                                <b>
                                                    {{ $lense->lense_name }}
                                                </b>
                                                <p class="dark_200" style="font-size: 0.8rem">
                                                    {{ $lense->lense_tint }}
                                                </p>
                                            </div>
                                        </div> --}}
                                        {{-- <div>{{ $lense->lense_desc }}</div> --}}
                                        @isset ($lense->supplier_id)
                                            <x-layout.lists-section.list-item 
                                                item-name="{{ $lense->supplier->supplier_name }}" 
                                                item-desc=""
                                            />
                                        @endisset
                                        <x-layout.lists-section.list-item 
                                            item-name="{{ $lense->lense_qty }}" 
                                            item-desc=""
                                        />
                                        <x-layout.lists-section.list-item 
                                            item-name="{{ $lense->lense_price }}" 
                                            item-desc=""
                                        />

                                    </x-layout.lists-section.lists-list>
                                    <div class="actions">
                                        <x-layout.lists-section.action 
                                            item-id="{{ $lense->id }}" 
                                            wire-click-delete="deleteInventory('le', {{ $lense->id }})"
                                            wire-click-edit="inventoryShowModal('isUpdate', 'le', '{{ $lense->id }}')"
                                            photo="{{ asset('images/sample-image.jpg') }}"
                                        >
                                            <label for="">Tint</label>
                                            <p>{{ $lense->lense_tint }}</p>
                                            <label for="">Date Added</label>
                                            <p>{{ $lense->created_at }}</p>
                                        </x-layout.lists-section.action>
                                    </div>

                                </x-layout.lists-section.lists-container>

                            @empty
                                <x-layout.lists-section.list-empty empty-message="No Results."/>
                            @endforelse

                            {{$lenses->links('livewire.components.paginator')}}
                            
                        </x-layout.lists-section>
                        @break
                
                    @case(2)
                        <x-layout.lists-section>               

                            <x-layout.lists-section.lists-list list-for="grid_frame title">
                                <x-atom.column-title  
                                    wire-click="sortBy('fr', 'frame_name')"
                                    col-title="Name"    
                                    arrow-direction="{{ $this->fr_sortColumn === 'frame_name' && $this->fr_sortDirection === 'asc' }}"
                                />
                                <x-atom.column-title  
                                    wire-click="sortBy('fr', 'frame_desc')"
                                    col-title="Description"    
                                    arrow-direction="{{ $this->fr_sortColumn === 'frame_desc' && $this->fr_sortDirection === 'asc' }}"
                                />
                                <div>{{ Str::title('Supplier') }}</div>
                                <x-atom.column-title  
                                    wire-click="sortBy('fr', 'frame_qty')"
                                    col-title="Qty"    
                                    arrow-direction="{{ $this->fr_sortColumn === 'frame_qty' && $this->fr_sortDirection === 'asc' }}"
                                />
                                <x-atom.column-title  
                                    wire-click="sortBy('fr', 'frame_price')"
                                    col-title="Price"    
                                    arrow-direction="{{ $this->fr_sortColumn === 'frame_price' && $this->fr_sortDirection === 'asc' }}"
                                />
                            </x-layout.lists-section.lists-list>

                            @forelse ($frames as $frame)
                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_frame list">
                                        <div>{{ $frame->frame_name }}</div>
                                        <div>{{ $frame->frame_desc }}</div>
                                        @isset ($frame->supplier_id)
                                            <div>{{ $frame->supplier->supplier_name }}</div>
                                        @endisset
                                        <div>{{ $frame->frame_qty }}</div>
                                        <div>{{ $frame->frame_price }}</div>

                                    </x-layout.lists-section.lists-list>
                                    <div class="actions">
                                        <x-layout.lists-section.action 
                                            item-id="{{ $frame->id }}" 
                                            wire-click-delete="deleteInventory('fr', {{ $frame->id }})"
                                            wire-click-edit="inventoryShowModal('isUpdate', 'fr', '{{ $frame->id }}')"
                                            photo="{{ asset('images/sample-image.jpg') }}"
                                        >
                                            <label for="">Size</label>
                                            <p>{{ $frame->frame_size }}</p>
                                            <label for="">Date Added</label>
                                            <p>{{ $frame->created_at }}</p>
                                        </x-layout.lists-section.action>
                                    </div>

                                </x-layout.lists-section.lists-container>
                            @empty
                                <x-layout.lists-section.list-empty empty-message="No Results."/>
                            @endforelse
                            {{$frames->links('livewire.components.paginator')}}
                        </x-layout.lists-section>          
                        @break

                    @case(3)
                        <x-layout.lists-section>               

                            <x-layout.lists-section.lists-list list-for="grid_accessory title"> 
                                <x-atom.column-title  
                                    wire-click="sortBy('ac', 'accessory_name')"
                                    col-title="Name"    
                                    arrow-direction="{{ $this->ac_sortColumn === 'accessory_name' && $this->ac_sortDirection === 'asc' }}"
                                />
                                <x-atom.column-title  
                                    wire-click="sortBy('ac', 'accessory_desc')"
                                    col-title="Description"    
                                    arrow-direction="{{ $this->ac_sortColumn === 'accessory_desc' && $this->ac_sortDirection === 'asc' }}"
                                />
                                <div>{{ Str::title('Supplier') }}</div>
                                <x-atom.column-title  
                                    wire-click="sortBy('ac', 'accessory_qty')"
                                    col-title="Qty"    
                                    arrow-direction="{{ $this->ac_sortColumn === 'accessory_qty' && $this->ac_sortDirection === 'asc' }}"
                                />
                                <x-atom.column-title  
                                    wire-click="sortBy('ac', 'accessory_price')"
                                    col-title="Price"    
                                    arrow-direction="{{ $this->ac_sortColumn === 'accessory_price' && $this->ac_sortDirection === 'asc' }}"
                                />
                            </x-layout.lists-section.lists-list>

                            @forelse ($accessories as $accessory)

                                <x-layout.lists-section.lists-container>
                                    <x-layout.lists-section.lists-list list-for="grid_accessory list">

                                        <div>{{ $accessory->accessory_name }}</div>
                                        <div>{{ $accessory->accessory_desc }}</div>
                                        @isset($accessory->supplier_id)
                                            <div>{{ $accessory->supplier->supplier_name }}</div>
                                        @endisset
                                        <div>{{ $accessory->accessory_qty }}</div>
                                        <div>{{ $accessory->accessory_price }}</div>

                                    </x-layout.lists-section.lists-list>
                                    <div class="actions">
                                        <x-layout.lists-section.action 
                                            item-id="{{ $accessory->id }}" 
                                            wire-click-delete="deleteInventory('ac', {{ $accessory->id }})"
                                            wire-click-edit="inventoryShowModal('isUpdate', 'ac', '{{ $accessory->id }}')"
                                            photo="{{ asset('images/sample-image.jpg') }}"
                                        >
                                            <label for="">Item type</label>
                                            <p>{{ $accessory->item_type }}</p>
                                        </x-layout.lists-section.action>
                                    </div>

                                </x-layout.lists-section.lists-container>
                            @empty
                                <x-layout.lists-section.list-empty empty-message="No Results."/>
                            @endforelse
                            {{$accessories->links('livewire.components.paginator')}}
                        </x-layout.lists-section>
                        @break

                    @case(4)

                            <x-layout.lists-section>               

                                <x-layout.lists-section.lists-list list-for="grid_supplier title">
                                    <x-atom.column-title  
                                        wire-click="sortBy('su', 'supplier_name')"
                                        col-title="Supplier Name"    
                                        arrow-direction="{{ $this->su_sortColumn === 'supplier_name' && $this->su_sortDirection === 'asc' }}"
                                    />
                                    <x-atom.column-title  
                                        wire-click=""
                                        col-title="Phone"    
                                        arrow-direction=""
                                    />
                                    <div>{{ Str::title('Email') }}</div>
                                    <div>{{ Str::title('address') }}</div>
                                </x-layout.lists-section.lists-list>

                                @forelse ($suppliers as $supplier)

                                    <x-layout.lists-section.lists-container>
                                        <x-layout.lists-section.lists-list list-for="grid_supplier list">

                                            <div>{{ $supplier->supplier_name }}</div>
                                            <div>{{ $supplier->supplier_contact_no }}</div>
                                            <div>{{ $supplier->supplier_email }}</div>
                                            <div>{{ $supplier->supplier_address }}</div>

                                        </x-layout.lists-section.lists-list>
                                        <div class="actions">
                                            <x-layout.lists-section.action 
                                                item-id="{{ $supplier->id }}" 
                                                wire-click-delete="deleteInventory('su', {{ $supplier->id }})"
                                                wire-click-edit="inventoryShowModal('isUpdate', 'su', '{{ $supplier->id }}')"
                                                photo="{{ asset('images/sample-image.jpg') }}"
                                            >
                                                <label for="">Bank</label>
                                                <p>{{ $supplier->supplier_bank }}</p>
                                                <label for="">Account no.</label>
                                                <p>{{ $supplier->supplier_acc_no }}</p>
                                                <label for="">Branch</label>
                                                <p>{{ $supplier->supplier_branch }}</p>
                                            </x-layout.lists-section.action>
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

                               
                        @break
                        
                @endswitch

            </div>

        @endsection
        
</x-layout.page-content>
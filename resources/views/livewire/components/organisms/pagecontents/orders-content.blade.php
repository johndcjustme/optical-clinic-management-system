<x-layout.page-content>

    @section('section-page-title', 'Orders')

    @section('section-links')
            <x-atom.tab-links.link tab-title="All Orders" wire-click="myTab(1)" sub-page="{{ $this->myTab == 1 }}"/>
            <x-atom.tab-links.link tab-title="Pending" wire-click="myTab(2)" sub-page="{{ $this->myTab == 2 }}"/>
            <x-atom.tab-links.link tab-title="Received" wire-click="myTab(3)" sub-page="{{ $this->myTab == 3 }}"/>
            <x-atom.tab-links.link tab-title="Claimed" wire-click="myTab(4)" sub-page="{{ $this->myTab == 4 }}"/>
    @endsection

    @section('section-heading')

        <div class="flex gap_1">
            <h5>
                @if ($this->myTab == 1)
                    ALL ORDERS
                @elseif ($this->myTab == 2)
                    PENDING
                @elseif ($this->myTab == 3)
                    RECEIVED
                @elseif ($this->myTab == 3)
                    CLAIMED
                @endif
            </h5>
        </div>

        
        <div class="flex gap_1">
            
            @if ($this->myTab == 1) 

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
                    <input type="search" name="" id="" placeholder="Search">
                </div>
                <div>
                    <button wire:click="inventoryShowModal('addLe')"><i class="fas fa-plus"></i> add</button>
                </div>

            @elseif ($this->myTab == 2)

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
                    <input type="search" name="" id="" placeholder="Search">
                </div>
                <div>
                    <button wire:click="inventoryShowModal('addLe')"><i class="fas fa-plus"></i> add</button>
                </div>

            @elseif ($this->myTab == 3)

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
                    <input type="search" name="" id="" placeholder="Search">
                </div>
                <div>
                    <button wire:click="inventoryShowModal('addLe')"><i class="fas fa-plus"></i> add</button>
                </div>

            @endif

        </div>

     

    @endsection

    @section('section-main')

        <div class="items">

            @if($this->myTab == 1)

                <div class="grid grid_order title">
                    <div>{{ Str::title('Order #') }}</div>
                    <div>{{ Str::title('patient name') }}</div>
                    <div>{{ Str::title('Product') }}</div>
                    <div>{{ Str::title('date') }}</div>
                    <div>{{ Str::title('status') }}</div>
                    <div class="flex flex_x_end">{{ Str::title('price') }}</div>
                    <div class="flex flex_x_end">{{ Str::title('action') }}</div>
                </div>

                @for ($i=1; $i<12; $i++)
                    <div class="grid grid_order list">
                        <div>dsdfdf</div>
                        <div>sdsdsd</div>
                        <div>sdsdsd</div>
                        <div>sdsdsd</div>
                        <div>
                            <select name="" id="" class="noformat">
                                <option value="" selected>Pending</option>
                                <option value="">Received</option>
                                <option value="">Claimed</option>
                            </select>
                        </div>
                        <div class="flex flex_x_end">6000</div>
                        <div class="flex flex_x_end">
                            <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                            <a wire:click="showModalOnLensUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    @endsection


</x-layout.page-content>

@includeIf('livewire.components.organisms.table.include-top-inventory-table')
    {{-- head --}}

        <div class="flex flex_x_between">
            <div>
                <h4>
                    @if ($this->myTable() == 1)
                        LENSES
                    @elseif ($this->myTable() == 2)
                        FRAMES
                    @elseif ($this->myTable() == 3)
                        ACCESSORRIES
                    @elseif ($this->myTable() == 4)
                        SUPPLIERS
                    @endif
                </h4>
            </div>
            <div class="flex flex_y_center gap_1">

                @if ($this->myTable() == 1)

                    <div class="flex gap_1">
                        <div class="flex gap_1">
                            <select class="font_small" name="" id="">
                                <option value="" selected>Name</option>
                                <option value="">Type</option>
                                <option value="">Tint</option>
                                <option value="">Qty</option>
                                <option value="">Price</option>
                            </select>
                            <select class="font_small" name="" id="">
                                <option value="">ASC</option>
                                <option value="">DESC</option>
                            </select>
                        </div>
                        <div>
                            <input type="search" name="" id="" placeholder="Search Lens">
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addLens')">NEW ITEM</button>
                        </div>
                    </div>

                @elseif ($this->myTable() == 2)
                    
                    <div class="flex gap_1">
                        <div class="flex gap_1">
                            <select class="font_small" name="" id="">
                                <option value="" selected>Name</option>
                                <option value="">Type</option>
                                <option value="">Tint</option>
                                <option value="">Qty</option>
                                <option value="">Price</option>
                            </select>
                            <select class="font_small" name="" id="">
                                <option value="">ASC</option>
                                <option value="">DESC</option>
                            </select>
                        </div>
                        <div>
                            <input type="search" name="" id="" placeholder="Search Frame">
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addFrame')">NEW ITEM</button>
                        </div>
                    </div>
                    
                @elseif ($this->myTable() == 3)
                    
                    <div class="flex gap_1">
                        <div class="flex gap_1">
                            <select class="font_small" name="" id="">
                                <option value="" selected>Name</option>
                                <option value="">Type</option>
                                <option value="">Tint</option>
                                <option value="">Qty</option>
                                <option value="">Price</option>
                            </select>
                            <select class="font_small" name="" id="">
                                <option value="">ASC</option>
                                <option value="">DESC</option>
                            </select>
                        </div>
                        <div>
                            <input type="search" name="" id="" placeholder="Search Accessory">
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addAccessory')">NEW ITEM</button>
                        </div>
                    </div>
                    
                @elseif ($this->myTable() == 4)
                
                    <div class="flex gap_1">
                        <div class="flex gap_1">
                            <select class="font_small" name="" id="">
                                <option value="" selected>Name</option>
                                <option value="">Address</option>
                                <option value="">Branch</option>
                            </select>
                            <select class="font_small" name="" id="">
                                <option value="">ASC</option>
                                <option value="">DESC</option>
                            </select>
                        </div>
                        <div>
                            <input type="search" name="" id="" placeholder="Search Supplier">
                        </div>
                        <div>
                            <button wire:click="inventoryShowModal('addSupplier')">ADD SUPPLIER</button>
                        </div>
                    </div>
                    
                @endif

            </div>
        </div>
        
        <br>

        <table class="hoverable full_w">

            @if ($this->myTable() == 1)

                        <tr>
                            <th>{{ Str::title('lens name') }}</th>
                            <th>{{ Str::title('lens type') }}</th>
                            <th>{{ Str::title('tint') }}</th>
                            <th>{{ Str::title('supplier') }}</th>
                            <th style="width: 80px">{{ Str::title('qty') }}</th>
                            <th class="text_right" style="width: 80px">{{ Str::title('Price') }}</th>
                            <th class="text_right" style="width: 80px">{{ Str::title('acion') }}</th>
                        </tr>


                        @for ($i=1; $i<8; $i++)
                            <tr>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td class="text_right">content</td>
                                <td class="text_right">
                                    <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                    <a class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                </td>
                            </tr>
                        @endfor

            @elseif ($this->myTable() == 2)
               
                        <tr>
                            <th>{{ Str::title('frame name') }}</th>
                            <th>{{ Str::title('frame type') }}</th>
                            <th>{{ Str::title('size') }}</th>
                            <th>{{ Str::title('supplier') }}</th>
                            <th style="width: 80px">{{ Str::title('qty') }}</th>
                            <th class="text_right" style="width: 80px">{{ Str::title('Price') }}</th>
                            <th class="text_right" style="width: 80px">{{ Str::title('acion') }}</th>
                        </tr>


                        @for ($i=1; $i<8; $i++)
                            <tr>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td class="text_right">content</td>
                                <td class="text_right">
                                    <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                    <a class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                </td>
                            </tr>
                        @endfor       

                
            @elseif ($this->myTable() == 3)
               
            
                        <tr>
                            <th>{{ Str::title('accessory name') }}</th>
                            <th>{{ Str::title('accessory type') }}</th>
                            <th>{{ Str::title('type') }}</th>
                            <th>{{ Str::title('supplier') }}</th>
                            <th style="width: 80px">{{ Str::title('qty') }}</th>
                            <th class="text_right" style="width: 80px">{{ Str::title('Price') }}</th>
                            <th class="text_right" style="width: 80px">{{ Str::title('acion') }}</th>
                        </tr>


                        @for ($i=1; $i<8; $i++)
                            <tr>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td class="text_right">content</td>
                                <td class="text_right">
                                    <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                    <a class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                </td>
                            </tr>
                        @endfor       

                        
            @elseif ($this->myTable() == 4)
                
            
                        <tr>
                            <th>{{ Str::title('Supplier name') }}</th>
                            <th>{{ Str::title('contact') }}</th>
                            <th>{{ Str::title('address') }}</th>
                            <th>{{ Str::title('bank') }}</th>
                            <th>{{ Str::title('account no.') }}</th>
                            <th>{{ Str::title('branch') }}</th>
                            <th class="text_right" style="width: 80px">{{ Str::title('acion') }}</th>
                        </tr>


                        @for ($i=1; $i<8; $i++)
                            <tr>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td>content</td>
                                <td class="text_right">
                                    <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                                    <a class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                                </td>
                            </tr>
                        @endfor       


            @endif
        
        </table>

@includeIf('livewire.components.organisms.table.include-bottom-inventory-table')

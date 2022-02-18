<x-layout.page-content>

    @section('section-page-title', 'Appointments')

    @section('section-links')
            <x-atom.tab-links.link tab-title="Ongoing" wire-click="myTab(1)" sub-page="{{ $this->myTab == 1 }}"/>
            <x-atom.tab-links.link tab-title="Completed" wire-click="myTab(2)" sub-page="{{ $this->myTab == 2 }}"/>
    @endsection

    @section('section-heading')

        <div class="flex gap_1">
            <h5>
                @if ($this->myTab == 1)
                    ONGOING
                @elseif ($this->myTab == 2)
                    COMPLETED
                @endif
            </h5>
        </div>

        @if ($this->myTab == 1) 

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
                    <input type="search" name="" id="" placeholder="Search">
                </div>
                <div>
                    <button wire:click="inventoryShowModal('addLe')"><i class="fas fa-plus"></i> add</button>
                </div>
            </div>

        @elseif ($this->myTab == 2)

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
                    <input type="search" name="" id="" placeholder="Search">
                </div>
                <div>
                    <button wire:click="inventoryShowModal('addLe')"><i class="fas fa-plus"></i> add</button>
                </div>
            </div>

        @endif

    @endsection

    @section('section-main')

        <div class="items">

            @if($this->myTab == 1)

                <div class="grid grid_appointment title">
                    <div>{{ Str::title('patient name') }}</div>
                    <div>{{ Str::title('appointment date') }}</div>
                    <div>{{ Str::title('reschedule') }}</div>
                    <div>{{ Str::title('status') }}</div>
                    <div>{{ Str::title('phone number') }}</div>
                    <div>{{ Str::title('color') }}</div>
                    <div class="flex flex_x_end">{{ Str::title('action') }}</div>
                </div>

                {{-- @foreach ($schedsettings as $schedsetting)
                 {{ $schedsetting->schedset_name }}
                 @endforeach --}}
                {{-- @for ($i=1; $i<12; $i++)
                    <div class="grid grid_appointment list">
                        <div>
                            <input class="noformat" list="suggest_name" type="text" value="John Doe">
                            <datalist id="suggest_name">
                                <option value="data 1">Lianga</option>
                                <option value="data 2"></option>
                                <option value="data 3"></option>
                                <option value="data 4"></option>
                            </datalist>
                        </div>
                        <div><input class="noformat" type="date"></div>
                        <div><input class="noformat" type="date"></div>
                        <div>
                            <select class="noformat" name="" id="">
                                <option value="" selected>Ongoiong</option>
                                <option value="">Missed</option>
                                <option value="">Rescheduled</option>
                                <option value="">Completed</option>
                            </select>
                        </div>
                        <div>
                            <input class="noformat" type="number" min="0" value="0947482393457">
                        </div>
                        <div>
                            <input id="barcolor" class="action noformat" type="color"value="#2B4FFF" style="height: 20px; width:20px; border-radius: 50%;">
                        </div>
                        <div class="flex flex_x_end">
                            <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                            <a wire:click="showModalOnLensUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                        </div>
                    </div>
                @endfor --}}

            @elseif($this->myTab == 2)

                <div class="grid grid_appointment title">
                    <div>{{ Str::title('patient name') }}</div>
                    <div>{{ Str::title('appointment date') }}</div>
                    <div>{{ Str::title('reschedule') }}</div>
                    <div>{{ Str::title('status') }}</div>
                    <div>{{ Str::title('phone number') }}</div>
                    <div>{{ Str::title('color') }}</div>
                    <div class="flex flex_x_end">{{ Str::title('action') }}</div>
                </div>

                @for ($i=1; $i<12; $i++)
                    <div class="grid grid_appointment list">
                        <div>
                            <input class="noformat" list="suggest_name" type="text" value="John Doe">
                            <datalist id="suggest_name">
                                <option value="data 1">Lianga</option>
                                <option value="data 2"></option>
                                <option value="data 3"></option>
                                <option value="data 4"></option>
                            </datalist>
                        </div>
                        <div><input class="noformat" type="date"></div>
                        <div><input class="noformat" type="date"></div>
                        <div>
                            <select class="noformat" name="" id="">
                                <option value="" selected>Completed</option>
                                <option value="">Missed</option>
                            </select>
                        </div>
                        <div>
                            <input class="noformat" type="number" min="0" value="0947482393457">
                        </div>
                        <div>
                            <input id="barcolor" class=" action noformat" type="color"value="#2B4FFF" style="height: 20px; width:20px; border-radius: 50%;">
                        </div>
                        <div class="flex flex_x_end">
                            <a class="action" href="#"><i class='fas fa-trash-alt'></i></a>
                            <a wire:click="showModalOnLensUpdate({{ $i }})" class="action" href="#"><i class="fas fa-edit ml_10"></i></a>
                        </div>
                    </div>
                @endfor
            @endif

        </div>


        @if ($this->shedsettings_isOpen == true) 
            <x-organisms.panel-settings title="Schedule Settings">
                @includeIf('livewire.components.organisms.pagecontents.appointments-content.appointment-settings')
                {{-- <x-organisms.panel-settings.appointment-settings/> --}}
            </x-organisms.panel-settings>
        @endif

        <button wire:click="$toggle('shedsettings_isOpen')" class="circle panel_settings_button">
            <i class="fa-solid fa-gear"></i>
        </button>

    @endsection

</x-layout.page-content>

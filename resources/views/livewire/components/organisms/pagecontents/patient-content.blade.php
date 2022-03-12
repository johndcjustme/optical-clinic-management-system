<x-layout.page-content>

    @section('section-page-title', 'Patients')

    @section('section-links')
        <x-atom.tab-links.link tab-title="Patients" wire-click="$set('tab', 1)" sub-page="{{ $tab === 1}}" />
        <x-atom.tab-links.link tab-title="Queue (4)" wire-click="$set('tab', 2)" sub-page="{{ $tab === 2}}" />
    @endsection

    @section('section-heading-left')
        heading left contentd
    @endsection

    @section('section-heading-right')
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
            <x-atom.btn-circle wire-click="patientShowModal('isAdd', null)"/>
        </div>
    @endsection

    @section('section-main')

        <div class="items">
            @switch($tab)
                @case(1)
                    <x-layout.lists-section>
                        <h5 class="dark_200 m_5">Today's patients</h5>
                        {{-- @for ($i = 1; $i < 4; $i++) --}}
                        @forelse ($pts as $pt)
         
                            <x-layout.lists-section.lists-container>
                                <x-layout.lists-section.lists-list list-for="grid_patient list">
                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                        <div class="flex flex_center">
                                            <input type="checkbox" class="pointer">
                                        </div>
                                    </x-layout.lists-section.list-item>
                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                        <div class="flex gap_1">
                                            <div>
                                                <x-atom.profile-photo size="2.5em" path="storage/photos/avatars/default-avatar-pt.png" />
                                            </div>
                                            <div class="flex flex_y_center">
                                                <div>
                                                    <p>
                                                        <strong>
                                                            {{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}}
                                                        </strong>
                                                    </p>
                                                    @if (isset($pt->patient_address))
                                                        <p class="dark_200 mt_2">
                                                            <small>
                                                                {{ $pt->patient_address }}
                                                            </small>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </x-layout.lists-section.list-item>
                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                        <p style="font-size: 0.8rem">
                                            <i class="fa-solid fa-phone mr_3"></i> 
                                            {{ $pt->patient_mobile }}
                                        </p>
                                    </x-layout.lists-section.list-item>
                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                        <div class="flex flex_center text_center full_w">
                                            <p class="py_2 px_6 bg_red" style="border-radius: 3em; font-size:0.75rem">Scheduled</p>
                                        </div>
                                    </x-layout.lists-section.list-item>        
                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                        <div class="flex flex_y_center full_w" style="gap:0.8em">
                                            <div>
                                                <div wire:click.prevent="patientShowModal('isExam', {{ $pt->id }})" class="clickable_icon">
                                                    <i class="fa-solid fa-pen  green"></i>
                                                </div>
                                            </div>
                                            <div wire:click.prevent="patientShowModal('isPurchase', {{ $pt->id }})">
                                                <div class="clickable_icon">
                                                    <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 81, 0)"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </x-layout.lists-section.list-item>
                                    <x-layout.lists-section.list-item item-name="" item-desc="">
                                        <div class="flex flex_center">
                                            <x-atom.more>
                                                <x-atom.more.option wire-click="patientShowModal('isUpdate', {{ $pt->id }})" option-name="Edit" />
                                            </x-atom.more>
                                        </div>
                                    </x-layout.lists-section.list-item>
                                </x-layout.lists-section.lists-list>
                            </x-layout.lists-section.lists-container>
                                               
                        @empty
                            
                        @endforelse
                        {{-- @endfor --}}
                    </x-layout.lists-section>
                    @break

                @case(2)
                    queue
                    @break
            
                @default
                    
            @endswitch
        </div>

    @endsection

</x-layout.page-content>

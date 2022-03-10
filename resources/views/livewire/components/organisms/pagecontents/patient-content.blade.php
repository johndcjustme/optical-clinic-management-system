<x-layout.page-content>

    @section('section-page-title', 'Patients')

    @section('section-links')
        <x-atom.tab-links.link tab-title="Patients" wire-click="" sub-page="" />
        <x-atom.tab-links.link tab-title="Queue" wire-click="" sub-page="" />
    @endsection

    @section('section-heading-left')
        heading left content
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
            <x-atom.btn-circle wire-click="patientShowModal('isAddPatient', null)"/>
        </div>
    @endsection

    @section('section-main')


        <div class="items">
            <x-layout.lists-section>
                <h5 class="dark_200 m_5">Today's patients</h5>
                @for ($i = 1; $i < 4; $i++)
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
                                        <x-atom.profile-photo size="2.5em" path="images/john-profile2.png" />
                                    </div>
                                    <div>
                                        <p><b>John Doe</b></p>
                                        <p class="dark_200 mt_2" style="font-size: 0.75rem">Tandag City</p>
                                    </div>
                                </div>
                            </x-layout.lists-section.list-item>

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <p style="font-size: 0.85rem"><i class="fa-solid fa-phone mr_3"></i> 09484710737</p>
                            </x-layout.lists-section.list-item>

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center text_center full_w">
                                    <p class="py_2 px_6 bg_red" style="border-radius: 3em; font-size:0.75rem">Scheduled</p>
                                </div>
                            </x-layout.lists-section.list-item>
                            
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

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center full_w gap_1">
                                    <div>
                                        <x-atom.btn-bordered color="green" label="exam" height="2.5em" wire-click=""/>
                                    </div>
                                    <div>
                                        <x-atom.btn-bordered color="#ff0000" label="purchase" height="2.5em" wire-click=""/>
                                    </div>
                                </div>
                            </x-layout.lists-section.list-item>

                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center">
                                    <x-atom.more id="patient{{ $i }}">
                                        <x-atom.more.option wire-click="" option-name="Edit" />
                                        <x-atom.more.option wire-click="" option-name="Add to Queue" />
                                    </x-atom.more>
                                </div>
                            </x-layout.lists-section.list-item>

                        </x-layout.lists-section.lists-list>
                    </x-layout.lists-section.lists-container>
                @endfor

            </x-layout.lists-section>
        </div>

    @endsection

</x-layout.page-content>

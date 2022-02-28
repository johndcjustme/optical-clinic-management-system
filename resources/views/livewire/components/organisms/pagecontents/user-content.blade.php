<x-layout.page-content>

    @section('section-page-title', 'Users')

    @section('section-links')

    @endsection

    @section('section-heading-left')
        
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
            <x-atom.btn-circle wire-click="userShowModal('isAddUser', null)"/>
        </div>
    @endsection

    @section('section-main')
        <div class="items">
            <x-layout.lists-section>
               


                @for ($i=0; $i<5; $i++)
                    <x-layout.lists-section.lists-container>
                        <x-layout.lists-section.lists-list list-for="grid_user list">
    
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
                                        <p class="dark_200 mt_2" style="font-size: 0.75rem">Staff</p>
                                    </div>
                                </div>
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_y_center">
                                    <input id="canAdd{{ $i }}" class="mr_3" type="checkbox" class="pointer">
                                    <label for="canAdd{{ $i }}">Can Add</label>
                                </div> 
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_y_center">
                                    <input id="canUpdate{{ $i }}" class="mr_3" type="checkbox" class="pointer">
                                    <label for="canUpdate{{ $i }}">Can Update</label>
                                </div> 
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_y_center">
                                    <input id="canDeleteEdit{{ $i }}" class="mr_3" type="checkbox" class="pointer">
                                    <label for="canDeleteEdit{{ $i }}">Can Delete</label>
                                </div> 
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center">
                                    <x-atom.more id="user{{ $i }}">
                                        <x-atom.more.option wire-click="userShowModal('isUpdateUser', null)" option-name="Edit" />
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
<x-layout.page-content>

    @section('section-page-title', 'Users')

    @section('section-links')
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, aperiam.</p>
    @endsection

    @section('section-heading-left')
        <button wire:click.prevent="deleteUsers" class="bg_red {{ !empty($selectedUsers) ? '' : 'nodisplay' }}">Delete ({{ count($selectedUsers) }})</button>
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
               
                @foreach ($users as $user)
                    <x-layout.lists-section.lists-container>
                        <x-layout.lists-section.lists-list list-for="grid_user list">
    
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center">
                                    <input wire:model="selectedUsers" type="checkbox" class="pointer" value="{{ $user->id }}">
                                </div>
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex gap_1">
                                    <div>
                                        <x-atom.profile-photo size="2.5em" path="storage/photos/avatars/{{ $user->avatar }}" />
                                    </div>
                                    <div>
                                        <p><b>{{ $user->name }}</b></p>
                                        <p class="dark_200 mt_2" style="font-size: 0.75rem">{{ $user->user_role }}</p>
                                    </div>
                                </div>
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_y_center">
                                    <input id="canAdd{{ $user->id }}" class="mr_3" type="checkbox" class="pointer">
                                    <label for="canAdd{{ $user->id }}">Can Add</label>
                                </div> 
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_y_center">
                                    <input id="canUpdate{{ $user->id }}" class="mr_3" type="checkbox" class="pointer">
                                    <label for="canUpdate{{ $user->id }}">Can Update</label>
                                </div> 
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_y_center">
                                    <input id="canDeleteEdit{{ $user->id }}" class="mr_3" type="checkbox" class="pointer">
                                    <label for="canDeleteEdit{{ $user->id }}">Can Delete</label>
                                </div> 
                            </x-layout.lists-section.list-item>
                            <x-layout.lists-section.list-item item-name="" item-desc="">
                                <div class="flex flex_center">
                                    <x-atom.more>
                                        <x-atom.more.option wire-click="userShowModal('isUpdateUser', {{ $user->id }})" option-name="Edit" />
                                    </x-atom.more>
                                </div>
                            </x-layout.lists-section.list-item>

                        </x-layout.lists-section.lists-list>
                    </x-layout.lists-section.lists-container>     
                @endforeach
            </x-layout.lists-section>
        </div>
    @endsection

</x-layout.page-content>
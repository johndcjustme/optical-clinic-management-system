<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Users"
            desc="Lorem Ipsum dolor set amet."/>
    @endsection

    @section('section-links')
        {{-- <div class="ui compact tiny menu">
            <div wire:click.prevent="$set('role', '')" class="link item">All</div>
        </div> --}}
    @endsection

    @section('section-heading-left')
        @if (count($selectedUsers) > 0)
            <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedUsers', [])" class="left pointing tiny">
                <x-slot name="label">
                    {{ count($selectedUsers) }} Selected 
                </x-slot>
                <x-slot name="menu"> 
                    @switch($subPage)
                        @case(1)
                            <div wire:click.prevent="deleteUsers" class="item"><i class="delete icon"></i> Delete</div>
                            @break
                        @default
                    @endswitch
                </x-slot>
            </x-atoms.ui.header-dropdown-menu>                
        @else
            <x-atoms.ui.header-add-btn label="Add User" wire-click="showModal('add', null)"/>
        @endif
    @endsection

    @section('section-heading-right')
        {{-- <div>
            <x-atoms.ui.search wire-model="searchUser" placeholder="Search..."/>
        </div>
        <x-molecules.ui.dropdown>
            <x-molecules.ui.dropdown.icon/>
            <x-molecules.ui.dropdown.menu>
                <div class="item">
                    <x-molecules.ui.dropdown.icon/>
                    <span class="text">Filter</span>
                    <x-molecules.ui.dropdown.menu>
                        <div wire:click.prevent="$set('filter', 'DATE_RANGE')" class="item">
                            All Users
                        </div>
                        <div class="divider"></div>
                        <div wire:click.prevent="$set('filter', 'DATE_RANGE')" class="item">
                            Admins Only
                        </div>
                        <div wire:click.prevent="$set('filter', 'DATE_SINGLE')" class="item">
                            Users Only
                        </div>
                    </x-molecules.ui.dropdown.menu>
                </div>
                <div class="item">
                    <x-molecules.ui.dropdown.icon/>
                    <span class="text">Showing {{ $pageNumber }} Entries</span>
                    <x-molecules.ui.dropdown.menu>
                        <x-organisms.ui.paginator-number/>
                    </x-molecules.ui.dropdown.menu>
                </div>
                <div wire:click.prevent="openModalRoles('add')" class="item">
                    Roles
                </div>
            </x-molecules.ui.dropdown.menu>
        </x-molecules.ui.dropdown> --}}
    @endsection

    @section('section-main')
        {{-- @foreach ($roles as $role) --}}
            {{-- @if ($users->where('role_id', $role->id)->count() > 0) --}}
                <x-organisms.ui.table class="selectable unstackable">
                    <x-slot name="thead">
                        <x-organisms.ui.table.th label="Name"/>
                        <x-organisms.ui.table.th label="Email Adderess" style="width:30em;"/>
                        <x-organisms.ui.table.th label="Date Added" style="width:15em"/>
                        <x-organisms.ui.table.th-more/>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse (App\Models\User::select('id', 'name', 'email', 'created_at')->whereRoleIs(['user'])->get() as $user)
                            <tr>
                                <x-organisms.ui.table.td 
                                    text="{{ $user->name }}"
                                    avatar="{{ avatar($user->avatar) }}"/>
                                <x-organisms.ui.table.td 
                                    text="{{ $user->email }}"/>
                                <x-organisms.ui.table.td 
                                    text="{{ humanReadableDate($user->created_at) }}"/>
                                <x-organisms.ui.table.td-more>
                                    <x-atom.more.option
                                        wire-click="showModal('update', {{ $user->id }})"
                                        option-name="Edit" />
                                    <x-atom.more.option 
                                        wire-click="deleteUser({{ $user->id }})"
                                        option-name="Delete" />
                                </x-organisms.ui.table.td>
                            </tr>
                        @empty
                            <x-organisms.ui.table.search-no-results colspan="5"/>
                        @endforelse
                    </x-slot>
                </x-organisms.ui.table>
            {{-- @endif --}}
        {{-- @endforeach --}}
    @endsection

</x-layout.page-content>
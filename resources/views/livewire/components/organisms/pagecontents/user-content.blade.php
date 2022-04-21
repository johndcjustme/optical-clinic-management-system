<x-layout.page-content>

    @section('section-page-title')
        <div class="">
            <div>
                <x-atoms.ui.header title="Users"/>
            </div>
            <div>
                <p>All Users {{ count($users) }}</p>
            </div>
        </div>
    @endsection

    @section('section-links')
        <div class="ui compact tiny menu">
            <div wire:click.prevent="$set('role', '')" class="link item @if(empty($role)) active @endif">All</div>
            @foreach ($allRoles as $menu)
                <div wire:click.prevent="$set('role', {{ $menu->id }})" class="link item @if($role == $menu->id) active @endif @if($users->where('role_id', $menu->id)->count() <= 0) disabled @endif">{{ $menu->role }}</div>
            @endforeach
        </div>
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
        <div>
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
        </x-molecules.ui.dropdown>
    @endsection

    @section('section-main')
        @foreach ($roles as $role)
            @if ($users->where('role_id', $role->id)->count() > 0)
                <x-organisms.ui.table class="selectable unstackable">
                    <x-slot name="thead">
                        <x-organisms.ui.table.th label="{{ Str::upper($role->role) . ' ' . count($users->where('role_id', $role->id))}}" colspan="6"/>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($users->where('role_id', $role->id) as $user)
                            <tr>
                                <x-organisms.ui.table.td 
                                    checkbox="selectedUsers" 
                                    checkbox-value="{{ $user->id }}"
                                    style="width: 3em"/>
                                <x-organisms.ui.table.td 
                                    text="{{ $user->name }}"
                                    avatar="{{ $this->storage($user->avatar) }}"/>
                                <x-organisms.ui.table.td 
                                    style="width:10em"
                                    text="{{ $user->role->role }}"/>
                                <x-organisms.ui.table.td 
                                    style="width:15em"
                                    text="{{ $user->email }}"/>
                                <x-organisms.ui.table.td 
                                    style="width:10em"
                                    text="{{ $this->date($user->created_at) }}"/>
                                <x-organisms.ui.table.td-more style="width:3em;">
                                    <x-atom.more.option
                                        wire-click="showModal('update', {{ $user->id }})"
                                        option-name="Edit"/>
                                    <x-atom.more.option 
                                        wire-click="deleteUser({{ $user->id }})"
                                        option-name="Delete"/>
                                </x-organisms.ui.table.td>
                            </tr>
                        @empty
                            <x-organisms.ui.table.search-no-results colspan="5"/>
                        @endforelse
                    </x-slot>
                </x-organisms.ui.table>
            @endif
        @endforeach
    @endsection

</x-layout.page-content>
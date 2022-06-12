@php
    if ($modal['add']) {
        $wireSubmitTo = 'addUser';
        $label = 'Add User';
        $formId = 'addUser';
    }
    if ($modal['update']) {
        $wireSubmitTo = 'updateUser';
        $label = 'Update User';
        $formId = 'updateUser';
    }
@endphp


<x-organisms.modal>

    @section('modal_title')
        <div class="x-flex">
            <div>
                @if (!$changePassword)
                    {{-- <label wire:click.prevent="$toggle('modalRoleTab')" class="btn btn-circle"><i class="fa-solid {{ $modalRoleTab ? 'fa-arrow-left' : 'fa-edit'}}"></i></label> --}}
                @endif
                @if ($modal['update'] && !$modalRoleTab)
                    <div class="tooltip" data-tip="{{ $changePassword ? 'Back' : 'Change Password' }}">
                        <label wire:click.prevent="$toggle('changePassword', true)" for="" class="btn btn-circle"><i class="fa-solid {{ $changePassword ? 'fa-arrow-left' : 'fa-key' }}"></i></label>
                    </div>
                @endif
            </div>

            <div style="margin-left: 0.5em">
                @if ($modalRoleTab)
                    <label wire:click.prevent="$toggle('confirmDeleteRole', true)" class="btn btn-circle btn-error" for="updateItem_from_inItem">
                        @if ($confirmDeleteRole)
                            <i class="fa-solid fa-remove"></i>
                        @else
                            <i class="fa-solid fa-trash"></i>
                        @endif
                    </label>
                @endif
            </div>
            
        </div>
        <div>
            <x-atoms.ui.modal-title>
                @if (!$modalRoleTab)
                    @if ($modal['add'])
                        ADD USER
                    @elseif ($modal['update'])
                        @if ($changePassword)
                            CHANGE PASSWORD
                        @else
                            UPDATE USER
                        @endif
                    @endif
                @else
                    ROLES
                @endif
            </x-atoms.ui.modal-title>
        </div>
        <div>
            @if ($modalRoleTab)
                <form wire:submit.prevent="addRole">
                    <div class="ui action input tiny @error('roleName') error @endError">
                        <input wire:model.defer="roleName" type="text" placeholder="Enter Role...">
                        <button typ="submit" class="ui button">Add</button>
                    </div>
                </form>
            @else 
                @if ($changePassword)
                    <label class="btn" for="change_password">Confirm Changes</label>
                @else
                    <x-atoms.ui.btn-close-modal/>
                    <label class="btn ml-2" for="create_or_update_user">Save</label>
                @endif

            @endif
        </div>
    @endsection
    
    @section('modal_body')
        @if ($changePassword)
            @if (session()->has('passwordUnmatched'))
                <div class="ui message tiny fluid red" style="width: 100%" x-init="$('.message .close').on('click', function() {$(this).closest('.message').transition('fade');});">
                    <i class="close icon"></i>
                    <div class="header">{{ session('passwordUnmatched') }}</div>
                    <p>Please try again.</p>
                </div>  
            @endif

            <form wire:submit.prevent="changePassword" class="mt-16">
                <div class="two fields">
                    <div class="field">
                        <x-atoms.ui.label>New Password <x-atoms.ui.required>@error('user.password') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="user.password" type="password" class="mb_7" placeholder="Minimum of 6 characters..."/>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label>Repeat Password <x-atoms.ui.required>@error('user.password_confirmation') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="user.password_confirmation" type="password" class="mb_7" placeholder="Minimum of 6 characters... "/>
                    </div>
                </div>
                <input type="submit" id="change_password" value="" style="opacity:0;" hidden>
            </form>

        @else
            @if (!$modalRoleTab)
                <form wire:submit.prevent="createOrUpdateUser">
                    <x-molecules.ui.field class="justify-items-center">
                        <label for="user_photo">
                            <div class="tooltip" data-tip="Click Avatar">                        
                                @if ($avatar)                            
                                    <x-atoms.ui.avatar src="{{ $avatar->temporaryUrl() }}" size="5em"/>
                                @else
                                    <x-atom.profile-photo size="5em" path="{{ avatar($user['avatar']) }}" />
                                @endif
                                <input type="file" wire:model="avatar" id="user_photo" style="opacity:0; height:0; width:0;">
                            </div>
                        </label>
                    </x-molecules.ui.field>

                    @error('avatar')
                        <div class="ui message tiny fluid red" style="width: 100%" x-init="$('.message .close').on('click', function() {$(this).closest('.message').transition('fade');});">
                            <i class="close icon"></i>
                            <div class="header">{{ $message }}</div>
                            <p>Please try again.</p>
                        </div>  
                    @enderror

                    @if (session()->has('passwordUnmatched'))
                        <div class="ui message tiny fluid red" style="width: 100%" x-init="$('.message .close').on('click', function() {$(this).closest('.message').transition('fade');});">
                            <i class="close icon"></i>
                            <div class="header">{{ session('passwordUnmatched') }}</div>
                            <p>Please try again.</p>
                        </div>  
                    @elseif (session()->has('passwordChanged'))
                        <div class="ui message tiny green" style="width: 100%">
                            <i class="close icon"></i>
                            <div class="header">{{ session('passwordChanged') }}</div>
                            <p>You can now go back.</p>
                        </div>  
                    @endif

                    {{-- @if (session()->has('passwordChanged'))
                    @endif --}}

                    @if ($modal['add'])
                        <x-molecules.ui.field class="grid-cols-2">
                            <div>
                                <x-atoms.ui.label>Name <x-atoms.ui.required>@error('user.name') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="user.name" type="text" class="mb_7" placeholder="Enter Name..."/>

                                <x-atoms.ui.label>Email Address <x-atoms.ui.required>@error('user.email') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="user.email" type="email" class="mb_7" placeholder="Enter Email Address..."/>
                            </div>
                            <div>
                                <x-atoms.ui.label>Password <x-atoms.ui.required>@error('user.password') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="user.password" type="password" class="mb_7" placeholder="Minimum of 6 characters..."/>

                                <x-atoms.ui.label>Repeat Password <x-atoms.ui.required>@error('user.password_confirmation') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="user.password_confirmation" type="password" class="mb_7" placeholder="Minimum of 6 characters... "/>
                            </div>
                        </x-molecules.ui.field>
                        
                    @elseif ($modal['update'])
                        <x-molecules.ui.field class="grid-cols-2">
                            <div>
                                <x-atoms.ui.label>Name <x-atoms.ui.required>@error('user.name') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="user.name" type="text" class="mb_7" placeholder="Enter Name..."/>
                            </div>
                            <div>
                                <x-atoms.ui.label>Email Address <x-atoms.ui.required>@error('user.email') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="user.email" type="email" class="mb_7" placeholder="Enter Email Address..."/>
                            </div>
                        </x-molecules.ui.field>
                    @endif


                    <div class="field">
                        <x-atoms.ui.label>Role <x-atoms.ui.required>@error('user.role') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                        <x-atoms.ui.select wire:model.defer="user.role" class="mb_7">
                            <option value="" selected hidden>Select</option>
                            @foreach (App\Models\Role::select(['id', 'display_name'])->get() as $role)
                                <option class="item" value="{{ $role->id }}">{{ $role->display_name }}</option>
                            @endforeach
                        </x-atoms.ui.select>
                    </div>


                    <input type="submit" value="" id="create_or_update_user" style="opacity:0; display:none" hidden>
    {{-- 

                    <input wire:model='user.id' type="hidden" name="">
                        <div class="flex flex_y_center gap_1">
                            <div>                        
                                @if ($avatar)
                                    <x-atom.profile-photo size="75px" path="">
                                        <div class="full_h full_w" style="background: #fff">
                                            <img src="{{ $avatar->temporaryUrl() }}" height="100%" width="auto">
                                        </div>
                                    </x-atom.profile-photo>
                                @else
                                    <x-atom.profile-photo size="5em" path="images/john-profile2.png"/>
                                @endif
                            </div>
                            <div>
                                <input wire:model="user.avatar" type="file" name="" id="">
                            </div>
                        </div>
                        <br><br>
                    <fieldset>
                        <legend>User details</legend><br>
                        <div class="grid grid_col_2 gap_1">
                            <div>
                                <label for="">User name</label>
                                <input wire:model.defer="user.name" type="text">
                                <label for="">Email Address</label>
                                <input wire:model.defer="user.email" type="email" required>
                            </div>
                            <div>
                                <label for="">Password</label>
                                <input wire:model.defer="user.password" type="password" name="" id="" placeholder="Minimum of 6 characters">
                                <label for="">Confirm Password</label>
                                <input wire:model.defer="user.password_confirm" type="password" name="" id="">
                                @if (session()->has('errorPass'))
                                    {{ session('errorPass') }}
                                @endif
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Role</legend><br>
                        <select wire:model.defer="user.role" name="" id="" required>
                            <option value="" selected hidden>--select--</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </fieldset> --}}
                </form>

            @else
                @if (count(App\Models\Role::all()) > 0)
                    <x-organisms.ui.table class="unstackable">
                        <x-slot name="thead"></x-slot>
                        <x-slot name="tbody">
                            @foreach (App\Models\Role::all() as $role)
                                <tr>
                                    <x-organisms.ui.table.td 
                                        text="{{ $role->display_name }}"
                                        desc="Description: {{ $role->description }}"/>
                                    <x-organisms.ui.table.td style="width:1em">
                                        @if ($confirmDeleteRole)
                                            <label wire:click.prevent="deleteRole({{ $role->id }})" class="ui mini button basic circular icon red animate_zoom" for="updateItem_from_inItem" data-tooltip="Remove" data-position="bottom left" data-inverted="" data-variation="mini">
                                                <i class="minus icon red"></i>
                                            </label>
                                        @endif
                                    </x-organisms.ui.table.td> 
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-organisms.ui.table>
                @else
                    <x-atoms.ui.message 
                        class=""
                        header="No roles added yet."
                        message="This section will contain all roles."/>
                @endif
            @endif
        @endif
        
    @endsection
</x-organisms.modal>
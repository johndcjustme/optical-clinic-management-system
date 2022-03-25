@php
    if ($currTab == 'profile') {
        $btnLabel = 'Save Changes'; 
        $wireSubmit = 'updateUserProfile';

        // reset when the user clicks cancel button on change password tab.
        $this->user['curr_password'] = '';
        $this->user['new_password'] = '';
        $this->user['confirm_new_password'] = '';
    }
    if ($currTab == 'change_password') {
       $btnLabel = 'Change'; 
       $wireSubmit = 'changePassword';
    }
@endphp

<x-layout.page-content>

    @section('section-page-title', 'My Account')

    @section('section-links') 
        Account Settings
    @endsection

    @section('section-heading-left')

    @endsection

    @section('section-heading-right')

    @endsection

    @section('section-main')
    <div style="max-width: 350px; margin-left:auto; margin-right:auto;">
        <form wire:submit.prevent="{{ $wireSubmit }}" class="gap_1" action="">
                @switch($currTab)
                    @case('profile')
                            <div class="gap_1">
                                <div>
                                    <div class="relative full_w radius_1" style="background:white; height: 100px;">
                                        <div class="flex gap_1 full_h">
                                            <div class="relative" style="flex-basis: 110px;">

                                                <div class="absolute" style="bottom:-1.5em; left: 1em">
                                                    <div class="" style="display: inline-block">
                                                        <div class="relative">
                                                            @if ($profilephoto) 
                                                                <x-atom.profile-photo size="75px" path="" >
                                                                    <div class="full_h full_w" style="background: #fff">
                                                                        <img src="{{ $profilephoto->temporaryUrl() }}" height="100%" width="auto">
                                                                    </div>
                                                                </x-atom.profile-photo>
                                                            @else
                                                                <x-atom.profile-photo size="75px" path="storage/photos/avatars/{{ Auth::user()->avatar }}"/>
                                                            @endif
                                                            <input type="file" wire:model.lazy="profilephoto" name="" id="myaccount_upload_photo" hidden @if (!$editProfile) disabled @endif>
                                                            <label class="absolute bottom right" for="myaccount_upload_photo" style="border: 2px solid #fff; background: #fff; border-radius: 50%"><i class="fa-solid fa-circle-plus" style="font-size: 1.1rem;"></i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p_10 flex flex_y_end" style="flex-basis: 100%">
                                                <p style="font-size: 1.2rem;">{{ $user['name'] }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <br><br><br>
                                <div>
                                    @error('profilephoto') <span class="error">{{ $message }}</span> <br><br> @enderror
                                    @if ($editProfile)
                                        <div class="flex flex_x_end">
                                            <input wire:model="user.resetAvatar" type="checkbox" name="" id="resetAvatar"><label class="ml_3" for="resetAvatar" title="If checked, click on save changes button to take effect. ">Reset Avatar</label>
                                        </div>
                                    @endif
                                    <label for="">User Name</label>
                                    <input wire:model.lazy="user.name" type="text" @if (!$editProfile) disabled @endif>
                                    <label for="">Email Address</label>
                                    <input wire:model.defer="user.email" type="test"  @if (!$editProfile) disabled @endif>
                                    @error('user.email') <span class="text_error">{{ $message }}*</span><br> @enderror

                                </div>
                            </div>
                        @break
                    
                        @case('change_password')
                            <div>
                                <div class="mb_20">
                                    <h3 style="font-weight: normal">Change Password</h3>
                                </div>
                                @if (session()->has('error'))
                                    <x-atom.alert.alert has="error" type="error"/>
                                @elseif (session()->has('success'))
                                    <x-atom.alert.alert has="success" type="success"/> 
                                @endif
                                <label for="">Current Password @error('user.curr_password') <i class="text_error">{{ $message }}*</i><br> @enderror</label>
                                <input wire:model.lazy="user.curr_password" type="password" name="" id="">
                                @if (session()->has('isCurrPasswordMatched'))
                                    <span class="text_error">{{ session('isCurrPasswordMatched') }}</span><br>
                                @endif
                                <label for="">New Password @error('user.new_password') <i class="text_error">{{ $message }}*</i><br> @enderror</label>
                                <input wire:model.lazy="user.new_password" type="password">
                                <label for="">Confirm Password @error('user.curr_password') <i class="text_error">{{ $message }}*</i><br> @enderror</label>
                                <input wire:model.lazy="user.confirm_new_password" type="password">
                                @if (session()->has('isNewPasswordMatched'))
                                    <span class="text_error">{{ session('isNewPasswordMatched') }}</span><br>
                                @endif
                            </div>
                        @break
                    @default
                @endswitch

                <div class="flex flex_y_center flex_x_between gap_1 mt_10">
                    <div>
                        @if ($currTab == 'profile')
                            @if (!$editProfile)
                                <a href="" wire:click.prevent="$set('currTab', 'change_password')" class="button_link">Change Password</a>
                            @endif
                        @endif
                        </div>
                    <div class="flex flex_y_center gap_1">
                        @if ($currTab == 'change_password' || $editProfile === true)
                            <p class="button_text"
                                @if ($currTab == 'change_password')
                                    wire:click.prevent="$set('currTab', 'profile')" 
                                @endif
                                @if ($editProfile)
                                    wire:click.prevent="$toggle('editProfile')" 
                                @endif
                            >
                                CANCEL
                            </p>
                        @endif
                        @if ($currTab == 'profile')
                            @if ($editProfile)
                                <button type="submit" 
                                    @if (($currTab === 'change_password') && 
                                        (empty($user['curr_password']) || 
                                        empty($user['new_password']) || 
                                        empty($user['confirm_new_password']))) 
                                        disabled 
                                    @endif>
                                    {{ $btnLabel }}
                                </button>
                            @else
                                <p wire:click.prevent="$toggle('editProfile')" class="button pointer bg_green">Edit</p>
                            @endif
                        @endif
                        @if ($currTab == 'change_password')
                            <button type="submit" 
                                @if (($currTab === 'change_password') && 
                                    (empty($user['curr_password']) || 
                                    empty($user['new_password']) || 
                                    empty($user['confirm_new_password']))) 
                                    disabled 
                                @endif>
                                {{ $btnLabel }}
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>



        <div id="001" onclick="document.getElementById('001').style.display='none'" class="fixed top left bottom right nodisplay" style="background: rgba(0, 0, 0, 0.438)">
            <div class="full_vh full_vw flex flex_center">
                <div class="card" style="width:250px; heigh:auto; background:#fff;">
                    <div class="flex flex_column gap_1">
                        <div class="flex flex_center">
                            <i class="fas fa-warning" style="font-size: 2rem;"></i>
                        </div>
                        <div>
                            <div class="my_10">
                                <center>
                                    <p>Some Content</p>
                                </center>
                            </div>
                        </div>
                        <div class="flex flex_x_between gap_1">
                            <div class="full_w">
                                <p wire:click.prevent="$toggle('editProfile')" class="button full_w text_center">No</p>
                            </div>
                            <div class="full_w">
                                <button class="full_w">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        


    @endsection

</x-layout.page-content>
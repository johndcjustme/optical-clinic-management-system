<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Account Settings"/>
    @endsection

    @section('section-links') 
    @endsection

    @section('section-heading-left')
    @endsection

    @section('section-heading-right')
    @endsection

    @section('section-main')
        <div class="ui centered grid">
            {{-- <div class="four wide computer eight wide tablet sixteen wide mobile column">
                <div class="x-flex x-flex-center" style="height: 100%">
                    <center>
                        <form wire:submit.prevent="updateAvatar">
                            @if ($myAvatar)
                                <x-atoms.ui.avatar src="{{ $myAvatar->temporaryUrl() }}" size="5em"/>
                            @else
                                <x-atoms.ui.avatar src="{{ avatar($avatar) }}" size="5em"/>
                            @endif
                            {{ $myAvatar }}
                            <input wire:model="{{ $myAvatar }}" id="changeUserAvatar001" type="file" style="opacity: 0;" hidden>
                            <div>
                                <button type="submit" class="ui button tertiary">Change</button>
                            </div>
                        </form>
                        <h3 class="ui header">{{ $name }}<span class="sub header">{{ $email }}</span>
                        </h3>
                        <br>
                        <div class="ui horizontal list divided">
                            <label class="item">Reset Avatar</label>
                            <label for="changeUserAvatar001" class="item">Upload Avatar</label>
                        </div>
                    </center>
                </div>
            </div> --}}
            <div x-data="{open: false}" class="ui segment column" style="max-width:320px;">
                <form wire:submit.prevent="updateAccount" class="ui form">
                    <div class="field">
                        <div class="" style="height: 100%">
                            <div class="ui grid centered">
                                <div class="column">
                                    <center>
                                        @if ($myAvatar)
                                            <x-atoms.ui.avatar src="{{ $myAvatar->temporaryUrl() }}" size="5em"/>
                                        @else
                                            <x-atoms.ui.avatar src="{{ avatar($avatar) }}" size="5em"/>
                                        @endif
                                        <input wire:model="{{ $myAvatar }}" id="changeUserAvatar001" type="file" style="opacity: 0;" hidden>
                                    </center>
                                    <center style="margin-top:1.5em;">
                                        <div class="ui horizontal list divided tiny">
                                            <label class="ui button tertiary item">Reset Avatar</label>
                                            <label class="ui button tertiary item" for="changeUserAvatar001">Upload Avatar</label>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="field">
                        @if (session()->has('accountUpdated'))
                            <div class="ui positive message" x-init="$('.message .close').on('click', function() { $(this).closest('.message').transition('fade');});">
                                <i class="close icon"></i>
                                <div class="header">Success</div>
                                <p>{{ session('accountUpdated') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="field">
                        <x-atoms.ui.label>Name <x-atoms.ui.required/> @error('name') <span class="ui text red">{{ $message }}</span> @endError</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="name" type="text" placeholder="Enter Name (10 characters maximum)..." class="fluid mb_7"/>
                    </div>
                    <div class="field">
                        <x-atoms.ui.label>Email <x-atoms.ui.required/> @error('email') <span class="ui text red">{{ $message }}</span> @endError</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="email" type="text" placeholder="Enter Name..." class="fluid mb_7"/>
                    </div>
                    <br>
                    <div class="x-flex x-flex-xbetween x-flex-ycenter x-gap-1">
                        <div>
                            <a @click="open = ! open" class="pointer">Change password <i :class="open ? 'up' : 'down'" class="icon caret"></i></a>
                        </div>
                        <div class="">
                            <button type="submit" class="ui button secondary">Update</button>
                        </div>
                    </div>
                </form>
                <form x-show="open" x-transition wire:submit.prevent="changePassword" class="ui form">
                    <div class="ui divider" style="margin: 3em 0"></div>
                    <div class="field">
                        @if (session()->has('passwordChanged'))
                            <div class="ui positive message" x-init="$('.message .close').on('click', function() { $(this).closest('.message').transition('fade');});">
                                <i class="close icon"></i>
                                <div class="header">
                                    Success
                                </div>
                                <p>{{ session('passwordChanged') }}</p>
                            </div>
                        @endif
                        @if (session()->has('passwordChangedError'))
                            <div class="ui negative message" x-init="$('.message .close').on('click', function() { $(this).closest('.message').transition('fade');});">
                                <i class="close icon"></i>
                                <div class="header">
                                    Error
                                </div>
                                <p>{{ session('passwordChangedError') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="field">
                        <x-atoms.ui.label>Current Password <x-atoms.ui.required> @error('currentPassword') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                        <input class="ui input fluid" type="password" wire:model="currentPassword" placeholder="Enter current password...">
                    </div>

                    <div class="field">
                        <x-atoms.ui.label>New Password <x-atoms.ui.required> @error('newPassword') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                        <input class="ui input fluid" type="password" wire:model="newPassword" placeholder="Minimum of 6 characters...">
                    </div>

                    <div class="field">
                        <x-atoms.ui.label>Repeat Password <x-atoms.ui.required> @error('confirmPassword') {{ $message }} @enderror</x-atoms.ui.required></x-atoms.ui.label>
                        <input class="ui input fluid" type="password" wire:model="confirmPassword" placeholder="Minimum of 6 characters...">
                    </div>
                    <div>
                        <button type="submit" class="ui button secondary fluid {{ empty($currentPassword) || empty($newPassword) || empty($confirmPassword) ? 'disabled' : '' }}">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection

</x-layout.page-content>
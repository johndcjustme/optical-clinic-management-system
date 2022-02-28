<x-layout.page-content>

    @section('section-page-title', 'My Account')

    @section('section-links') 

    @endsection

    @section('section-heading-left')

    @endsection

    @section('section-heading-right')

    @endsection

    @section('section-main')
        <form class="gap_1" action="" style="max-width: 350px;">
            <div>
                <div class="relative full_w radius_1" style="background: linear-gradient(to right, #2B4FFF, #AD08FF); height: 100px;">
                    <div class="flex gap_1 full_h">
                        <div class="relative" style="flex-basis: 110px;">
                            
                            <div class="absolute" style="bottom:-1.5em; left: 1em">
                                <div class="" style="display: inline-block">
                                    <div class="relative">
                                        @if ($profilephoto)
                                            <x-atom.profile-photo size="75px" path="">
                                                <div class="full_h full_w" style="background: #fff">
                                                    <img src="{{ $profilephoto->temporaryUrl() }}" height="100%" width="auto">
                                                </div>
                                            </x-atom.profile-photo>
                                        @else
                                            <x-atom.profile-photo size="75px" path="images/john-profile2.png"/>
                                        @endif
                                        <label class="absolute bottom right" for="myaccount_upload_photo" style="border: 2px solid #fff; background: #fff; border-radius: 50%"><i class="fa-solid fa-circle-plus" style="font-size: 1.1rem;"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p_10 flex flex_y_end" style="flex-basis: 100%">
                            <p style="font-size: 1.2rem;  color: #fff;">John De Castro</p>
                        </div>
                    </div>
                    
                </div>
            </div>
            <br><br><br>
            <div>
                @error('profilephoto') <span class="error">{{ $message }}</span> <br><br> @enderror
                
                <label for="">User Name</label>
                <input type="text">
                <label for="">Email Address</label>
                <input type="email">
                <br><br>
                <a href="">Change Password</a>
                <br><br>
                <input type="file" wire:model="profilephoto" name="" id="myaccount_upload_photo" hidden>
                <button>Update Account</button>
            </div>
            
        </form>
    @endsection

</x-layout.page-content>
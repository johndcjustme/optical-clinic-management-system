<div style="position:fixed; background-color:transparent; top:1em; right:1.5em; z-index:200">

    <div class="shadow-lg" style="
        background-color: #ffffff;
        padding-top:0.3em;
        padding-bottom:0.3em;
        padding-right: 0.3em;
        padding-left: 0.9em;
        border-radius: 50px;
        display:flex;
        align-items:center;
        gap:0.5em;
        z-index:1000;
    ">
{{--         
        <span class="text-sm">
            Today: {{ date('d') . ', ' . date('F') }}
        </span>
 --}}

        <x-organisms.ui.dropdown class="dropdown-end">
            <x-organisms.ui.dropdown.dropdown-label class="btn btn-ghost rounded-2xl btn-sm border border-gray-200">
                    {{-- <span class=""> --}}
                        <i class="fa-solid fa-bell font-xl" style="font-size: 1rem;"></i>
                        @if (count($notifications) > 0)
                            <span class="ml-2 indicator-item badge badge-secondary" style="border-width:0; font-size:0.7rem;">{{ count($notifications) }}</span> 
                        @endif
                    {{-- </span> --}}
            </x-organisms.ui.dropdown.dropdown-label>
            <x-organisms.ui.dropdown.dropdown-content class="p-3 rounded-none backdrop-blur-sm bg-gray-300/30" style="position:fixed; top:0; right:0; bottom:0; height:100vh; width:25em;">
                @if (count($notifications) > 0)
                    <p class="text-left mb-3">
                        <a wire:click.prevent="read_all" class="text-gray-600">Mark all as read</a>
                    </p>
                @endif
                <div class="noscroll mb-3 rounded-xl" style="overflow-y:auto;">
                    @forelse ($notifications as $notif)
                        <div class="card card-compact backdrop-blur-sm bg-white/80 mb-3 shadow">
                            <div class="card-body">
                                <div class="w-full">
                                    <span class="opacity-50" style="font-size:0.8rem; font-weight:bold;"><i class="fa-solid fa-bell mr-2"></i> {{ Str::upper($notif->title) }}</span>
                                    <p class="my-2" style="font-size: 1rem;">
                                        {{ $notif->desc }}
                                    </p>
                                    <div class="x-flex x-flex-xbetween x-flex-ycenter" style="padding-top:0.7em; width:100%;">
                                        <p class="opacity-50">
                                            {{ $notif->created_at->diffForHumans() }}
                                        </p>
                                        <div class="flex justify-between" style="gap:1em;">
                                            <a class="text-blue-400" href="{{ $notif->link }}">View</a>
                                            <a wire:click.prevent="is_read({{ $notif->id }})" class="text-blue-400">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center py-10">
                            <div>
                                <p class="text-center bg-white px-5 rounded-2xl"><i class="fa-solid fa-bell mr-2"></i> No notifications so far.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </x-organisms.ui.dropdown.dropdown-content>
        </x-organisms.ui.dropdown.dropdown-content>





        <x-organisms.ui.dropdown class="dropdown-end">
            <x-organisms.ui.dropdown.dropdown-label style="position:relative;">
                {{-- <i class="fa-solid fa-bell"></i> --}}
                <img class="mask mask-circle" src="{{ avatar(Auth::user()->avatar) }}" style="height:2.7em; width:2.7em"/>

            </x-organisms.ui.dropdown.dropdown-label>
            <x-organisms.ui.dropdown.dropdown-content class="rounded-xl mt-3 shadow-xl">
                    <div class="pt-3 pr-3 pl-3 text-center">
                        <div class="font-bold">{{ Auth::user()->name }}</div>
                        <div class="text-sm opacity-50">{{ Auth::user()->email }}</div>
                        <div class="divider"></div>
                    </div>
                    <li>
                        <a href="/account"><i class="fa-solid fa-user"></i> My Account</a>
                    </li>
                    <li>
                        <a>
                        <i class="fa-solid fa-right-from-bracket text-red-500"></i> 
                        <form action="{{ route('logout') }}" method="POST">
                        @csrf
                            <span onclick="event.preventDefault(); this.closest('form').submit();">Logout</span>
                        </form>
                        </a>
                    </li>
            </x-organisms.ui.dropdown.dropdown-content>
        </x-organisms.ui.dropdown.dropdown-content>



{{--         
        <div style="position: relative;" x-data="{open:false}">
            <div @click="open= ! open" class="btn btn-circle" style="position:relative;">
                <i class="fa-solid fa-bell"></i>
                @if (count($notifications) > 0)
                    <small style="position: absolute; top:-3px; right:-3px; height:15px; width:15px; border-radius:50%; background:red; color:white;" class="x-flex x-flex-center">{{ count($notifications)}}</small>
                @endif
            </div>
            <div x-show="open" @click.outside="open = false" x-transition class="ui segment inverted" style="width:300px; max-width:300px; position: absolute; right:0; top:3em; padding:0; margin:0; box-shadow: 0px 7px 20px rgba(0, 0, 0, 0.274);">
                <div class="ui segment inverted noscroll" style="overflow-y:auto; max-height:500px; margin:0;">
                    @forelse ($notifications as $notif)
                        <div x-transition class="x-flex x-notification-panel" style="width: 100%; background-color:rgb(41, 41, 41); padding:0.7em; margin:7px 0;">
                            <div style="width: 100%;">
                                <span class="ui text grey" style="font-size:0.8rem; font-weight:bold;"><i class="icon bell"></i> {{ Str::upper($notif->title) }}</span>
                                <div>
                                    {{ $notif->desc }}
                                </div>
                                <div class="x-flex x-flex-xbetween x-flex-ycenter" style="padding-top:0.7em; width:100%;">
                                    <p style="opacity:1; font-size:0.8rem; margin:0;">
                                        <span class="ui text grey">{{ $notif->created_at->diffForHumans() }}</span>
                                    </p>
                                    <div class="x-flex x-gap-1 x-action-links">
                                        <a class="pointer" href="{{ $notif->link }}">View</a>
                                        <a wire:click.prevent="is_read({{ $notif->id }})" class="pointer">Close</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="padding: 15px 0">
                            <center>
                                <span class="ui text"><i class="icon smile wink outline"></i> No notifications so far.</span>
                            </center>
                        </div>
                    @endforelse
                </div>
                @if (count($notifications) > 0)
                    <div class="x-flex x-flex-xend" style="width: 100%; padding:0.7em 1em; box-shadow: 0px -14px 17px 0px rgba(0,0,0,0.48);">
                        <div>
                            <span wire:click.prevent="read_all" class="ui text blue pointer" style="font-size:0.9rem">Mark all as read</span>
                        </div>
                    </div>
                @endif
            </div>
        </div> --}}




    </div>
</div>




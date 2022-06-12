    {{-- main page div  --}}
    <div class="flex h-screen w-screen overflow-hidden">
        {{-- sidenav  --}}
        
        <section class="h-screen w-24 md:w-64" style="background: rgba(243, 243, 243);">
            @livewire('components.organisms.layouts.sidenav')
        </section>
        
        <section class="col-span-10 h-screen w-full bg-primary-content overflow-y-auto">

            @livewire('components.organisms.layouts.topbar')

            <div class="w-full">
                {{ $slot }}
            </div>

        </section>

    </div>

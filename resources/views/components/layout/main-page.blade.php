    {{-- main page div  --}}
    <div class="outer_container full_vh overflow_hidden">
        {{-- sidenav  --}}
        @livewire('components.organisms.layouts.sidenav')
        
        <section class="section_main full_vh full_w">
            {{-- top bar  --}}
            @livewire('components.organisms.layouts.topbar')
            {{-- main content --}}
            <div class="main_content overflow_hidden full_w">

                {{-- @yield('content') --}}
                {{ $slot }}

            </div>

        </section>

    </div>

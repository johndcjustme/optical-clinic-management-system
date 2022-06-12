        <div class="panel_settings full_h fixed bottom right" style="display: block;  width: 370px; max-width: 370px; min-width: 300px;">
            <div class="relative full_h">

                @yield('create-post')
                
                <div class="panel_settings_content flex flex_column gap_1 flex_x_between  full_h overflow_y absolute right top">
                    <div>
                        <div>
                            <h5 style="text-transform: uppercase">@yield('title')</h5>
                            <p style="font-size: 0.8rem">@yield('desc')</p>
                        </div>
                        <div>
                
                            {{ $slot }}
                
                        </div>
                    </div>
                </div>

                
                <div wire:click.prevent="{{ $wireToggle }}" class="absolute" 
                    style="
                        background:white:
                        border:1px solid red;
                        top:1em; 
                        right:2em; 
                        z-index:100; 
                        width: 100%">
                    <i class="fas fa-close"></i>
                </div>
            </div>
        </div>

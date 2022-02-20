
    <div class="panel_settings full_h fixed bottom right" style="display: block;  width: 350px">
        <div class="relative full_h">
            <div class="panel_settings_content flex flex_column gap_1 flex_x_between  full_h overflow_y absolute right top">
                <div>
                    <div>
                        <h5 style="text-transform: uppercase">{{ $title }}</h5>
                    </div>
                    <div>
            
                        {{ $slot }}
            
                    </div>
                </div>
            </div>

            
            <div wire:click="$toggle('{{ $wireToggle }}')" class="absolute" 
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

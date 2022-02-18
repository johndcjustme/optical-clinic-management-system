
    <div class="panel_settings full_h fixed bottom right" style="display: block;  width: 350px">
        <div class="panel_settings_content flex flex_column gap_1 flex_x_between  full_h overflow_y absolute right top">
            <div>
                <div>
                    <h5 style="text-transform: uppercase">{{ $title }}</h5>
                </div>
                <div>
        
                    {{ $slot }}
        
                </div>
            </div>
            <div class="flex flex_x_center">
                <button wire:click="$toggle('shedsettings_isOpen')" style="width: 100%">Close</button>
            </div>
        </div>
    </div>

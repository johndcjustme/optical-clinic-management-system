<div class="relative">
    <div class="flex flex_x_end">
        <i onclick="document.getElementById('option{{ $id }}').style.display = 'block'" class="btn_post_option fa-solid fa-ellipsis-vertical px_2 light_500"></i>
    </div>
    <div id="option{{ $id }}" onmouseleave="document.getElementById('option{{ $id }}').style.display = 'none'" class="radius_1 animate_mini_zoom noselect forum_post_option absolute p_9 flex" style="width: auto; top: -0.58em; right: 0; display:none; background-color:white; z-index: 100; box-shadow: 0px 10px 25px -4PX rgb(76 90 121 / 40%);">
        <div class="flex">
            <div class="pointer" style="font-size: 0.8rem;">

                {{ $slot }}

            </div>
            {{-- <div class="ml_3">
                <i onclick="document.getElementById('option{{ $id }}').style.display = 'none'" class="fas fa-close"></i>
            </div> --}}
        </div>
    </div>
</div>



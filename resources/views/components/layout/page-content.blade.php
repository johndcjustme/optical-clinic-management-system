<div class="mt_5 w_lg" style="margin:auto; width:100%; max-width:1500px;height:100%" x-init="$('.ui.dropdown').dropdown();">
    <div class="px_15" style="padding-bottom: 100px">
        <div class="animate_top">
            {{-- <h3> --}}
            {{-- </h3> --}}
                <h1 class="ui huge header">
                    @yield('section-page-title')
                    {{-- <div class="sub header">Sub Header</div> --}}
                  </h1>
        </div>
        <br>
        <div class="flex gap_1 mt_15 animate_top">
            @yield('section-links')
        </div>
        <br><br>
        <div class="flex flex_x_between flex_y_center animate_opacity">
            
            <div class="flex gap_1">
                @yield('section-heading-left')
            </div>

            <div class="flex flex_y_center gap_1" >
                @yield('section-heading-right')
            </div>

        </div><br>

        <div class="animate_bottom" style="z-index:0">
            @yield('section-main')
        </div>

    </div>
</div>



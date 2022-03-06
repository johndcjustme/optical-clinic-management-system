<div class="mt_5 w_lg" style="margin:auto; width:100%; max-width:1100px;">
    <div class="px_7 overflow_hidden" style="padding-bottom: 100px">
        <div class="animate_top">
            <h2 style="font-weight: normal">@yield('section-page-title')</h2>
        </div>
        <div class="flex gap_1 mt_15 animate_top">
            @yield('section-links')
        </div>
        <br><br>
        <div class="flex flex_x_between flex-Y_center animate_opacity">
            
            <div class="flex gap_1">
                @yield('section-heading-left')
            </div>

            <div class="flex flex_y_center">
                @yield('section-heading-right')
            </div>

        </div><br>

        <div class="animate_bottom">
            @yield('section-main')
        </div>

    </div>
</div>
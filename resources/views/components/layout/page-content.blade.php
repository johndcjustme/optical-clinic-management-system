<div class="mt_5 w_lg" style="margin:auto; min-width: 624px;">
    <div class="p_7">
        <div class="animate_top">
            <h4>@yield('section-page-title')</h4>
        </div>
        <div class="flex gap_1 mt_15 animate_top">
            @yield('section-links')
        </div>
        <br><br>
        <div class="flex flex_x_between flex-Y_center animate_opacity">
            @yield('section-heading')
        </div><br>

        <div class="animate_bottom">
            @yield('section-main')
        </div>

    </div>
</div>
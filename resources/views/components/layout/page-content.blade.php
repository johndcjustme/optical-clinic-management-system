<div class="mt_5 w_lg" style="margin:auto; min-width: 624px;">
    <div class="p_7">
        <div>
            <h4>@yield('section-page-title')</h4>
        </div>
        <div class="flex gap_1 mt_15">
            @yield('section-links')
        </div>
        <br><br>
        <div class="flex flex_x_between flex-Y_center">
            @yield('section-heading')
        </div><br>

        @yield('section-main')

    </div>
</div>
<div class="mt_5 w_lg" style="margin:auto; width:100%; max-width:1500px;height:100%" x-init="$('.ui.dropdown').dropdown();">
    <div class="px_15" style="padding-bottom: 100px">
        <div class="">
            @yield('section-page-title')
        </div>
        <br>
        <div class="flex gap_1 mt_15 ">
            @yield('section-links')
        </div>
        <br><br>
        <div class="x-flex x-flex-xbetween x-flex-ycenter">

            <div class="x-flex x-flex-ycenter x-gap-1">
                @yield('section-heading-left')
            </div>

            <div class="x-flex x-flex-ycenter x-gap-1">
                @yield('section-heading-right')
            </div>

        </div><br>

        <div class="" style="z-index:0">
            @yield('section-main')
        </div>

    </div>
</div>

<div class="pt-10" x-init="$('.ui.dropdown').dropdown();">
    <div class="px-5" style="padding-bottom: 100px">
        <div class="">
            @yield('section-page-title')
        </div>
    
        <div class="flex gap-5 mt-14">
            @yield('section-links')
        </div>

        <div class="flex justify-between items-center my-14">
            <div class="flex items-center gap-5">
                @yield('section-heading-left')
            </div>

            <div class="flex items-center gap-5">
                @yield('section-heading-center')
            </div>

            <div class="flex items-center gap-5">
                @yield('section-heading-right')
            </div>
        </div>

        <div class="" style="z-index:0;">
            @yield('section-main')
        </div>

    </div>
</div>



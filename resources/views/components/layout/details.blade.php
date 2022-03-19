<div x-data="{open: true}" class="mb_15">

    <div @click="open = ! open">
        <p class="my_7 dark_300 font_s pointer">
            <i :class="open ? 'fa-chevron-down' : 'fa-chevron-right'" class="fa-solid" style="width: 1.5em"></i>
            <span>
                {{ $details_summary }}
            </span>
        </p>
    </div>

    <div x-show="open">

        {{-- @yield('details-content') --}}
        {{ $details_content }}

    </div>
</div>
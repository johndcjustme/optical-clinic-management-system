<div x-data="{open: true}" class="mb_20">

    <div @click="open = ! open">
        <p class="my_7 dark_100 font_normal pointer">
            <strong>
                <i :class="open ? 'fa-chevron-down' : 'fa-chevron-right'" class="fa-solid"></i>
                {{-- @yield('details-summary') --}}
                {{ $details_summary }}
            </strong>
        </p>
    </div>

    <div x-show="open">

        {{-- @yield('details-content') --}}
        {{ $details_content }}

    </div>
</div>
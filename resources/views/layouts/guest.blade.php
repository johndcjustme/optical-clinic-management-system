@includeIf('layouts.head')
        <div class="flex flex_center full_vh" style="background: #fff;">
            <div class="ui segment" style="width: 300px;">
                {{ $slot }}
            </div>
        </div>

@includeIf('layouts.foot')

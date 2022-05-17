@includeIf('layouts.head')
        <div class="x-flex x-flex-ycenter" style="background: #ffffff;">
            <div style="padding: 5em 0; margin-right:auto; margin-left:auto;">
                <div class="ui card" style="width: 300px;">
                    {{ $slot }}
                </div>
            </div>
        </div>
@includeIf('layouts.foot')

{{-- put to modals  --}}
<div id="1" class="modal" style="display: block">
    <div class="modal_content animate_opacity" style="margin-bottom: 100px;">
        <div class="card">

            <div class="flex flex_x_between flex_y_center">

                @yield('modal_title')

            </div>
            <br>

                @yield('modal_body')

        </div>  
    </div>
</div>
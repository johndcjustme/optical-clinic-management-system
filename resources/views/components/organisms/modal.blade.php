{{-- put to your modals  --}}
<div id="1" class="modal noscroll" style="display: block">
    <div class="modal_content animate_top" style="margin-bottom: 50px;">
        <div class="card">

            <div class="flex flex_x_between flex_y_center">

                @yield('modal_title')

            </div>
            <br>

                @yield('modal_body')

        </div>  
    </div>
</div>
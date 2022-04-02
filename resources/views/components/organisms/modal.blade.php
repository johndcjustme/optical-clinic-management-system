{{-- put to your modals  --}}
{{-- <div id="1" class="modal_container noscroll" style="display: block"> --}}
    {{-- <div class="modal_content animate_top" style="margin-bottom: 50px;"> --}}
        {{-- <div id="form-modal" class="modal full_w" style="padding: 1.2em;z-index:500;"> --}}

        <div class="mymodal full_w"
            style="
                padding: 1.2em; 
                position:fixed; 
                top:0; 
                left:0; 
                width:100vw;
                height:100vh;
                background:rgba(0, 0, 0, 0.767);  
                z-index:700; 
                overflow-y:auto;">
            <div
                @click.away="$wire.closeModal()"
                style="
                    max-width:500px;
                    width:500px;
                    height:auto;    
                    margin:50px auto;
                    background:white;
                    padding:1.5em;
                    border-radius:0.8em;">

                <div class="">
                    <div>
                        @yield('modal_title')
                    </div>
                    <div>
                        @yield('modal_body')
                    </div>
                </div>
            </div>

        </div>

{{-- </div> --}}


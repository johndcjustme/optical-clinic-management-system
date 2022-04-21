{{-- 
     <div id="confirm_dialog fade" class="" 
        style="
            position:fixed;
            width:100vw;
            height:100vh;
            background-color: rgba(0, 0, 0, 0.795);
            top:0;
            z-index: 100;
            display:none;
        ">
        <div class="" 
            style="
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;   
            
            ">
            <div class="radius_1" 
                style="
                    max-width: 300px;
                    width: 100%;
                    height:auto;
                    background: white;
                    padding:1em;
                ">
                <div class="ui header">
                    <div></div>
                </div>
                <div class="content my_7 py_10">
                    {{ $content }}
                </div>
                <div class="action flex flex_x_end mt_3">
                    <div>
                        <button id="btnCloseConfirmDialog" class="ui small button">Cancel</button>
                        <button wire:click.prevent="{{ $wireCancel }}}" class="ui small secondary button">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
   </div>
   
 --}}



 <div id="fade" class="modal" style="max-width: 300px; z-index:1000">
    <div class="text red py_10">
        {{ $content }}
    </div>
    <div class="flex flex_x_end gap_1">
        <a href="#" rel="modal:close">Close</a>
        <a href="#" wire:click.prevent="{{ $wireConfirm }}">Yes</a>
    </div>
</div>
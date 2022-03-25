





{{-- 


 <x-organisms.ui.confirm-dialog>
    <x-slot name="content">
        kdjfkdjfdfkdjkfj
    </x-slot>
</x-organisms.ui.confirm-dialog> --}}
    
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
        </div>
        <div class="action flex flex_x_end mt_3">
            <div>
                <button id="btnCloseConfirmDialog" class="ui small button">Cancel</button>
                <button wire:click.prevent="" class="ui small secondary button">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
 --}}



    
   

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha512-dqw6X88iGgZlTsONxZK9ePmJEFrmHwpuMrsUChjAw1mRUhUITE5QU9pkcSox+ynfLhL15Sv2al5A0LVyDCmtUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/analytic_stats.js') }}"></script>




<script src="{{ asset('js/modal.js') }}"></script>

{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script> --}}


@livewireScripts







<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>





<script>


    $('.table-inventory-dropdown-image').dropdown();


    $('.select_dropdown_modal').dropdown();


    


    window.addEventListener('confirm-dialog', event => {
        $("#fade").modal({
            fadeDuration: 75,
            showClose: false
        });
    })

    window.addEventListener('form-modal', event => {
        $('#form-modal').modal({
            fadeDuration: 75,
            showClose: false
        })
    })

    window.addEventListener('confirm-dialog-close', event => {
        $.modal.close();
    })


    window.addEventListener('toast', event => {
        $('body')
        .toast({
            title: event.detail.title,
            class: event.detail.class,
            showIcon: 'check',
            message: event.detail.message,
            closeOnClick: true,
            compact: true,
            position: 'bottom right',
        });
    })


</script>




</body>
</html>
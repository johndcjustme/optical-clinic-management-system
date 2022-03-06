<style>
    .btn_post_option:hover {
        color: black;
    }
</style>
{{-- 
<div class="relative">
    <div class="flex flex_x_end">
        <i onclick="document.getElementById('option{{ $id }}').style.display = 'block'" class="btn_post_option normal fa-solid fa-ellipsis-vertical px_3 py_2 light_500"></i>
    </div>
    <div id="option{{ $id }}" onmouseleave="document.getElementById('option{{ $id }}').style.display = 'none'" class="radius_1 animate_mini_zoom noselect forum_post_option absolute p_9" style="min-width: 80px; width: auto; top: -0.1em; right: -0.2em; display:none; background-color:white; z-index: 100; box-shadow: 0px 10px 25px -4PX rgb(76 90 121 / 40%);">
        <div class="relative">
            <div class="flex">
                <div class="pointer" style="font-size: 0.8rem;">
    
                    {{ $slot }}
                </div>
            </div>
        </div>
        <div class="ml_3 absolute top right">
            <i onclick="document.getElementById('option{{ $id }}').style.display = 'none'" class="fa-solid fa-circle-xmark clickable" style="font-size: 1rem"></i>
        </div>
    </div>
</div> --}}



<div x-data="{ open: false }" class="relative">
    <div class="flex flex_x_center" style="width:1em">
        <i @click="open = true" x-bind:class="! open ? 'fa-ellipsis-vertical' : 'fa-xmark'"  class="btn_post_option normal fa-solid  px_3 py_2 light_500"></i>
    </div>
    <div x-show="open" @click.away="open = false" class="radius_1 animate_mini_zoom noselect forum_post_option absolute p_9" style="min-width: 80px; width: auto; top: -0.1em; right: 1.2em; display:none; background-color:white; z-index: 100; box-shadow: 0px 10px 25px -4PX rgb(76 90 121 / 40%);">
        <div class="relative">
            <div class="flex">
                <div  class="pointer" style="font-size: 0.8rem;">
                    {{ $slot }}
                </div>
            </div>
        </div>
        {{-- <div class="absolute top right">
            <i @click="open = false" class="fa-solid fa-xmark clickable m_5 dark_100" style="font-size: 0.9rem"></i>
        </div> --}}
    </div>
</div>





{{-- 

<script>
    $(document).on('click touch', function(event) {
    if (!$(event.target).parents().addBack().is('#optionduh')) {
        $('#tooltip').hide();
    }
    });
</script> --}}
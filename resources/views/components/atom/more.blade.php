<style>
    .btn_post_option:hover {
        color: black;
    }

</style>


<div class="ui left pointing tiny inverted dropdown icon" x-init="$('.ui.dropdown').dropdown();">
    <i class="ellipsis vertical icon grey" style="padding:0.2em;"></i>
    <div class="menu tiny" style="z-index: 500">
        {{ $slot }}
    </div>
</div>

{{-- <div x-data="{ open: false }" class="relative">
    <div class="flex flex_x_center" style="width:1em">
        <i @click="open = true" x-bind:class="! open ? 'fa-ellipsis-vertical' : 'fa-xmark'"  class="btn_post_option normal fa-solid  px_3 py_2 light_500"></i>
    </div>
    <div x-show="open" @click.away="open = false" class="animate_mini_zoom noselect forum_post_option absolute p_9" style="min-width: 80px; width: auto; top: -0.1em; right: 1.2em; display:none; background-color:white; z-index: 100; box-shadow: 0px 10px 25px -4PX rgb(76 90 121 / 40%); border-radius:0.5em;">
        <div class="relative">
            <div class="flex">
                <div  class="pointer" style="font-size: 0.9rem;">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div> --}}


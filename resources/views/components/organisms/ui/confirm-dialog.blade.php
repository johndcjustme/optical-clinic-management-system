
 {{-- <div class="x-flex x-flex-center" style="background:black"> --}}
     <div id="fade" class="modal" style="max-width: 300px; padding:1.5em; border-radius:0.3em; position:relative;">
        <div>
            <h3 id="modal-title">{{ $title }}</h3>
        </div>
        <p class="py_10" id="modal-content">
            {{ $content }}
        </p>
        <div class="flex flex_x_end pointer" style="gap:0.7em;">
            <a class="ui button tiny fluid" rel="modal:close">No</a>
            <a class="ui button tiny secondary fluid" wire:click.prevent="{{ $wireConfirm }}">Yes</a>
        </div>
    </div>
 {{-- </div> --}}
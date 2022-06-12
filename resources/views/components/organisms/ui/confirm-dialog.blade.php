




{{-- <input type="checkbox" id="confirm-me" class="modal-toggle"/> --}}
<div id="confirm-me" class="x_modal" style="max-width:27em; width:100%; visibility:visible; pointer-events:all">
    {{-- <div class="modal-box" style="width: 26em;"> --}}
        <div id="modal-title" class="font-bold text-xl mb-4">{{ $title }}</div>
        <div id="modal-content">
            {{ $content }}
        </div>
        <div class="grid grid-cols-2 gap-4 w-full" style="margin-top:2.5em;">
            <a rel="modal:close" class="btn btn-active w-full btn-ghost">No</a>
            <a wire:click.prevent="{{ $wireConfirm }}" class="btn w-full">Yes</a>
        </div>
    {{-- </div> --}}
</div>


 {{-- <div class="x-flex x-flex-center" style="background:black; position:fixed top:0; right;0; heigth:100vh; width:100vw;"> --}}
        {{-- <input type="checkbox" id="confirm-me" class="modal-toggle"/>
        <div id="confirm-me" class="modal" style="width:100vw">
            <div class="modal-box">
                <div>{{ $title }}</div>
                <div>
                    {{ $content }}
                </div>
                <div class="flex gap-4" style="margin-top:2em;">
                    <a rel="modal:close" class="btn btn-ghost">No</a>
                    <a wire:click.prevent="{{ $wireConfirm }}" class="btn">Yes</a>
                </div>
            </div>
        </div> --}}



        {{-- <div class="modal">
            <p>Second AJAX Example!</p>
          </div> --}}


    {{-- </div> --}}


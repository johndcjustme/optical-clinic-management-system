
 {{-- <div class="x-flex x-flex-center" style="background:black"> --}}
     <div id="fade" class="modal ui card" style="max-width:300px; position:relative;">
        <div class="content">
            <div id="modal-title" class="header">{{ $title }}</div>
            <div id="modal-content" class="description">
                {{ $content }}
            </div>
            <div class="x-flex x-gap-1" style="margin-top:2em;">
                <a rel="modal:close" class="ui button small fluid">No</a>
                <a wire:click.prevent="{{ $wireConfirm }}" class="ui button small fluid red">Yes</a>
            </div>
        </div>
    </div>
 {{-- </div> --}}
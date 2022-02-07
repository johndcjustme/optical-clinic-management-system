{{-- <div id="delete{{ $itemId  }}" class="modal absolute">
    <div class="modal_content">
        <div class="card">
            delete?
            <button onclick="getElementById('delete{{ $itemId }}').style.display = 'none'">No</button>
            <button wire:click="{{ $wireClick }}">Yes</button>
        </div>
    </div>
</div> --}}

<div id="delete{{ $itemId }}" class="confirm_del">
    <div class="mr_5 inline">
        <button wire:click="{{ $wireClick }}" class="small">Delete?</button>
        <button onclick="getElementById('delete{{ $itemId }}').style.right = '-250px'" class="small"><i class="fas fa-angle-right"></i></button>
    </div>
</div>
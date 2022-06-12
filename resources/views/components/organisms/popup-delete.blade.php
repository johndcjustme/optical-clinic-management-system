<div id="delete{{ $itemId }}" class="confirm_del">
    <div class="mr_5 flex flex_y_center">
        <button wire:click="{{ $wireClick }}" class="btn_small bg_warning">Delete</button>
        <button onclick="getElementById('delete{{ $itemId }}').style.right = '-250px'" class="btn_small ml_6">NO</button>
    </div>
</div>
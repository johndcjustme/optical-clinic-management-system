<div class="action">
    <div>
        <a onclick="getElementById('delete{{ $deleteId }}').style.right = '0px'" href="#"><i class='fas fa-trash-alt red clickable'></i></a>
    </div>
    <div>
        <a wire:click="{{ $wireClick }}" href="#"><i class="fas fa-edit green clickable"></i></a>
    </div>
</div>      
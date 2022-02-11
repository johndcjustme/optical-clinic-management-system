<div class="action">
    <div class="action_content">
        <div>
            <a wire:click="{{ $wireClick }}" href="#"><i class="fas fa-edit green clickable"></i></a>
        </div>
        <div>
            <a onclick="getElementById('delete{{ $deleteId }}').style.right = '0px'" href="#"><i class='fas fa-trash-alt red clickable'></i></a>
        </div>
    </div>
</div>      


<div class="action">
    <div id="delete{{ $itemId }}" class="confirm_del">
        <div class="mr_5 flex flex_y_center">
            <button wire:click="{{ $wireClickDelete }}" class="btn_small bg_warning">Delete</button>
            <button onclick="getElementById('delete{{ $itemId }}').style.right = '-250px'" class="btn_small ml_6">NO</button>
        </div>
    </div>
    <div class="action_content">
        <div>
            <div class="more">
                <div class="card_nopadding more_content animate_mini_zoom">
                    <div class="more_content_image">
                        <img src="{{ $photo }}" alt="image">   
                    </div>
                    <div class="more_content_body">
                        <label for="">More Details</label><br><br>
                        
                        {{ $slot }}
            
                    </div>
                </div>
                <div class="more_btn">
                    <a href="#">
                        <i class="fa-solid fa-ellipsis clickable"></i>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <a  href="#"><i wire:click="{{ $wireClickEdit }}" class="fas fa-edit clickable"></i></a>
        </div>
        <div>
            <a onclick="getElementById('delete{{ $itemId }}').style.right = '0px'" href="#"><i class='fas fa-trash-alt red clickable'></i></a>
        </div>
    </div>
</div>      
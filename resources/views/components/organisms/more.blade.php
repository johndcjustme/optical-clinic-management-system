<div class="more">
    <div class="card_nopadding more_content animate_mini_zoom">
        <div class="more_content_image">
            <img src="{{ $image }}" alt="image">   
        </div>
        <div class="more_content_body">

            {{ $slot }}

        </div>
    </div>
    <div class="more_btn">
        <i class="fa-solid fa-ellipsis"></i>
    </div>
</div>
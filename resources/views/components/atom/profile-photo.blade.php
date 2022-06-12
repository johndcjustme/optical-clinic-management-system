{{-- <div class="bg_light_500 overflow_none" 
    style="
        height:{{ $size }}; 
        width:{{ $size }}; 
        border-radius: 0.5em;
        background: url('{{ $path }}') no-repeat center;
        background-size: cover;
        background-position: center top;
        /* border: 1px solid lightgray; */
        overflow: hidden;
    ">
    {{$slot}}
</div> --}}



<div class="avatar">
    <div class="mask mask-squircle" style="height:{{ $size }}; width:{{ $size }};">
        <img src="{{ $path }}" alt="Photo" />
    </div>
</div>
<div class="bg_light_500 overflow_none" 
    style="
        height:{{ $size }}; 
        width:{{ $size }}; 
        border-radius: 50%;
        background: url('{{ $path }}') no-repeat center;
        background-size: cover;
        background-position: center top;
        border: 3px solid #2B4FFF;
        overflow: hidden;
    ">

        {{$slot}}
    {{-- <img src="{{ asset('images/john-profile2.png') }}" height="100%" width="auto" alt=""> --}}
</div>
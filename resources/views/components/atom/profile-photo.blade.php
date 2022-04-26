<div class="bg_light_500 overflow_none" 
    style="
        height:{{ $size }}; 
        width:{{ $size }}; 
        border-radius: 0.5em;
        background: url('{{ $path }}') no-repeat center;
        background-size: cover;
        background-position: center top;
        border: 1px solid lightgray;
        overflow: hidden;
    ">

{{-- @if (!empty($path) || $path != null)
<div class="full_h full_w flex flex_center" style="background: rgb(56, 56, 56)">
    <p style="color: #fff;">J</p>
</div>
@endif --}}

        {{$slot}}
    {{-- <img src="{{ asset('images/john-profile2.png') }}" height="100%" width="auto" alt=""> --}}
</div>
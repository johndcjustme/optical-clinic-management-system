@php
    if ($type === 'error') {
        $color = 'red';
        $bg_color = 'rgb(255, 228, 228)';
    }    
    if ($type === 'success') {
        $color = 'green';
        $bg_color = 'rgb(232, 255, 228)';
    }    
@endphp

@if (session()->has($has))
    <div class="{{ $color }} font_normal radius_1 p_7 my_5 animate_opacity" style="background: {{ $bg_color }}">
        {{ session($has) }}
    </div>
@endif

@props(['disabled' => false])

<div class="ui input fluid mb_5">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '']) !!}>
</div>

{{-- <style>
    button.bordered:hover {
        background:red;
    }
</style> --}}

<style>
    button.btn123 {
        opacity:0.5;
        background: transparent;

    }
    button.btn123:hover {
        opacity: 1;
    }
</style>

<button class="btn123" 
style="
    border: 1px solid {{ $color }};
    color: {{ $color }};
    height: {{ $height }};
    padding: 0 1.2em;
    border-radius: 3em;
    font-size: 0.6rem;
    font-weight:bold;
">
{{ $label }}
</button>

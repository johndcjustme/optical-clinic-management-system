<label for="{{ $for }}" {{ $attributes->merge(['class' => 'ui button small']) }} @if (!empty($wireClick)) wire:click.prevent="{{ $wireClick }}" @endif>
    @if (!empty($icon))
        <i class="icon {{ $icon }}"></i>
    @endif
    {{ $label ?? $slot }}    
</label>
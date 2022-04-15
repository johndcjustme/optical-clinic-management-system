<div class="ui mini labeled button" tabindex="0">
    <div class="ui basic button">
        {{ $this->time($time->time) }}
    </div>
    <a class="ui left pointing blue label" wire:click.prevent="deleteTime({{ $time->id }})">
    <i class="fas fa-close"></i>
    </a>
</div>
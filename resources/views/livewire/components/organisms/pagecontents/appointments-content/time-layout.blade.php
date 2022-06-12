<div class="btn-group">
    <button class="btn">
        {{ $this->time($time->time) }}
    </button>
    <button wire:click.prevent="deleteTime({{ $time->id }})" class="btn btn-active">
        <i class="fa-solid fa-close"></i>
    </button>
</div>
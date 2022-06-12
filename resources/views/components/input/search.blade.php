<div class="search_container" onmouseover="document.getElementById('searchme').focus()">
    <div class="search_icon">
        <i class="fas fa-search"></i>
    </div>
    <div class="search_field">
        <input id="searchme" type="text" wire:model.debounce="{{ $wireModel }}" placeholder="Search">
    </div>
</div>

<div class="list_item">
    <div>
        <p class="{{ !empty($itemName) ? '' : 'nodisplay' }} {{ Str::contains($itemName, 'fontBold') ? 'font_bold' : '' }}">
            {{ Str::remove('fontBold', $itemName) }}
        </p>
        <p class="dark_200 mt_2 {{ !empty($itemDesc) ? '' : 'nodisplay'  }}" style="font-size: 0.75rem">
            {{ $itemDesc }}
        </p>
    </div>
    {{ $slot }} 
</div>
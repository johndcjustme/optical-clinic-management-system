<td>
    <div>
        @if ($textIcon) <i class="fa-solid {{ $textIcon }}" style="margin-right: 3px"></i> @endif 
        {{ $text }}
    </div>
    <div>
        <small class="dark_200">
            @if ($descIcon) <i class="fa-solid {{ $descIcon }}" style="margin-right: 3px"></i> @endif 
            {{ $desc }}
        </small>
    </div>
    {{ $slot }}
</td>
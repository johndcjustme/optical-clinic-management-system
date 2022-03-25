<td {{ $attributes->merge(['style'=>'']) }}>
    <div class="flex flex_y_center">
        <div>
            @if (!empty($checkbox))
                <div class="ui checkbox small">
                    <input wire:model="{{ $checkbox }}" type="checkbox" class="pointer" value="{{ $checkboxValue }}">
                    <label></label>
                </div>
            @endif
        </div>
        <div>
            @if (!empty($avatar) || ($avatar != null))
                <div style="margin-right:1em">
                    <x-atom.profile-photo size="2.5em" path="{{ $avatar }}" />
                </div>
            @endif
        </div>
        <div>
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
        </div>
    </div>
    {{ $slot }}
</td>
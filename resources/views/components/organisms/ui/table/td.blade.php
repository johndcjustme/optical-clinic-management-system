<td {{ $attributes->merge(['style'=>''])->merge(['class' => '']) }}>
    @if (!empty($checkbox))
        <div>
            <label>
                <input wire:model="{{ $checkbox }}" value="{{ $checkboxValue }}" type="checkbox" class="checkbox checkbox-sm" />
            </label>
        </div>
    @endif
    <div class="flex align-center">
        @if (!empty($avatar) || ($avatar != null))
            <div class="mr-3 flex align-center" @if(!empty($viewPhoto)) wire:click.prevent="{{ $viewPhoto }}" @endif>
                <x-atom.profile-photo size="3.5em" path="{{ $avatar }}" />
            </div>
        @endif
        <div class="flex flex-col justify-center">
            <div class="font-bold">
                @if ($textIcon) 
                    <i class="fa-solid {{ $textIcon }}" style="margin-right: 3px"></i> 
                @endif 
                {{ $text }}
            </div>
            <div class="text-sm opacity-50">
                @if ($descIcon) 
                    <i class="fa-solid {{ $descIcon }}" style="margin-right: 3px"></i> 
                @endif 
                {{ $desc }}
            </div>
        </div>
    </div>
    {{ $slot }}
</td>
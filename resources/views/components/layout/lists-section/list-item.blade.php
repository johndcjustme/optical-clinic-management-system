<div class="list_item">
    <div class="flex gap_1">
        @if (! empty($avatar))
            <div>
                <x-atom.profile-photo size="2.5em" path="{{ $avatar}}" />
            </div>
        @endif
        <div class="flex flex_y_center">
            <div>
                <p class="{{ !empty($itemName) ? '' : 'nodisplay' }} {{ Str::contains($itemName, 'fontBold') ? 'font_bold' : '' }}">
                    @if (!empty($itemNameIcon)) <i class="mr_1 fa-solid {{ $itemNameIcon }}"></i> @endif {{ Str::remove('fontBold', $itemName) }}
                </p>
                @if (!empty($itemDesc))
                    <p class="mt_2 dark_200">
                        <small>
                            @if (!empty($itemDescIcon)) <i class="mr_1 fa-solid {{ $itemDescIcon }}"></i> @endif {{ $itemDesc }}
                        </small>
                    </p>
                @endif
            </div>
        </div>
    </div>
    {{ $slot }} 
</div>
{{-- 

<div class="flex gap_1">
    <div>
        <x-atom.profile-photo size="2.5em" path="storage/photos/avatars/default-avatar-pt.png" />
    </div>
    <div class="flex flex_y_center">
        <div>
            <p>
                <strong>
                    {{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname}}
                </strong>
            </p>
            @if (isset($itemDesc))
                <p class="dark_200 mt_2">
                    <small>
                        <i class="text_center fa-solid dark_100 fa-location-dot mr_2"></i>{{ $$itemDesc }}
                    </small>
                </p>
            @endif
        </div>
    </div>
</div> --}}
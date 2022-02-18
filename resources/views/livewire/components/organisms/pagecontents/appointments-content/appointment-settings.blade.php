<div class="settings_schedule">
    <div class="week mt_15">
        <fieldset>
            <legend class="px_3">Weekly Schedule</legend>
            <div class="flex flex_column gap_1 my_10">
                <p>Choose your working days. Manual time settings is also available for you.</p>
                @foreach ($schedsettings as $schedsetting)
                    <form wire:submit="updateSchedSettings({{ $schedsetting->id }})">
                        <div class="day">
                            <div class="flex flex_y_center">
                                <input id="{{ $schedsetting->id }}" wire:click="updateSchedSettings({{ $schedsetting->id }})" type="checkbox" class="mr_4"
                                @if ($schedsetting->schedset_checked != null || $schedsetting->schedset_checked != 0)
                                    checked
                                @endif
                                >
                                <label for="{{ $schedsetting->id }}">{{ Str::title($schedsetting->schedset_name) }}</label>
                            </div>
                            <div class="flex flex_x_between flex_y_center gap_1 mt_7">
                                @if ($schedsetting->schedset_checked != null || $schedsetting->schedset_checked != 0)
                                    @if (($schedsetting->schedset_am != null || $schedsetting->schedset_am != '') || ($schedsetting->schedset_pm != null || $schedsetting->schedset_pm != ''))
                                        <input wire:model="amStart" type="time" value="{{ $schedsetting->id }}">
                                        <span>-</span>
                                        <input wire:model="pmEnd" type="time">
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </fieldset>
        <br>
        <fieldset>
            <form wire:submit.prevent="updateSchedSettingsAll">
                <div class="flex flex_column gap_1 my_8">
                    <p>
                        This time setting will allow you to set morning and afternoon time directly to all selected days above.
                    </p>
                    <div class="day mt_7">
                        <div class="flex flex_x_between flex_y_center gap_1 mb_7">
                            <input wire:model.difer="setAll_am" type="time" name="" id="">
                            <span>-</span>
                            <input wire:model.difer="setAll_pm" type="time" name="" id="">
                        </div>
                        <div class="text_right">
                            <button type="sumit" class="full_w bg_green">set now</button>
                        </div>
                    </div>
                </div>
            </form>
        </fieldset>
        <div class="flex flex_column gap_1 my_8 pt_10">
            <p>
                Setting this to ACTIVE it will be visible on scheduling of patients.
            </p>
            <div class="day mt_3">
                <div class="flex flex_y_center">
                    <input id="activate" class="mr_2" type="checkbox">
                    <label for="activate">Active</label>
                </div>
            </div>
        </div>
    </div><br>
</div>  
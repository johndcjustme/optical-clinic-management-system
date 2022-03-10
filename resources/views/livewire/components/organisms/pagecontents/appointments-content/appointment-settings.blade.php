<div class="settings_schedule">
    <div class="week mt_15">


        @foreach ($schedsettings as $schedsetting)
            <fieldset class="mb_7">
                <form wire:submit.prevent="updateSchedSettings('{{ $schedsetting->id }}')">
                    <div class="flex flex_x_between">
                        <div>
                            <h5>{{ Str::title($schedsetting->schedset_name) }}</h5><br>
                        </div>
                        <div>
                            <div class="bg_light_200 relative" style="
                                height: 1em;
                                width: 2em;
                                border-radius: 3em;
                            ">
                                <div class="absolute normal" style="
                                    height: 0.6em;
                                    width: 0.6em;
                                    background: green;
                                    border-radius: 1em;
                                    top: 0.2em;
                                    left: 0.2em;
                                    bottom: 0.2em;
                                "></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="font_s">Morning</p>
                        <div class="flex flex_y_center" style="gap:0.8em">
                            <input value="24:16" type="time" class="input_small">
                            <span>-</span>
                            <input wire:model.defer="time.am_to" type="time" class="input_small" name="" id="">
                        </div>
                    </div>
                    <div>
                        <p class="font_s">Afternoon</p>
                        <div class="flex flex_y_center" style="gap:0.8em">
                            <input wire:model.defer="time.pm_from" type="time" class="input_small" name="" id="">
                            <span>-</span>
                            <input wire:model.defer="time.pm_to" type="time" class="input_small" name="" id="">
                        </div>
                    </div>
                    <div class="text_right mt_4">
                        <button style="submit" class="btn_small">Save</button>
                    </div>
                </form>
            </fieldset>

        @endforeach

 
{{-- 

        <fieldset>
            <legend class="px_3">Weekly Schedule</legend>
            <div class="flex flex_column gap_1 my_10">
                <p>Choose your working days. Manual time settings is also available for you.</p>
                  --}}
                


                
                {{-- @foreach ($schedsettings as $schedsetting)
                    <form wire:submit="updateSchedSettings({{ $schedsetting->id }})">
                        <div class="day">
                            <div class="flex flex_y_center">
                                <input id="{{ $schedsetting->id }}" wire:model="" type="checkbox" class="mr_4"
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
                @endforeach --}}

{{-- 
            </div>
        </fieldset> --}}
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
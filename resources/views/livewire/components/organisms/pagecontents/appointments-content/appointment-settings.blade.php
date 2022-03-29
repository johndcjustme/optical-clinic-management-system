<div class="settings_schedule">
    <div class="week mt_15 pt_6">
        <div class="mb_20 mt_15">
            <div class="ui checkbox" x-init="$('.ui.checkbox').checkbox();">
                <input type="checkbox" name="" id="" tabindex="0" class="hidden">
                <label for="">Allow Scheduling</label>
            </div>
        </div>

        <div class="flex flex_column gap_1">
            <fieldset class="p_10">
                <h3><span class="ui text blue">Time</span></h3>
                <br>
                <label for="">Morning</label>
                <div class="flex flex_wrap gap_1 mt_5">
                    @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                        @if (Str::of($this->time($time->time))->lower()->contains('am'))
                            @include('livewire.components.organisms.pagecontents.appointments-content.time-layout')
                        @endif
                    @endforeach
                </div>
                <br>
                <label for="">Afternoon</label>
                <div class="flex flex_wrap gap_1 mt_5">
                    @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                        @if (Str::of($this->time($time->time))->lower()->contains('pm'))
                            @include('livewire.components.organisms.pagecontents.appointments-content.time-layout')
                        @endif
                    @endforeach
                </div>
                <br><br>
                <form wire:submit.prevent="addTime">
                    {{-- <x-atoms.ui.input wire-model="timeSched" type="time" class="mb_7"/>
                    <button type="submit" class="ui button primary tiny">Add</button> --}}
                    <div class="flex flex_center">
                        <div>
                            {{-- @error('timeSched') <span class="ui text red">{{ $message }}</span> @enderror --}}
                            <div class="ui action input fluid">
                                <div class="ui input @error('timeSched') error @enderror">
                                    <input wire:model.defer="timeSched" type="time">
                                </div>
                                <button type="submit" class="ui button">Add time</button>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>


            @foreach ($schedsettings as $schedsetting)
                <fieldset>
                    <form wire:submit.prevent="updateSchedSettings({{ $schedsetting->id }})">
                        <div class="flex flex_y_center flex_x_between">
                                <span class="ui text blue" style="font-size:1.1rem; font-weight:bold;">{{ Str::title($schedsetting->schedset_name) }}</span>
                                <div>
                                    @if ($schedsetting->schedset_checked)
                                        <button wire:click.prevent="updateDay('0', {{ $schedsetting->id }})" class="ui mini basic button positive">Open</button>
                                    @else
                                        <button wire:click.prevent="updateDay('1', {{ $schedsetting->id }})" class="ui mini basic button">Closed</button>
                                    @endif
                                </div>
                        </div>
    {{-- 
                        <div>
                            @if ($editTime == true && $editTimeId == $schedsetting->id)
                                <div>
                                    <div class="mb_7">
                                        <div class="" style="gap:0.8em">
                                            <div style="width:30%;">
                                                <x-atoms.ui.label>Morning</x-atoms.ui.label>
                                            </div>
                                            <div class="flex flex_y_center gap_1">
                                                <x-atoms.ui.input wire-model="time.am_from" type="time" class="tiny" value="{{ $schedsetting->schedset_am_from}}"/>
                                                <span>-</span>
                                                <x-atoms.ui.input wire-model="time.am_to" type="time" class="tiny" value="25:16"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex_y_center" style="gap:0.8em">
                                            <div style="width:30%;">
                                                <x-atoms.ui.label>Afternoon</x-atoms.ui.label>
                                            </div>
                                            <div class="flex flex_y_center gap_1">
                                                <x-atoms.ui.input wire-model="time.pm_from" type="time" class="tiny" value="25:16"/>
                                                <span>-</span>
                                                <x-atoms.ui.input wire-model="time.pm_to" type="time" class="tiny" value="25:16"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt_13 flex flex_x_end">
                                        <a href="#" wire:click.prevent="cancelUpdateSchedSettings" class="ui button basic mini fluid">Cancel</a>
                                        <button type="submit" class="ui button mini fluid">Save</button>
                                    </div>
                                </div>
                            @else
                                <div @if (!$schedsetting->schedset_checked) style="display:none" @endIf>
                                    <div>
                                        <div style="opacity: 0.5">Morning</div>
                                        <div class="flex gap_1">
                                            <p>{{ $this->time($schedsetting->schedset_am_from) }}</p>
                                            <span>-</span>
                                            <p>{{ $this->time($schedsetting->schedset_am_to) }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <div style="opacity: 0.5">Afternoon</div>
                                        <div class="flex gap_1">
                                            <p>{{ $this->time($schedsetting->schedset_pm_from) }}</p>
                                            <span>-</span>
                                            <p>{{ $this->time($schedsetting->schedset_pm_to) }}</p>
                                        </div>
                                    </div>
                                    <div @if (!$schedsetting->schedset_checked) style="display:none" @endIf>
                                        <a href="#" wire:click.prevent="editTime({{ $schedsetting->id }})">Change</a>
                                    </div>
                                </div>
                            @endif
                        
                        </div> --}}
                    
                    </form>
                </fieldset>

            @endforeach

            

    {{--         
            <br>
            <fieldset>
                <form wire:submit.prevent="updateSchedSettingsAll">
                    <div class="flex flex_column gap_1 my_8">
                        <p>
                            This time setting will allow you to set morning and afternoon time directly to all selected days above.
                        </p>
                        <div class="day mt_5">
                            <div class="mb_7">
                                <div class="" style="gap:0.8em">
                                    <div style="width:30%;">
                                        <x-atoms.ui.label>Morning</x-atoms.ui.label>
                                    </div>
                                    <div class="flex flex_y_center gap_1">
                                        <x-atoms.ui.input wire-model="time.am_from" type="time" class="tiny" value="{{ $schedsetting->schedset_am_from}}"/>
                                        <span>-</span>
                                        <x-atoms.ui.input wire-model="time.am_to" type="time" class="tiny" value="25:16"/>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="" style="gap:0.8em">
                                    <div style="width:30%;">
                                        <x-atoms.ui.label>Afternoon</x-atoms.ui.label>
                                    </div>
                                    <div class="flex flex_y_center gap_1">
                                        <x-atoms.ui.input wire-model="time.pm_from" type="time" class="tiny" value="25:16"/>
                                        <span>-</span>
                                        <x-atoms.ui.input wire-model="time.pm_to" type="time" class="tiny" value="25:16"/>
                                    </div>
                                </div>
                            </div>
                            <div class="text_right mt_7">
                                <button type="submit" class="ui button tiny positive fluid">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset> --}}
        </div>
    </div>
</div>  
<br><br>
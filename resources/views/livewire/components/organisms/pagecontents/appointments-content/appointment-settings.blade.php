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
                    <div class="flex flex_center">
                        <div>
                            <div class="ui action input fluid class">
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
                    </form>
                </fieldset>
            @endforeach

        </div>
    </div>
</div>  
<br><br>
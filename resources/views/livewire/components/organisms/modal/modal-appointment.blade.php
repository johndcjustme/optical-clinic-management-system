<x-organisms.modal on-close="@wire.closeModal">

    @section('modal_title')
        {{-- <div class="full_w flex flex_x_between full_w"> --}}
            <div class="x-flex x-flex-ycenter x-gap-1">
                @if ($apptSettings)
                    <div wire:click.prevent="enableScheduling" class="ui checkbox toggle" data-inverted="" data-tooltip="{{ $this->enableSchedulingStatus(11) ? 'Disable Scheduling' : 'Enable Scheduling'}}" data-position="bottom left" data-variation="small">
                        <input type="checkbox" @if ($this->enableSchedulingStatus(11)) checked="checked" @endif id="enableScheduling">
                        <label for="enableScheduling"></label>
                    </div>
                @endif
                @if ($isUpdate)
                    <button wire:click.prevent="$set('isAdd', true)" class="mr_5 cancel btn_w_s"
                        style="
                            width: 3.5em;
                            height: 3.5em;
                            border-radius: 2em;
                            padding: 0;
                        "
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                @endif
            </div>
            @if ($apptSettings)
                <div>
                    <h5>SCHEDULE SETTINGS</h5>
                </div>
            @endif
            <div>                
                @if (! $modal['add'])
                    <button wire:click.prevent="closeModal" class="ui button tiny basic">Close</button>
                    @if (!$apptSettings)
                        <x-atoms.ui.button class="secondary tiny" form="updateAppt" type="submit">Save</i></x-atoms.ui.button>
                    @endif
                @endif
            </div>
        {{-- </div> --}}
    @endsection

    @section('modal_body')

        <br><br>

        @if ($apptSettings)
        
        <div class="x-flex x-flex-xbetween x-flex-ycenter">
            <div class="ui compact tiny menu">
                <button wire:click.prevent="$set('apptSettingsTabs', 1)" class="item {{ $apptSettingsTabs == 1 ? 'active' : ''; }}">Days</button>
                <button wire:click.prevent="$set('apptSettingsTabs', 2)" class="item {{ $apptSettingsTabs == 2 ? 'active' : ''; }}">Time</button>
                <button wire:click.prevent="$set('apptSettingsTabs', 3)" class="item {{ $apptSettingsTabs == 3 ? 'active' : ''; }}">Year</button>
            </div>
            <div>
                @if ($apptSettingsTabs == 2)
                    <div class="ui tiny input @error('timeSched') error @enderror">
                        <input wire:model.lazy="timeSched" type="time" placeholder="Search...">
                    </div>    
                @elseif ($apptSettingsTabs == 3)        
                    <div class="ui small input compact @if (session()->has('yearMessage')) error @endif">
                        <input wire:model.lazy="yearSched"  type="text" placeholder="e.g. {{ date('Y') }}">
                    </div>               
                @endif
            </div>         
        </div>
    


            {{-- <div>
            </div> --}}

            <br>
            @switch($apptSettingsTabs)
                @case(1)

                    <x-organisms.ui.table class="selectable very basic">
                        <x-slot name="thead"></x-slot>
                        <x-slot name="tbody">
                            @foreach (App\Models\Day::all() as $day)
                                <tr wire:click.prevent="selectedDay({{$day->id}})">
                                    <td class="@if (!$day->status) orange @endif" style="width: 10em;">

                                        <div class="ui form">
                                            <div class="grouped fields">
                                                <div class="field">
                                                    <div class="x-flex x-flex-center">
                                                        <div class="ui checkbox slider ">
                                                            <input type="checkbox" @if ($day->status) checked="checked" @endif>
                                                            <label for=""></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="@if (!$day->status) orange @endif">{{ $day->day}}</td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-organisms.ui.table>
                    @break

                @case(2)
                    <br>
                    @if (App\Models\Time::count() > 0)
                        
                        <x-organisms.ui.table class="very basic">
                            <x-slot name="thead"></x-slot>
                            <x-slot name="tbody">
                                <tr>
                                    <td style="width: 5em;">
                                        <center>
                                            A.M
                                        </center>
                                    </td>
                                    <td>
                                        <div class="flex flex_wrap gap_1 mt_5">
                                            @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                                                @if (Str::of($this->time($time->time))->lower()->contains('am'))
                                                    @include('livewire.components.organisms.pagecontents.appointments-content.time-layout')
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <center>
                                            P.M
                                        </center>
                                    </td>
                                    <td>
                                        <div class="flex flex_wrap gap_1 mt_5">
                                            @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                                                @if (Str::of($this->time($time->time))->lower()->contains('pm'))
                                                    @include('livewire.components.organisms.pagecontents.appointments-content.time-layout')
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>



                            </x-slot>
                        </x-organisms.ui.table>          
                    @else
                        <div class="ui message tiny fluid" style="width: 100%">
                            <div class="header">
                                Hey!
                            </div>
                            <p>There is no time added yet.</p>
                        </div>
                    @endif
                    @break
                @case(3)
                    <br>
                    <div class="flex flex_wrap gap_1 mt_5">
                        @forelse (App\Models\Year::orderBy('year')->get() as $year)
                            <div class="ui mini labeled button" tabindex="0">
                                <div class="ui basic button">
                                    {{ $year->year }}
                                </div>
                                <a class="ui left pointing blue label" wire:click.prevent="deleteYear({{ $year->id }})">
                                <i class="fas fa-close"></i>
                                </a>
                            </div>
                        @empty
                            <div class="ui message tiny fluid" style="width: 100%">
                                <div class="header">
                                    Hey!
                                  </div>
                                  <p>There is no year added yet.</p>
                            </div>
                        @endforelse
                    </div>
                    @break
                @default
                    
            @endswitch









        @else
            @if ($modal['add'])
                @if (!$addAppt)
                    <div class="pt_7">
                        <form class="relative" id="createAppt" wire:submit.prevent="createAppt">
                            <select class="ui search dropdown fluid" wire:model="searchPatient" x-data="$('.search.dropdown').dropdown('refresh', {clearable: true,userLabels: false});">
                                <option value="" selected hidden>Search patient</option>
                                @foreach (App\Models\Patient::all() as $pt) 
                                    <option value="{{ $pt->id }}">{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname }}</option>
                                @endforeach
                            </select>
                            <div class="flex gap_1 flex_x_end mt_15">
                                <button wire:click.prevent="closeModal" class="ui button tiny basic">Close</button>
                                <button class="ui button tiny secondary" type="submit">select</button>
                            </div>
                        </form>
                    </div>
                @endif

            @elseif ($modal['update'])
                <form id="updateAppt" wire:submit.prevent="updateAppt">
                    <div class="grid grid_col_2 gap_1" style="grid-template-columns: 3em auto">
                        <div>
                            <x-atom.profile-photo size="3em" path="{{ $this->storage($appt['pt_avatar']) }}" />
                        </div>
                        <div>
                            <h5>{{ $appt['pt_name'] }}</h5>
                            <div class="mt_7">
                                @if (isset($appt['pt_addr']))
                                    <p class="my_7 font_m">
                                        <i class="text_center fa-solid dark_100 fa-location-dot" style="width: 1.1em"></i>
                                        <span>
                                            {{ !empty($appt['pt_addr']) ? $appt['pt_addr'] : '--'; }}
                                        </span>
                                    </p>
                                @endif
                                @if ( isset($appt['pt_phone']))
                                    <p class="my_7 font_m">
                                        <i class="text_center fa-solid dark_100 fa-phone" style="width: 1.1em"></i>
                                        <span>
                                            {{ !empty($appt['pt_phone']) ? $appt['pt_phone'] : '--'; }}
                                        </span>
                                    </p>
                                @endif
                                @if (isset($appt['pt_occ']))
                                    <p class="my_7 font_m">
                                        <i class="text_center fa-solid dark_100 fa-briefcase" style="width: 1.1em"></i>
                                        <span>
                                            {{ !empty($appt['pt_occ']) ? $appt['pt_occ'] : '--'; }}
                                        </span>
                                    </p>
                                @endif
                            </div><br><br>

                            <div class="ui field">
                                <x-atoms.ui.label for="">Appointment Date <x-atoms.ui.required/></x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="appt.pt_date" type="date" class="fluid"/>
                                <x-atoms.ui.label>Time</x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="appt.pt_time" type="time" class="fluid"/>
                                <x-atoms.ui.label>Status <x-atoms.ui.required/> </x-atoms.ui.label>
                                <x-atoms.ui.select wire:model.defer="appt.pt_status" class="mb_7 fluid">
                                    <option class="item" value="" selected hidden></option>
                                    <option class="item" value="1">{{ $apptStatus[1] }}</option>
                                    <option class="item" value="2">{{ $apptStatus[2] }}</option>
                                    <option class="item" value="3">{{ $apptStatus[3] }}</option>
                                    <option class="item" value="4">{{ $apptStatus[4] }}</option>
                                    <option class="item" value="5">{{ $apptStatus[5] }}</option>
                                </x-atoms.ui.select>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        @endif



        
    @endsection

</x-organisms.modal>


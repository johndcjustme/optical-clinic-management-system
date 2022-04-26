<x-organisms.modal on-close="@wire.closeModal">

    @section('modal_title')
        <div class="x-flex x-flex-ycenter" style="gap:0.7em">
            @if ($modal['settings'] || $modal['settings2'])
                <div wire:click.prevent="enableScheduling" class="ui checkbox toggle" data-inverted="" data-tooltip="{{ $this->enableSchedulingStatus(11) ? 'Disable Scheduling' : 'Enable Scheduling'}}" data-position="bottom left" data-variation="small">
                    <input type="checkbox" @if ($this->enableSchedulingStatus(11)) checked="checked" @endif id="enableScheduling">
                    <label for="enableScheduling"></label>
                </div>
                @if (!$modal['settings3'])
                {{-- hiden when settings3 is true --}}
                    <x-atoms.ui.button-circular wire:click.prevent="$toggle('modal.settings2')" class="mini basic {{ $modal['settings2'] ? 'primary' : ''}}">
                        <i class="icon {{ $modal['settings2'] ? 'arrow left' : 'settings'}}"></i>
                    </x-atoms.ui.button-circular>
                @endif
                @if ($modal['settings2']) 
                    {{-- hiden when settings2 is true --}}
                    <x-atoms.ui.button-circular wire:click.prevent="$toggle('deletingApptCat')" class="mini basic {{ $deletingApptCat ? 'primary red' : ''}} animate_zoom" data-inverted="" data-tooltip="Notificaton Settings" data-position="bottom left" data-variation="small" style="z-index: 1">
                        <i class="icon {{ $deletingApptCat ? 'close' : 'trash'}}"></i>
                    </x-atoms.ui.button-circular>
                @endif
            @endif
            @if ($isUpdate)
                <button wire:click.prevent="$set('isAdd', true)" class="mr_5 cancel btn_w_s" style=" width:3.5em; height:3.5em; border-radius:2em; padding:0;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            @endif
            @if ($modal['update'])

                <div class="ui dropdown floating icon button tiny" x-init="$('.ui.dropdown').dropdown()" style="z-index: 400">
                    <i class="dropdown icon"></i>
                    <span class="">Select Patient</span>
                    <div class="menu fluid right">  
                        <div class="ui icon search input">
                            <i class="search icon"></i>
                            <input type="text" placeholder="Search Items...">
                        </div>
                        <div class="divider"></div>
                        <div class="scrolling menu">
                            @foreach (App\Models\Patient::all() as $pt)
                                <div class="item">
                                    <div class="x-flex x-flex-xbetween x-gap-1">
                                        <div>
                                            <div>
                                                {{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mnmae }}
                                            </div>
                                            <small>
                                                <i class="fa-solid fa-location-dot"></i> {{ $pt->patient_address }}
                                            </small>
                                        </div>
                                        <div>
                                            <button class="ui circular icon button tiny" wire:click.prevent="createAppt({{ $pt->id }})">
                                                <i class="icon right arrow"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div>
            <h5>
            @if ($modal['settings'])
                APPOINTMENT SETTINGS
            @elseif ($modal['update'])
                APPOINTMENT
            @endif
            </h5>
        </div>
        <div>                
            @if ($modal['settings'] || $modal['settings2'])
                <button wire:click.prevent="closeModal" class="ui button tiny">Close</button>
            @else
                @if (! $modal['add'])
                    <button wire:click.prevent="closeModal" class="ui button tiny">Close</button>
                    <x-atoms.ui.button class="secondary tiny" form="updateAppt" type="submit">Save</i></x-atoms.ui.button>
                @endif
            @endif
        </div>
    @endsection

    @section('modal_body')

        @if ($modal['settings'])
            <br><br>
            @if ($modal['settings2'])
                <form wire:submit.prevent="addApptCategory" action="">
                    <div class="ui action input fluid @error('apptCat.title') error @enderror">
                        <input wire:model.defer="apptCat.title" type="text" placeholder="Enter Category (Max of 20 characters)...">
                        <button type="submit" class="ui button">Add Category</button>
                    </div>
                </form>

                <br><br>

                <x-organisms.ui.table class="very basic fluid unstackable" style="width: 100%">
                    <x-slot name="thead"></x-slot>
                    <x-slot name="tbody">
                        @foreach ($categories as $category)
                            @php $error = !$category->status ? 'error' : ''; @endphp
                            <tr  style="padding-right: 1em;">

                                <td class="{{ $error }}" style="padding-left:1em; ">
                                    @if (!$category->status) <i class="attention icon" style="margin-right: 1em"></i> @endif
                                    <div class="ui {{ $category->cname }} empty circular label" style="margin-right: 0.5em"></div>
                                    <span>{{ $category->title}}</span>
                                </td>

                                <td class="right aligned {{ $error }}" style="width:6em">
                                    <div class="ui dropdown primary blue" x-init="$('.ui.dropdown').dropdown()">
                                        <i class="edit icon"></i>
                                        Pick a color
                                        <div class="menu left">
                                            <div class="scrolling menu">
                                                @foreach (colors() as $color)
                                                    <div wire:click.prevent="setColor('{{ $category->id }}', '{{ $color['value'] }}', '{{ $color['name'] }}')" class="item">
                                                        <div class="ui {{ $color['name'] }} empty circular label"></div>
                                                        {{ Str::title($color['name']) }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="right aligned {{ $error }}" style="width: 7em;">
                                    <div class="ui form">
                                        <div class="grouped fields">
                                            <div class="field">
                                                <div class="ui checkbox slider " wire:click.prevent="selectedApptCategory({{$category->id}})" data-inverted="" data-tooltip="{{ $category->status ? 'Active' : 'Disabled' }}" data-position="bottom left" data-variation="small">
                                                    <input type="checkbox" @if ($category->status) checked="checked" @endif>
                                                    <label for=""></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @if ($deletingApptCat)
                                    <td class="{{ $error }}" style="width:1em;">
                                        <button wire:click.prevent="deleteApptCategory({{ $category->id }})" class="ui button mini icon red tertiary animate_opacity" data-inverted="" data-tooltip="Remove Item" data-position="top right" data-variation="mini"><i class="close icon"></i></button>                                    
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </x-slot>
                </x-organisms.ui.table>
            @else
                <div class="x-flex x-flex-xbetween x-flex-ycenter">
                    <div class="ui compact tiny menu" style="z-index: 0">
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
            
                <br>
                @switch($apptSettingsTabs)
                    @case(1)
                        <x-organisms.ui.table class="selectable very basic unstackable">
                            <x-slot name="thead"></x-slot>
                            <x-slot name="tbody">
                                @foreach (App\Models\Day::all() as $day)
                                    @php $error = !$day->status ? 'error' : ''; @endphp
                                    <tr>
                                        <td class="{{ $error }}" style="padding-left:1em;">
                                            @if (!$day->status) <i class="attention icon"></i> @endif
                                            {{ $day->day}}
                                        </td>
                                        <td class="{{ $error }} right aligned" style="width: 10em;">
                                            <div class="ui form">
                                                <div class="grouped fields">
                                                    <div class="field">
                                                        <div class="ui checkbox slider " wire:click.prevent="selectedDay({{$day->id}})" data-inverted="" data-tooltip="{{ $day->status ? 'Active' : 'Disabled' }}" data-position="bottom left" data-variation="small">
                                                            <input type="checkbox" @if ($day->status) checked="checked" @endif>
                                                            <label for=""></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                        @break

                    @case(2)
                        <br>
                        @if (App\Models\Time::count() > 0)
                            
                            <x-organisms.ui.table class="very basic unstackable">
                                <x-slot name="thead"></x-slot>
                                <x-slot name="tbody">
                                    <tr>
                                        <td style="width: 5em;">
                                            <center>
                                                A.M.
                                            </center>
                                        </td>
                                        <td>
                                            <div class="flex flex_wrap gap_1 mt_5">
                                                @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                                                    @if (Str::of(humanReadableTime($time->time))->lower()->contains('am'))
                                                        @include('livewire.components.organisms.pagecontents.appointments-content.time-layout')
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                P.M.
                                            </center>
                                        </td>
                                        <td>
                                            <div class="flex flex_wrap gap_1 mt_5">
                                                @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                                                    @if (Str::of(humanReadableTime($time->time))->lower()->contains('pm'))
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
            @endif
            

        @elseif ($modal['update'])
            <br><br>
            <form id="updateAppt" wire:submit.prevent="updateAppt">
                <div class="grid grid_col_2 gap_1" style="grid-template-columns: 4em auto">
                    <div>
                        <x-atom.profile-photo size="4em" path="{{ avatar($appt['pt_avatar']) }}" />
                    </div>
                    <div>
                        @if (!empty($appt['pt_name']))
                            <h3>{{ Str::title($appt['pt_name']) }}</h3>
                        @else
                            <div class="ui message tiny fluid error" style="width: 100%">
                                <div class="header">
                                    Select a patient first
                                </div>
                                <p>Some important patient information will appear here.</p>
                            </div>
                        @endif

                        <div class="mt_7">
                            @if (!empty($appt['pt_phone']))
                                <p class="my_7">
                                    <i class="text_center fa-solid dark_100 fa-phone" style="width: 1.1em"></i>
                                    <span>
                                        {{ Str::title($appt['pt_phone']) }}
                                    </span>
                                </p>
                            @endif
                            @if (!empty($appt['pt_addr']))
                                <p class="my_7">
                                    <i class="text_center fa-solid dark_100 fa-location-dot" style="width: 1.1em"></i>
                                    <span>
                                        {{ Str::title($appt['pt_addr']) }}
                                    </span>
                                </p>
                            @endif
                           
                        </div><br><br>

                        <div class="ui field">
                            <x-atoms.ui.label for="">Appointment Date <x-atoms.ui.required/> @error('appt.pt_date') <span class="ui text error">{{ $message }}</span>@enderror</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="appt.pt_date" type="date" class="fluid" required/>
                            <x-atoms.ui.label>Time</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="appt.pt_time" type="time" class="fluid"/>
                            <x-atoms.ui.label>Status <x-atoms.ui.required/>@error('appt.pt_status') <span class="ui text error">{{ $message }}</span>@enderror</x-atoms.ui.label>
                            <x-atoms.ui.select wire:model.defer="appt.pt_status" class="mb_7 fluid" required>
                                <option class="item" value="" selected hidden>Select</option>
                                @foreach (App\Models\Appointment_category::all() as $ac)
                                    <option class="item" value="{{ $ac->id }}">{{ $ac->title }}</option>
                                @endforeach
                            </x-atoms.ui.select>
                        </div>
                    </div>
                </div>
            </form>
        @endif         
    @endsection

</x-organisms.modal>


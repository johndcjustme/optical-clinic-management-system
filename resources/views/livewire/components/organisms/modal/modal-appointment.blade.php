<x-organisms.modal on-close="@wire.closeModal">

    @section('modal_title')
        <div class="x-flex x-flex-ycenter" style="gap:0.7em">
            @if ($modal['settings'] || $modal['settings2'])
                <div class="tooltip tooltip-bottom" data-tip="{{ $this->enableSchedulingStatus(11) ? 'Disable Scheduling' : 'Enable Scheduling'}}">
                    <input wire:click.prevent="enableScheduling" type="checkbox" class="toggle toggle-lg" @if ($this->enableSchedulingStatus(11)) checked @endif id="enableScheduling">
                </div> 
                @if (!$modal['settings3'])
                {{-- hiden when settings3 is true --}}
                    <x-atoms.ui.button-circular wire:click.prevent="$toggle('modal.settings2')">
                        <i class="fa-solid {{ $modal['settings2'] ? 'fa-caret-left' : 'fa-gear'}}"></i>
                    </x-atoms.ui.button-circular>
                @endif
                @if ($modal['settings2']) 
                    {{-- hiden when settings2 is true --}}
                    <x-atoms.ui.button-circular wire:click.prevent="$toggle('deletingApptCat')" class="btn-error {{ $deletingApptCat ? 'primary red' : ''}} animate_zoom" data-inverted="" data-tooltip="Notificaton Settings" data-position="bottom left" data-variation="small" style="z-index: 1">
                        <i class="fa-solid {{ $deletingApptCat ? 'fa-close' : 'fa-trash'}}"></i>
                    </x-atoms.ui.button-circular>
                @endif
            @endif
            @if ($isUpdate)
                <button wire:click.prevent="$set('isAdd', true)" class="mr_5 cancel btn_w_s" style=" width:3.5em; height:3.5em; border-radius:2em; padding:0;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            @endif
            @if ($modal['update'])


                {{-- <x-organisms.ui.dropdown class="dropdown-right">
                    <x-organisms.ui.dropdown.dropdown-label>
                        <i class="fa-solid fa-circle mr-2"></i>
                        Select
                        <i class="fa-solid fa-caret-right"></i>
                    </x-organisms.ui.dropdown.dropdown-label>
                    <x-organisms.ui.dropdown.dropdown-content class="ml-2" style="height: 20em; overflow-y:auto">
                        <li class="ui icon search input">
                            <i class="search icon"></i>
                            <input type="text" placeholder="Search Items...">
                        </li>

                        <div class="menu">
                            @foreach (App\Models\Patient::select(['id', 'patient_fname', 'patient_mname', 'patient_lname', 'patient_address'])->get() as $pt)
                                <li class="item">
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
                                </li>
                            @endforeach
                            
                        </div>
                    </x-organisms.ui.dropdown.dropdown-content>
                </x-organisms.ui.dropdown.dropdown-content> --}}
{{-- 
                <div class="dropdown">
                    <label tabindex="0" class="btn m-1">Click</label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                      <li><a>Item 1</a></li>
                      <li><a>Item 2</a></li>
                    </ul>
                </div> --}}
                  

                <div class="ui dropdown icon" x-init="$('.ui.dropdown').dropdown()" style="z-index: 400">
                    <label class="btn mb-3">
                        <i class="fa-solid fa-caret-down mr-2"></i>
                        Select Patient
                    </label>    
                    <div class="mt-2 menu shadow-xl overflow-hidden" style="border-radius: 1em;">
                        <div class="p-3 search">
                            <input class="input input-bordered w-full" type="text" placeholder="Search Items...">
                        </div>
                        <div class="dropdown-content scrolling menu">
                            @foreach (App\Models\Patient::select(['id', 'patient_fname', 'patient_mname', 'patient_lname', 'patient_address'])->get() as $pt)
                                <div class="item flex align-center">
                                    <div class="flex justify-between">
                                        <div>
                                            <div class="font-bold">
                                                {{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mnmae }}
                                            </div>
                                            <div class="text-sm opacity-50">
                                                <i class="fa-solid fa-location-dot"></i> {{ $pt->patient_address }}
                                            </div>
                                        </div>
                                        <div>
                                            <x-atoms.ui.button class="btn-circle btn-primary btn-sm" wire:click.prevent="createAppt({{ $pt->id }})">
                                                <i class="fa-solid fa-add"></i>
                                            </x-atoms.ui.button>
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
            <x-atoms.ui.modal-title>
            @if ($modal['settings'])
                APPOINTMENT SETTINGS
            @elseif ($modal['update'])
                APPOINTMENT
            @endif
            </x-atoms.ui.modal-title>
        </div>
        <div>                
            @if ($modal['settings'] || $modal['settings2'])
                <x-atoms.ui.btn-close-modal/>
            @else
                @if (! $modal['add'])
                    <x-atoms.ui.btn-close-modal/>
                    <x-atoms.ui.button class="btn-primary ml-2" form="updateAppt" type="submit">Save</x-atoms.ui.button>
                @endif
            @endif
        </div>
    @endsection

    @section('modal_body')

        @if ($modal['settings'])
            <br><br>
            @if ($modal['settings2'])
                <form wire:submit.prevent="addApptCategory" action="" class="input-group">
                    {{-- <div class="ui action input fluid @error('apptCat.title') error @enderror"> --}}
                    <input class="input input-bordered w-full" wire:model.defer="apptCat.title" type="text" placeholder="Enter Category (Max of 20 characters)..." required>
                    <button type="submit" class="btn btn-square"><i class="fa-solid fa-add"></i></button>
                    {{-- </div> --}}
                </form>

                <br><br>

                <x-organisms.ui.table class="very basic fluid unstackable" style="width: 100%">
                    <x-slot name="thead"></x-slot>
                    <x-slot name="tbody">
                        @foreach ($categories as $category)
                            @php $error = !$category->status ? 'error' : ''; @endphp
                            <tr>

                                <td class="{{ $error }}" style="padding-left:1em; ">
                                    {{-- @if (!$category->status) <i class="fa-solid fa-attention" style="margin-right: 1em"></i> @endif --}}
                                    <i class="fa-solid fa-circle" style="color: {{ $category->color }}"></i>
                                    {{-- <div class="ui {{ $category->cname }} empty circular label" style="margin-right: 0.5em"></div> --}}
                                    {{ $category->title}}
                                </td>

                                <td class="right aligned {{ $error }}" style="width:6em">
                                    <div class="ui dropdown primary blue" x-init="$('.ui.dropdown').dropdown()">
                                        <i class="fa-solid fa-edit"></i>
                                        Pick a color
                                        <div class="menu left">
                                            <div class="scrolling menu">
                                                @foreach (colors() as $color)
                                                    <div wire:click.prevent="setColor('{{ $category->id }}', '{{ $color['value'] }}', '{{ $color['name'] }}')" class="item">
                                                        <i class="fa-solid fa-circle" style="color:{{ $color['value'] }}"></i>
                                                        {{ Str::title($color['name']) }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- <td class="text-right {{ $error }}" style="width: 7em;">
                                    <input class="checkbox checkbox-sm" wire:click.prevent="selectedApptCategory({{$category->id}})" type="checkbox" @if ($category->status) checked @endif>
                                </td> --}}
                                @if ($deletingApptCat)
                                    <td class="{{ $error }}" style="width:1em;">
                                        <button wire:click.prevent="deleteApptCategory({{ $category->id }})" class="btn btn-error btn-circle btn-sm animate_opacity"><i class="fa-solid fa-close"></i></button>                                    
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </x-slot>
                </x-organisms.ui.table>
            @else
                <div class="x-flex x-flex-xbetween x-flex-ycenter">

                      
                    <x-organisms.ui.tabs>
                        <x-organisms.ui.tabs.tab wire:click.prevent="$set('apptSettingsTabs', 1)" class="{{ $apptSettingsTabs == 1 ? 'tab-active' : ''; }}">
                            Days
                        </x-organisms.ui.tabs.tab>
                        <x-organisms.ui.tabs.tab wire:click.prevent="$set('apptSettingsTabs', 2)" class="{{ $apptSettingsTabs == 2 ? 'tab-active' : ''; }}">
                            Time
                        </x-organisms.ui.tabs.tab>
                        <x-organisms.ui.tabs.tab wire:click.prevent="$set('apptSettingsTabs', 3)" class="{{ $apptSettingsTabs == 3 ? 'tab-active' : ''; }}">
                            Year
                        </x-organisms.ui.tabs.tab>
                        <x-organisms.ui.tabs.tab wire:click.prevent="$set('apptSettingsTabs', 4)" class="{{ $apptSettingsTabs == 4 ? 'tab-active' : ''; }}">
                            Payment
                        </x-organisms.ui.tabs.tab>
                    </x-organisms.ui.tabs>

                    <div>
                        @if ($apptSettingsTabs == 1)
                            <x-atoms.ui.input style="opacity: 0"/>
                        @elseif ($apptSettingsTabs == 2)
                            <form wire:submit.prevent="timeSched" class="input-group">
                                <input class="input input-bordered @error('timeSched') input-error @enderror" wire:model.defer="timeSched" type="time" placeholder="Search...">
                                <button type="submit" class="btn btn-square btn-primary"><i class="fa-solid fa-plus"></i></button>
                            </form>
                        @elseif ($apptSettingsTabs == 3)
                            <form wire:submit.prevent="yearSched" class="input-group">
                                <input class="input input-bordered @if (session()->has('yearMessage')) input-error @endif" wire:model.defer="yearSched"  type="number" placeholder="e.g. {{ date('Y') }}" style="width:10em">
                                <button type="submit" class="btn btn-square btn-primary"><i class="fa-solid fa-plus"></i></button>
                            </form>
                        @elseif ($apptSettingsTabs == 4)
                            <x-atoms.ui.input style="opacity: 0"/>
                        @endif

                    </div>         

                </div>
            
                <br>
                @switch($apptSettingsTabs)
                    @case(1)
                        <x-organisms.ui.table class="selectable very basic unstackable mt-5">
                            <x-slot name="thead"></x-slot>
                            <x-slot name="tbody">
                                @foreach (App\Models\Day::select(['id', 'day', 'status'])->get() as $day)
                                    @php $error = !$day->status ? 'inactive' : 'active'; @endphp
                                    <tr>
                                        <td class="{{ $error }}">
                                            @if (!$day->status) <i class="attention icon"></i> @endif
                                            {{ $day->day}}
                                        </td>
                                        <td style="width: 5em">
                                            @if($day->status) 
                                                <span class="badge badge-sm badge-success w-20">Active</span>
                                            @else
                                                <span class="badge badge-sm badge-ghost w-20">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-right" style="width: 10em;">
                                            <input class="checkbox checkbox-sm" wire:click.prevent="selectedDay({{$day->id}})" type="checkbox" @if ($day->status) checked="checked" @endif> 
                                        </td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                        @break

                    @case(2)
                        <br>
                        @if (App\Models\Time::select(['id'])->count() > 0)
                            
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
                        <div class="flex flex-wrap gap-3 mt-3">
                            @forelse (App\Models\Year::orderBy('year')->get() as $year)
                                <div class="btn-group">
                                    <button class="btn">
                                        {{ $year->year }}
                                    </button>
                                    <button class="btn btn-active" wire:click.prevent="deleteYear({{ $year->id }})">
                                        <i class="fas fa-close"></i>
                                    </button>
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
                    @case(4)
                        <br>
                        <h1>payment</h1>
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

                        <div class="pt-5">
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
        @elseif ($modal['showPayment'])
            <img src="{{ storage('items', $paymentPhoto) }}" alt="">
        @endif         
    @endsection
</x-organisms.modal>


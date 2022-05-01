<x-layout.page-content>
    @section('section-page-title')
        <x-atoms.ui.header 
            title="Book"
            desc="Hello {{ Auth::user()->name }}"/>
    @endsection

    @section('section-links')
        {{-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla, similique.</p> --}}
        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, nisi.</p> --}}

        <div style="margin-left:auto; margin-right:auto;">
            <div class="ui compact menu">
                <div class="link item @if ($step == 1) active @endif" wire:click.prevent="step(1)">
                    My Information
                </div>
                <div class="link item @if ($step == 2) active @endif" wire:click.prevent="step(2)">
                    Booking
                </div>
                <div class="link item @if ($step == 3) active @endif" wire:click.prevent="step(3)">
                    Appointments
                </div>
            </div>
        </div>
    @endsection

    @section('section-heading-left')
    @endsection

    @section('section-heading-right')
        @if ($step == 3)
            <div class="x-flex x-flex-ycenter x-gap-1">
                {{-- <div class="ui horizontal divided list">
                    <div class="item">
                        <div class="content">
                             <a wire:click.prevent="$set('filter', 'all')" class="ui text grey"><b>{{ $this->countAppts('all') }}</b> All</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                             <a wire:click.prevent="$set('filter', 2)" class="ui text grey"><b>{{ $this->countAppts(2) }}</b> Ongoing</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                             <a wire:click.prevent="$set('filter', 1)" class="ui text grey"><b>{{ $this->countAppts(1) }}</b> For Approval</a>
                        </div>
                    </div>
                </div> --}}
                <div class="ui icon top right pointing dropdown button tiny" style="z-index:1">
                    <i class="filter icon"></i>
                    <div class="menu inverted">
                        <div class="header">Filter</div>
                        <div wire:click.prevent="$set('filter', 'all')" class="item">All ({{ $this->countAppts('all') }})</div>
                        @foreach (App\Models\Appointment_category::all() as $ac)
                            <div wire:click.prevent="$set('filter', {{ $ac->id }})" class="item {{ $this->countAppts($ac->id) == 0 ? 'disabled' : '' }}">{{ $ac->title }} ({{ $this->countAppts($ac->id) }})</div>
                        @endforeach
                        {{-- <div wire:click.prevent="$set('filter', 2)" class="item">Ongoing ({{ $this->countAppts(2) }})</div>
                        <div wire:click.prevent="$set('filter', 3)" class="item">Rescheduled ({{ $this->countAppts(5) }})</div>
                        <div wire:click.prevent="$set('filter', 4)" class="item">Missed ({{ $this->countAppts(4) }})</div>
                        <div wire:click.prevent="$set('filter', 5)" class="item">Fulfilled ({{ $this->countAppts(5) }})</div>
                        <div wire:click.prevent="$set('filter', 6)" class="item">Cancelled ({{ $this->countAppts(6) }})</div> --}}
                    </div>
                </div>
            </div>            
        @endif
    @endsection

    @section('section-main')

        @switch($step)
            @case(1)
                <form wire:submit.prevent="newPatient" class="ui form"
                    style="width:500px; margin-left:auto; margin-right:auto;">

                    <h3><span class="ui text blue">My personal infomation</span></h3>
                    <br>

                    <div>
                        <div class="two fields">
                            <div class="field">
                                <x-atoms.ui.label for="" class="">First name <x-atoms.ui.required/> @error('pt.fname')
                                        <span class="ui text red"> • {{ $message }}</span>
                                    @enderror
                                </x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.fname" type="text" class="mb_7" />
                                <x-atoms.ui.label for="" class="">Last name <x-atoms.ui.required/>@error('pt.lname')
                                        <span class="ui text red"> • {{ $message }}</span>
                                    @enderror
                                </x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.lname" type="text" class="mb_7" />
                                <x-atoms.ui.label for="" class="">M.I @error('pt.mname')
                                        <span class="ui text red"> •{{ $message }}</span>
                                    @enderror
                                </x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.mname" type="text" class="mb_7" />
                                <x-atoms.ui.label for="" class="">Age</x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.age" type="text" class="mb_7" />
                            </div>
                            <div class="field">
                                <x-atoms.ui.label for="" class="">Gender</x-atoms.ui.label>
                                <x-atoms.ui.select wire:model.defer="pt.gender" class="mb_7">
                                    <option value="" selected hidden>Select</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </x-atoms.ui.select>
                                <x-atoms.ui.label for="" class="">Address <x-atoms.ui.required/>@error('pt.addr')
                                        <span class="ui text red"> • {{ $message }}</span>
                                    @enderror
                                </x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.addr" type="text" class="mb_7" />
                                <x-atoms.ui.label for="" class="">Occupation</x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.occ" type="text" class="mb_7" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3><span class="ui text blue">Contact details</span></h3>
                        <br>
                        <div class="two fields">
                            <div class="field">
                                <x-atoms.ui.label for="" class="">Phone no <x-atoms.ui.required/>@error('pt.mobile')
                                        <span class="ui text red"> • {{ $message }}</span>
                                    @enderror
                                </x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.mobile" type="text" class="mb_7" />
                            </div>
                            <div class="field">
                                <x-atoms.ui.label for="" class="">Email</x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.email" type="text" class="mb_7" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="ui button primary">Save</button>
                </form>
            @break

            @case(2)
             {{ $time }}
                @if (App\Models\Setting::where('code', 11)->first()->status)

                    <div class="ui centered grid">
                        <div class="column" style="max-width:400px;">
                            <div class="ui styled fluid accordion" x-init="$('.ui.accordion').accordion();"
                                style="margin-left:auto; margin-right:auto; max-width:400px;">
                                <div class="title">
                                    <i class="dropdown icon"></i>
                                    Welcome!
                                </div>
                                <div class="content">
                                    <p class="transition hidden">A dog is a type of domesticated animal. Known for its loyalty and
                                        faithfulness, it can be found as a welcome guest in many households across the world.</p>
                                </div>
                                <div class="title">
                                    <i class="dropdown icon"></i>
                                    Important notice
                                </div>
                                <div class="content">
                                    <p>There are many breeds of dogs. Each breed varies in size and temperament. Owners often select
                                        a
                                        breed of dog that they find to be compatible with their own lifestyle and desires from a
                                        companion.</p>
                                </div>
                            </div>

                            <form wire:submit.prevent="confirmNewAppt" class="ui card fluid">
                                <div class="content">
                                    <div class="header">Pick a date</div>
                                    <div class="description">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, eligendi.
                                    </div>
                                    <x-organisms.ui.table class="very basic unstackable">
                                        <x-slot name="thead"></x-slot>
                                        <x-slot name="tbody">
                                            <tr>
                                                <td style="min-width:3em; width:6em;">
                                                    <label>Month<x-atoms.ui.required /></label>
                                                </td>
                                                <td>
                                                    <div class="ui selection dropdown">
                                                        <i class="dropdown icon"></i>
                                                        <div class="text">
                                                            {{ date('F', mktime(0, 0, 0, $month, $day, $year)) }}
                                                        </div>
                                                        <div class="menu">
                                                            {{-- @php $n = 0; @endphp --}}
                                                            @for ($n = 1; $n <= 12; $n++)
                                                                <div wire:click.prevent="$set('month', {{ $n }})" class="item">
                                                                    {{ date('F', mktime(0, 0, 0, $n, 1, $year)) }}
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Day<x-atoms.ui.required /></label>
                                                </td>
                                                <td>
                                                    <div class="ui selection dropdown" x-init="$('.ui.selection').dropdown()">
                                                        <i class="dropdown icon"></i>
                                                        <div class="text">
                                                            {{ $day . ', ' . date('l', mktime(0, 0, 0, $month, $day, $year)) }}
                                                        </div>
                                                        <div class="menu">
                                                            @for ($n = 1; $n <= date('t', mktime(0, 0, 0, $month, 1, $year)); $n++)
                                                                @if (date('l', mktime(0, 0, 0, $month, $n, $year)) != $this->findDay(date('l', mktime(0, 0, 0, $month, $n, $year))))
                                                                    <div wire:click.prevent="$set('day', {{ $n }})"
                                                                        class="item">{{ $n }} <span
                                                                            class="description">{{ date('D', mktime(0, 0, 0, $month, $n, $year)) }}</span>
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Year<x-atoms.ui.required /></label>
                                                </td>
                                                <td>
                                                    <div class="ui selection dropdown" x-init="$('.ui.selection').dropdown()">
                                                        <i class="dropdown icon"></i>
                                                        <div class="text">{{ $year }}</div>
                                                        <div class="menu">
                                                            @foreach (App\Models\Year::orderBy('year')->get() as $year)
                                                                <div wire:click.prevent="$set('year', {{ $year->year }})" class="item">{{ $year->year }}</div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Time<x-atoms.ui.required /></label>
                                                </td>
                                                <td>
                                                    <div class="ui selection dropdown" x-init="$('.ui.selection').dropdown()">
                                                        <i class="dropdown icon"></i>
                                                        <div class="text">{{ $this->time($appt['time']) }}</div>
                                                        <div class="menu">
                                                            <div class="header">
                                                                <i class="time icon"></i>
                                                                AM
                                                            </div>
                                                            @foreach (App\Models\Time::orderBy('time')->get() as $time)
                                                                @if (Str::of(humanReadableTime($time->time))->lower()->contains('am'))
                                                                    <div wire:click.prevent="$set('time', {{ $time->time }})" class="item">
                                                                        {{ humanReadableTime($time->time) }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            <div class="header">
                                                                <i class="time icon"></i>
                                                                PM
                                                            </div>
                                                            @foreach (App\Models\Time::orderBy('time')->get() as $time)
                                                                @if (Str::of(humanReadableTime($time->time))->lower()->contains('pm'))
                                                                    <div wire:click.prevent="$set('time', {{ $time->time }})" class="item">
                                                                        {{ humanReadableTime($time->time) }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </x-slot>
                                    </x-organisms.ui.table>
                                </div>
                                <button type="submit" class="ui bottom attached primary button">
                                    Book Now
                                    <i class="arrow right icon"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="ui blue message">Sorry... Booking is not available for now.</div>
                @endif
            @break

            @case(3)
                <div>
                    <div class="ui centered grid">
                        @forelse ($my_appts as $appt)
                            <div class="four wide computer eight wide tablet sixteen wide mobile column animate_zoom">
                                <div class="ui raised link fluid card">
                                    <div class="content">
                                        <div class="right floated">
                                            <x-atom.more>
                                                <x-atom.more.option wire-click="apptShowModal('isUpdate', {{ $appt->id }})" option-name="Edit"/>
                                                <x-atom.more.option wire-click="cancelingAppt({{ $appt->id }})" option-name="Cancel"/>
                                            </x-atom.more>
                                        </div>
                                        <div class="header">{{ humanReadableDate($appt->appt_date) }}</div>
                                        <div class="meta">{{ humanReadableDay($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . humanReadableTime($appt->appt_time) : '' }}</div>
                                    </div>
                                    <div class="ui inverted segment secondary {{ $appt->appointment_category->cname }}">
                                        <div class="x-flex x-flex-xbetween x-flex-ycenter">
                                            <span style="" data-inverted="" data-tooltip="Created at: {{ humanReadableDate($appt->created_at) . ' @ ' . humanReadableTime($appt->created_at) }}" data-position="top left" data-variation="small">
                                                <i class="info icon"></i>
                                                {{ $appt->appointment_category->title }}
                                            </span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-organisms.ui.table.search-no-results colspan="4" message="No appointment yet." />
                        @endforelse
                    </div>
                </div>
            @break

            @default
        @endswitch
    @endsection

</x-layout.page-content>

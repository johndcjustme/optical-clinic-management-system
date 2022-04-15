<x-layout.page-content>
    @section('section-page-title')
        <div class="">
            <div>
                <x-atoms.ui.header>
                    Hello {{ Auth::user()->name }}
                </x-atoms.ui.header>
            </div>
            <div>
                <small>{{ Auth::user()->email }}</small>
            </div>
        </div>
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
                                <x-atoms.ui.label for="" class="">First name @error('pt.fname')
                                        <span class="ui text red"> • {{ $message }}</span>
                                    @enderror
                                </x-atoms.ui.label>
                                <x-atoms.ui.input wire-model="pt.fname" type="text" class="mb_7" />
                                <x-atoms.ui.label for="" class="">Last name @error('pt.lname')
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
                                <x-atoms.ui.label for="" class="">Address @error('pt.addr')
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
                                <x-atoms.ui.label for="" class="">Phone no @error('pt.mobile')
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
    
                @if (App\Models\Setting::where('code', 11)->first()->status)

                    <div style="width:100%;">

                        <div style="" style="max-width:400px;">

                                <div class="ui styled fluid accordion" x-init="$('.ui.accordion').accordion();"
                                    style="margin-left:auto; margin-right:auto; max-width:400px;">
                                    <div class="title">
                                        <i class="dropdown icon"></i>
                                        What is a dog?
                                    </div>
                                    <div class="content">
                                        <p class="transition hidden">A dog is a type of domesticated animal. Known for its loyalty and
                                            faithfulness, it can be found as a welcome guest in many households across the world.</p>
                                    </div>
                                    <div class="title">
                                        <i class="dropdown icon"></i>
                                        What kinds of dogs are there?
                                    </div>
                                    <div class="content">
                                        <p>There are many breeds of dogs. Each breed varies in size and temperament. Owners often select a
                                            breed of dog that they find to be compatible with their own lifestyle and desires from a
                                            companion.</p>
                                    </div>
                                    <div class="title">
                                        <i class="dropdown icon"></i>
                                        How do you acquire a dog?
                                    </div>
                                    <div class="content">
                                        <p>Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or
                                            shelters.</p>
                                        <p>A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows
                                            you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly,
                                            finding your dog from a shelter, helps give a good home to a dog who may not find one so
                                            readily.</p>
                                    </div>
                                </div>


                                <form wire:submit.prevent="newAppt" class="ui card fluid"
                                    style="margin-left:auto; margin-right:auto; max-width:400px">
                                    {{-- <div class="ui card"> --}}


                                    <div class="content">
                                        <div class="header">Pick a schedule</div>
                                        {{-- <div class="meta">Friend</div> --}}
                                        <div class="description">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, eligendi.
                                        </div>


{{-- 
                                        <h3><span class="ui text blue">Pick a schedule</span>
                                            @error('appt.date')
                                                <span class="ui text red"> {{ $message }}</span>
                                            @enderror
                                        </h3> --}}
                                        <x-organisms.ui.table class="very basic">
                                            <x-slot name="thead"></x-slot>
                                            <x-slot name="tbody">
                                                <tr>
                                                    <td style="width:6em;">
                                                        <div><label>Month
                                                            <x-atoms.ui.required />
                                                        </label></div>
                                                    </td>
                                                    <td>
                                                        <div class="ui selection dropdown">
                                                            <i class="dropdown icon"></i>
                                                            <div class="text">
                                                                {{ date('F', mktime(0, 0, 0, $month, $day, $year)) }}
                                                            </div>
                                                            <div class="menu">
                                                                @php
                                                                    $n = 0;
                                                                @endphp
                                                                @for ($n = 1; $n <= 12; $n++)
                                                                    <div wire:click.prevent="$set('month', {{ $n }})"
                                                                        class="item">
                                                                        {{ date('F', mktime(0, 0, 0, $n, 1, $year)) }}
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><label>Day
                                                                <x-atoms.ui.required />
                                                            </label></div>
                                                    </td>
                                                    <td>
                                                        <div class="ui selection dropdown" x-init="$('.ui.selection').dropdown()">
                                                            <i class="dropdown icon"></i>
                                                            <div class="text">
                                                                {{ $day . ', ' . date('l', mktime(0, 0, 0, $month, $day, $year)) }}</div>
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
                                                        <div><label>Year
                                                                <x-atoms.ui.required />
                                                            </label></div>
                                                    </td>
                                                    <td>
                                                        <div class="ui selection dropdown" x-init="$('.ui.selection').dropdown()">
                                                            <i class="dropdown icon"></i>
                                                            <div class="text">{{ $year }}</div>
                                                            <div class="menu">
                                                                @foreach (App\Models\Year::orderBy('year')->get() as $year)
                                                                    <div wire:click.prevent="$set('year', {{ $year->year }})"
                                                                        class="item">{{ $year->year }}</span></div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div><label>Time
                                                                <x-atoms.ui.required />
                                                            </label></div>
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
                                                                    @if (Str::of($this->time($time->time))->lower()->contains('am'))
                                                                        <div wire:click.prevent="$set('appt.time', {{ $time->time }})"
                                                                            class="item">{{ $this->time($time->time) }}</span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="header">
                                                                    <i class="time icon"></i>
                                                                    PM
                                                                </div>
                                                                @foreach (App\Models\Time::orderBy('time')->get() as $time)
                                                                    @if (Str::of($this->time($time->time))->lower()->contains('pm'))
                                                                        <div wire:click.prevent="$set('appt.time', {{ $time->time }})"
                                                                            class="item">{{ $this->time($time->time) }}</span>
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

                <div class="mb_20">

                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            {{-- <x-organisms.ui.table.th-checkbox/> --}}
                            <x-organisms.ui.table.th label="Appointments" />
                            <x-organisms.ui.table.th label="Status" style="width:25%" />
                            <x-organisms.ui.table.th label="Contact Number" style="width:25%" />
                            <x-organisms.ui.table.th label="Date Created" style="width:25%" />
                            <x-organisms.ui.table.th-more />
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($my_appts as $appt)
                                <tr>
                                    <x-organisms.ui.table.td text="{{ $this->date($appt->appt_date) }}"
                                        desc="{{ $this->day($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . $this->time($appt->appt_time) : '' }}" />
                                    <x-organisms.ui.table.td>
                                        <p style="color:{{ $this->statusColor($appt->appt_status) }}">
                                            {{ $this->apptStatus($appt->appt_status) }}
                                        </p>
                                    </x-organisms.ui.table.td>
                                    <x-organisms.ui.table.td text="{{ $appt->patient->patient_mobile }}"
                                        desc="{{ $appt->patient->patient_email }}" text-icon="fa-square-phone" />
                                    <x-organisms.ui.table.td
                                        desc="{{ $this->date($appt->created_at) . ' @ ' . $this->time($appt->created_at) }}" />
                                    <x-organisms.ui.table.td-more style="width: 1em">
                                        <x-atom.more.option wire-click="apptShowModal('isUpdate', {{ $appt->id }})"
                                            option-name="Edit" />
                                        <x-atom.more.option wire-click="cancelingAppt({{ $appt->id }})" option-name="Cancel" />
                                        </x-organisms.ui.table.td>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="4" message="No appointment yet." />
                            @endforelse

                        </x-slot>
                    </x-organisms.ui.table>




                </div>
            @break

            @default
        @endswitch
    @endsection

</x-layout.page-content>

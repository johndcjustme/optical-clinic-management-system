
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
        <div>
            <div class="ui mini steps inline fluid" style="z-index: -5">
                <div class="pointer step @if ($step == 1) active @endif" wire:click.prevent="step(1)">
                  {{-- <i class="user check icon"></i> --}}
                  <div class="content">
                    <div class="title">About Me</div>
                    {{-- <div class="description">Choose your shipping options</div> --}}
                  </div>
                </div>
                <div class="pointer step @if ($step == 2) active @endif" wire:click.prevent="step(2)">
                  {{-- <i class="calendar check icon"></i> --}}
                  <div class="content">
                    <div class="title">Book</div>
                    {{-- <div class="description">Enter billing information</div> --}}
                  </div>
                </div>
                <div class="pointer step @if ($step == 3) active @endif" wire:click.prevent="step(3)">
                  {{-- <i class="calendar alternate icon"></i> --}}
                  <div class="content">
                    <div class="title">My Schedules</div>
                    {{-- <div class="description">Verify order details</div> --}}
                  </div>
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
                            <form wire:submit.prevent="newPatient" class="ui form">
                                <h3><span class="ui text blue">My personal infomation</span></h3>
                                <br>
        
                                <div>
                                    <div class="two fields">
                                        <div class="field">
                                            <x-atoms.ui.label for="" class="">First name @error('pt.fname') <span class="ui text red"> • {{ $message }}</span> @enderror</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.fname" type="text" class="mb_7"/>
                                            <x-atoms.ui.label for="" class="">Last name @error('pt.lname') <span class="ui text red"> • {{ $message }}</span> @enderror</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.lname" type="text" class="mb_7"/>
                                            <x-atoms.ui.label for="" class="">M.I @error('pt.mname') <span class="ui text red"> •{{ $message }}</span> @enderror</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.mname" type="text" class="mb_7"/>
                                            <x-atoms.ui.label for="" class="">Age</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.age" type="text" class="mb_7"/>
                                        </div>
                                        <div class="field">
                                            <x-atoms.ui.label for="" class="">Gender</x-atoms.ui.label>
                                            <x-atoms.ui.select wire:model.defer="pt.gender" class="mb_7">
                                                <option value="" selected hidden>Select</option>
                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                            </x-atoms.ui.select>
                                            <x-atoms.ui.label for="" class="">Address @error('pt.addr') <span class="ui text red"> • {{ $message }}</span> @enderror</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.addr" type="text" class="mb_7"/>
                                            <x-atoms.ui.label for="" class="">Occupation</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.occ" type="text" class="mb_7"/>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3><span class="ui text blue">Contact details</span></h3>
                                    <br>
                                    <div class="two fields">
                                        <div class="field">
                                            <x-atoms.ui.label for="" class="">Phone no @error('pt.mobile') <span class="ui text red"> • {{ $message }}</span> @enderror</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.mobile" type="text" class="mb_7"/>
                                        
                                        </div>
                                        <div class="field">
                                            <x-atoms.ui.label for="" class="">Email</x-atoms.ui.label>
                                            <x-atoms.ui.input wire-model="pt.email" type="text" class="mb_7"/>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="ui button primary">Confrim and Proceed</button>
                            </form>
                            @break
                    
                        @case(2)
                            <div class="grid grid_col-2 gap_1" style="grid-template-columns: auto 250px">

                                <form wire:submit.prevent="newAppt">
                                    <div>
                                        <div>
                                            <h3><span class="ui text blue">Pick a Date</span> @error('appt.date') <span class="ui text red"> • {{ $message }}</span> @enderror</h3>
                                            <x-atoms.ui.input wire-model="appt.date" type="date" class="mb_7" />
                                        </div>
                                        <br>
                                        <h3><span class="ui text blue">Time @error('appt.time')</span> <span class="ui text red"> • {{ $message }}</span> @enderror</h3><br>
                                        <div>
                                            <h5>Morning</h5>
                                            <div class="flex flex_wrap gap_1">
                                                @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                                                    @if (Str::of($this->time($time->time))->lower()->contains('am'))
                                                        <label for="{{ $time->id }}" class="ui basic button">{{ $this->time($time->time) }}</label>
                                                        <input wire:model.defer="appt.time" value="{{ $time->time }}" type="radio" name="time" id="{{ $time->id }}" style="display:none" hidden>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>
                                        <div>
                                            <h5>Afternoon</h5>
                                            <div class="flex flex_wrap gap_1">
                                                @foreach (App\Models\Time::orderBy('time', 'asc')->get() as $time)
                                                    @if (Str::of($this->time($time->time))->lower()->contains('pm'))
                                                        <label for="{{ $time->id }}" class="ui basic button">{{ $this->time($time->time) }}</label>
                                                        <input wire:model.defer="appt.time" value="{{ $time->time }}" type="radio" name="time" id="{{ $time->id }}" style="display:none" hidden>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <button type="submit" class="ui button primary">Book now</button>
                                </form>
                                <div class="b_1 radius_1 p_10">
                                    <h5>Holidays</h5>
                                    <div>
                                        <ul class="">
                                            <li>
                                                New Year
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case(3)

                            <div class="mb_20">

                                <x-organisms.ui.table class="selectable">
                                    <x-slot name="thead">
                                        {{-- <x-organisms.ui.table.th-checkbox/> --}}
                                        <x-organisms.ui.table.th label="My Appointment"/>
                                        <x-organisms.ui.table.th label="Status" style="width:25%"/>
                                        <x-organisms.ui.table.th label="Contact Number" style="width:25%"/>
                                        <x-organisms.ui.table.th label="Date Created" style="width:25%"/>
                                        <x-organisms.ui.table.th-more/>
                                    </x-slot>
                                    <x-slot name="tbody">
                                        @forelse ($my_appts as $appt)
                                            <tr>
                                                <x-organisms.ui.table.td
                                                    text="{{ $this->date($appt->appt_date) }}"
                                                    desc="{{ $this->day($appt->appt_date) }} {{ !empty($appt->appt_time) ? ' • ' . $this->time($appt->appt_time) : '' }}"/>
                                                <x-organisms.ui.table.td>
                                                    <p style="color:{{ $this->statusColor($appt->appt_status) }}">
                                                        {{ $this->apptStatus($appt->appt_status) }}
                                                    </p>
                                                </x-organisms.ui.table.td>
                                                <x-organisms.ui.table.td 
                                                    text="{{ $appt->patient->patient_mobile }}"
                                                    desc="{{ $appt->patient->patient_email }}"
                                                    text-icon="fa-square-phone"/>
                                                <x-organisms.ui.table.td
                                                    desc="{{ $this->date($appt->created_at) . ' @ ' . $this->time($appt->created_at) }}"/>
                                                <x-organisms.ui.table.td-more style="width: 1em">
                                                    <x-atom.more.option wire-click="apptShowModal('isUpdate', {{ $appt->id }})" option-name="Edit" />
                                                    <x-atom.more.option wire-click="cancelingAppt({{ $appt->id }})" option-name="Cancel" />
                                                </x-organisms.ui.table.td>
                                            </tr>
                                        @empty
                                            <x-organisms.ui.table.search-no-results colspan="4" message="No appointment yet."/>
                                        @endforelse
        
                                    </x-slot>
                                </x-organisms.ui.table>
        
        
        
        
                            </div>
                            @break
                        @default
                            
                    @endswitch

                    


           
    @endsection

</x-layout.page-content>
<x-organisms.modal on-close="@wire.apptCloseModal">

    @section('modal_title')
        <div class="full_w flex flex_x_between full_w">
            <div>
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
            <div>
                <x-atom.btn-close-modal wire-click="apptCloseModal"/>  
                @if ($isFillSearch)
                    <x-atom.btn-save-modal form="createAppt" val=""/>  
                @else 
                <x-atom.btn-save-modal form="updateAppt" val=""/>  

                @endif
            </div>
        </div>
    @endsection

    @section('modal_body')
        @if ($isAdd)
            @if ($addAppt)
                
            @else
                <div class="overflow_hidden">
                    <div>                    
                        <form class="relative" id="createAppt" wire:submit.prevent="createAppt({{ $searchPatientId }})">
                            <input wire:model.debounce.500ms="searchPatient" type="text" placeholder="Search patient here" required autofocus>
                            <p wire:click.prevent="clearSearch" class="absolute right font_s accent_1 pointer" style="top:1.1em; right: 0.5em;">RESET</p>
                        </form>
                        @if (! $isFillSearch)
                            @if (! empty($searchPatient))
                                <div wire:loading.remove wire:target="searchPatient" class="relative">
                                    <div class="overflow_y" style="max-height: 300px;">
                                        <ul class="selectable" style="height: auto; {{ count($patients) > 0 ? 'margin-bottom:5em;' : '' }}">
                                            @forelse ($patients as $pt)
                                                <li wire:click.prevent="autoCompleteSearch({{ $pt->id }})" class="" style="line-height: 1rem">
                                                    <div class="py_4">
                                                        <p>{{ $pt->patient_lname . ', ' . $pt->patient_fname . ' ' . $pt->patient_mname }}</p>
                                                        @if (isset($pt->patient_address))
                                                            <small class="dark_200">
                                                                {{ $pt->patient_address }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </li>
                                            @empty
                                                <p class="font_m text_center my_7 dark_200">No results with that query.</p>
                                            @endforelse
                                        </ul>
                                    </div>
                                    @if (count($patients) > 0)
                                        <div class="absolute bottom left right" style="pointer-events:none; height: 4em; background: linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);"></div> 
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        @elseif ($isUpdate)
            <form id="updateAppt" wire:submit.prevent="updateAppt('{{ $apptCreatedBy }}', {{ $appt['id'] }})">
                <div class="grid grid_col_2 gap_1" style="grid-template-columns: 3em auto">
                    <div>
                        <x-atom.profile-photo size="3em" path="storage/photos/avatars/{{ $appt['pt_avatar'] }}" />
                    </div>
                    <div>
                        <h5>{{ $appt['pt_name'] }}</h5>
                        <div class="mt_7">
                            @if (isset($appt['pt_addr']))
                                <p class="my_7 font_m">
                                    <i class="text_center fa-solid dark_100 fa-location-dot" style="width: 1.1em"></i>
                                    <span>
                                        {{ $appt['pt_addr'] }}
                                    </span>
                                </p>
                            @endif
                            @if ( isset($appt['pt_phone']))
                                <p class="my_7 font_m">
                                    <i class="text_center fa-solid dark_100 fa-phone" style="width: 1.1em"></i>
                                    <span>
                                        {{ $appt['pt_phone'] }}
                                    </span>
                                </p>
                            @endif
                            @if (isset($appt['pt_occ']))
                                <p class="my_7 font_m">
                                    <i class="text_center fa-solid dark_100 fa-briefcase" style="width: 1.1em"></i>
                                    <span>
                                        {{ $appt['pt_occ'] }}
                                    </span>
                                </p>
                            @endif
                        </div>
                
                        <br><br>

                        <label for="">Appointment Date</label>
                        <input wire:model.defer="appt.pt_date" type="date" required>
                        <label for="">Time</label>
                        <input wire:model.defer="appt.pt_time" type="time">
                        <label for="">Status</label>
                        <select wire:model.defer="appt.pt_status" name="" id="">
                            <option value="{{ $appt['pt_status'] }}" selected hidden></option>
                            <option value="fa">{{ $apptStatus['fa'] }}</option>
                            <option value="on">{{ $apptStatus['on'] }}</option>
                            <option value="re">{{ $apptStatus['re'] }}</option>
                            <option value="mi">{{ $apptStatus['mi'] }}</option>
                            <option value="fu">{{ $apptStatus['fu'] }}</option>
                        </select>
                    </div>
                </div>
            </form>
        @endif
        
    @endsection

</x-organisms.modal>


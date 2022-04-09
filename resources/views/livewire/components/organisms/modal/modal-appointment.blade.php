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
                @if (! $modal['add'])
                    <a wire:click.prevent="closeModal" href="#" class="ui button tiny basic" rel="modal:close">Close</a>
                    <x-atoms.ui.button class="secondary tiny" form="updateAppt" type="submit">Save</i></x-atoms.ui.button>
                @endif
            </div>
        </div>
    @endsection

    @section('modal_body')
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
                            <a href="#" class="ui button tiny basic" rel="modal:close">Close</a>
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
                            <label for="">Appointment Date</label>
                            <x-atoms.ui.input wire-model="appt.pt_date" type="date" class="fluid" required/>
                            <x-atoms.ui.label>Time</x-atoms.ui.label>
                            <x-atoms.ui.input wire-model="appt.pt_time" type="time" class="fluid" required/>
                            <x-atoms.ui.label>Status</x-atoms.ui.label>
                            <x-atoms.ui.select wire:model.defer="appt.pt_status" class="mb_7 fluid">
                                <option class="item" value="{{ $appt['pt_status'] }}" selected hidden></option>
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
        
    @endsection

</x-organisms.modal>


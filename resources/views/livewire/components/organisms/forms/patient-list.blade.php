<div class="flex flex_column full_h p_8 overflow_hidden" style="min-width: 220px; max-width: 240px;">
    {{-- The whole world belongs to you. --}}
    <div>
        <div>
            @includeIf('livewire.components.atoms.btn-add-patient')
        </div>
        <div class="my_4">
            <x-input.search wire-model="searchPatient"/>
            {{-- <input type="search" wire:model.debounce.200ms="searchPatient" placeholder="Search Patient"> --}}
        </div>
        <div class="flex full_w gap_1">
            <select wire:model="sortPatient" class="input_small" style="width: 50%;">
                <option value="Sort" selected hidden disabled>Sort</option>
                <option value="patient_lname">Name</option>
                <option value="created_at">Date Added</option>
                <option value="updated_at">Last Modified</option>
            </select>
            <select wire:model="sortMethod" class="input_small" style="width: 50%;">
                <option value="Sort" selected hidden disabled>Sort</option>
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
        </div>
    </div>

    <hr class="my_5">

    <div class="overflow_y full_h noscroll" style="">
        <ul class="selectable pointer">

            @forelse ($patients as $patient)
            <li title="{{ Str::title($patient->patient_lname . ', ' . $patient->patient_fname . ' ' . $patient->patient_mname) }}" wire:click="showPatient({{ $patient->id }})">
                {{ Str::title($patient->patient_lname . ', ' . $patient->patient_fname . ' ' . $patient->patient_mname) }}
            </li>
            @empty
                <br><p><center>No patient.</center></p>
            @endforelse

        </ul>
    </div>
</div>

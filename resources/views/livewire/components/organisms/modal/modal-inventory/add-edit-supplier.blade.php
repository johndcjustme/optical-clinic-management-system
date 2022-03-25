<div class="ui form">
    <div class="two fields">
        <div class="field">
            <x-atoms.ui.label class="">Name @error('su.name') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="su.name" type="text" class="mb_7"/>
            <x-atoms.ui.label class="">Address</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="su.address" type="text" class="mb_7"/>
            <x-atoms.ui.label class="">Contact No</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="su.no" type="text" class="mb_7"/>
            <x-atoms.ui.label class="">Email</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="su.email" type="text" class="mb_7"/>
        </div>
        <div class="field">
            <x-atoms.ui.label class="">Branch</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="su.branch" type="text" class="mb_7"/>
            <x-atoms.ui.label class="">Bank</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="su.bank" type="text" class="mb_7"/>
            <x-atoms.ui.label class="">Account</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="su.acc" type="text" class="mb_7"/>
        </div>
    </div>
</div>
<br>
<div>
    @if ($su['has_avatar'])
        <p class="ui text grey" style="opacity: 0.7">This supplier has already an avatar. <strong>Choose file</strong> if you want to replace.</p>
    @endif
    <x-atoms.ui.input wire-model="su.avatar" type="file" class="mb_7 fluid"/>
</div>
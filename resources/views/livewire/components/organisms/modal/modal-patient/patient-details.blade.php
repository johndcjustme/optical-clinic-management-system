<x-atom.profile-photo size="3em" path="{{ $this->storage($pt['avatar']) }}"/>
<div style="display: grid; grid-template-columns:8em auto; gap:1em; margin-top:1em">
    <div style="opacity:0.7">Name</div>
        <div>
            <span style="margin-right:1em">:</span>
            {{ $pt['fullname'] }}
        </div>
    <div style="opacity:0.7">Age</div>
        <div>
            <span style="margin-right:1em">:</span>
            {{ $pt['age'] }}
        </div>
    <div style="opacity:0.7">Address</div>
        <div>
            <span style="margin-right:1em">:</span>
            {{ $pt['addr'] }}
        </div>
    <div style="opacity:0.7">Occupation</div>
        <div>
            <span style="margin-right:1em">:</span>
            {{ $pt['occ'] }}
        </div>
    <div style="opacity:0.7">Gender</div>
        <div>
            <span style="margin-right:1em">:</span>
            {{ $pt['gender'] }}
        </div>
    <div class="mt_10" style="opacity:0.7">Contact Number</div>
        <div class="mt_10">
            <span style="margin-right:1em">:</span>
            {{ $pt['no'] }}
        </div>
    <div style="opacity:0.7">Email Address</div>
        <div>
            <span style="margin-right:1em">:</span>
            {{ $pt['email'] }}
        </div>
</div>
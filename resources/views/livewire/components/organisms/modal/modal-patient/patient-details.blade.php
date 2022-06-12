
    <x-organisms.ui.table class="unstackable very basic">
        <x-slot name="thead"></x-slot>
        <x-slot name="tbody">
            <tr>
                <x-organisms.ui.table.td text="Name" class="opacity-50" style="width: 10em"/>
                <x-organisms.ui.table.td text="{{ $pt['fullname'] }}" />
            </tr>
            <tr>
                <x-organisms.ui.table.td text="Age" class="opacity-50" />
                <x-organisms.ui.table.td text="{{ $pt['age'] }}" />
            </tr>
            <tr>
                <x-organisms.ui.table.td text="Address" class="opacity-50"/>
                <x-organisms.ui.table.td text="{{ $pt['addr'] }}" />
            </tr>
            <tr>
                <x-organisms.ui.table.td text="Name" class="opacity-50"/>
                <x-organisms.ui.table.td text="{{ $pt['addr'] }}" />
            </tr>
            <tr>
                <x-organisms.ui.table.td text="Occupation" class="opacity-50"/>
                <x-organisms.ui.table.td text="{{ $pt['occ'] }}" />
            </tr>
            <tr>
                <x-organisms.ui.table.td text="Gender" class="opacity-50"/>
                <x-organisms.ui.table.td text="{{ $pt['gender'] }}" />
            </tr>
            <tr>
                <x-organisms.ui.table.td text="Contact Number" class="opacity-50"/>
                <x-organisms.ui.table.td text="{{ $pt['no'] }}" />
            </tr>
            <tr>
                <x-organisms.ui.table.td text="Email Address" class="opacity-50"/>
                <x-organisms.ui.table.td text="{{ $pt['email'] }}" />
            </tr>
        </x-slot>
    </x-organisms.ui.table>

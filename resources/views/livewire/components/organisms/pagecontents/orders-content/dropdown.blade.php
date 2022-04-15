<x-atoms.ui.header-dropdown-menu class="right pointing tiny">
    <x-slot name="menu"> 
        <div class="item">
            <x-molecules.ui.dropdown.icon/>
            <span class="text">Filter</span>
            <x-molecules.ui.dropdown.menu>
                <div wire:click.prevent="$set('filter', 'DATE_RANGE')" class="item">
                    Date Range
                </div>
                <div wire:click.prevent="$set('filter', 'DATE_SINGLE')" class="item">
                    Single Date
                </div>
                <div class="header">
                    Filter by tag
                </div>
                <div class="divider"></div>
                <div class="item">
                    Today
                </div>
                <div class="item">
                    This Week
                </div>
                <div class="item">
                    This Month
                </div>
            </x-molecules.ui.dropdown.menu>
        </div>
        <div class="item">
            <x-molecules.ui.dropdown.icon/>
            <span class="text">Showing {{ $pageNumber }} Entries</span>
            <x-molecules.ui.dropdown.menu>
                <x-organisms.ui.paginator-number/>
            </x-molecules.ui.dropdown.menu>
        </div>
    </x-slot>
</x-atoms.ui.header-dropdown-menu>
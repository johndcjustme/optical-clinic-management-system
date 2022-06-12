<x-layout.page-content>


    @section('section-page-title')
        <x-atoms.ui.header 
            title="Supplier"
            desc="{{ $this->emptySupplier() ? ' Total of ' . App\Models\Supplier::count() . ' Suppliers' : ''}}"/>
    @endsection

    @section('section-links')
    @endsection

    @section('section-heading-right')
        @if ($this->emptySupplier())
            <x-atoms.ui.search wire-model="searchSupplier" placeholder="Search..."/>
            <x-organisms.ui.dropdown-end>
                <x-organisms.ui.dropdown-entries :pagenumber="$pageNumber"/>
            </x-organisms.ui.dropdown-end>
        @endif
    @endsection

    @section('section-heading-left')
            @if (count($selectedSuppliers) > 0)
                <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedSuppliers', [])" class="left pointing tiny">
                    <x-slot name="label">
                        {{ count($selectedSuppliers) }} Selected 
                    </x-slot>
                    <x-slot name="menu"> 
                        <li class="item" wire:click.prevent="deletingSuppliers">
                            <a href="">
                                <i class="delete icon"></i> Delete
                            </a>
                        </li>
                    </x-slot>
                </x-atoms.ui.header-dropdown-menu>
            @else
                <x-atoms.ui.header-add-btn label="Add Supplier" wire-click="showModal('add', null)"/>
            @endif
    @endsection


    @section('section-main')
        @if ($this->emptySupplier())
            <x-organisms.ui.table class="selectable">
                <x-slot name="thead">
                    <x-organisms.ui.table.th-checkbox/>
                    <x-organisms.ui.table.th label="Name" order-by="supplier_name" />
                    <x-organisms.ui.table.th label="Contact"/>
                    <x-organisms.ui.table.th label="Bank Account"/>
                    <x-organisms.ui.table.th-more/>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($suppliers as $su)
                        <tr>
                            <x-organisms.ui.table.td 
                                checkbox="selectedSuppliers" 
                                checkbox-value="{{ $su->id }}"/>
                            <x-organisms.ui.table.td 
                                text="{{ $su->supplier_name }}"
                                desc="{{ !empty($su->supplier_branch) ? $su->supplier_branch : '' }} {{ !empty($su->supplier_address) ? ' • ' . $su->supplier_address : ''; }}"
                                desc-icon="{{ !empty($su->supplier_branch) ? 'fa-location-dot' : ''; }}"
                                avatar="{{ $this->storage($su->supplier_avatar) }}"/>
                            <x-organisms.ui.table.td 
                                text="{{ $su->supplier_contact_no }}"
                                desc="{{ !empty($su->supplier_email) ? $su->supplier_email : '' }}"
                                desc-icon="{{ !empty($su->supplier_email) ? 'fa-envelope' : ''; }}"/>
                            <x-organisms.ui.table.td 
                                text="{{ $su->supplier_bank }}"
                                desc="{{ $su->supplier_acc_no }}"/>
                            <x-organisms.ui.table.td-more>
                                <x-atom.more.option
                                    wire-click="showModal('update', {{ $su->id }})"
                                    option-name="Edit" />
                                <x-atom.more.option 
                                    wire-click="deletingSupplier({{ $su->id }}, '{{ $su->supplier_name }}')"
                                    option-name="Delete" />
                            </x-organisms.ui.table.td>
                        </tr>
                    @empty
                        <x-organisms.ui.table.search-no-results colspan="7"/>
                    @endforelse
                </x-slot>
            </x-organisms.ui.table>
            @if (count($suppliers) > 0)
                {{ $suppliers->links('livewire.components.paginator') }}
            @endif
        @else
            <x-atoms.ui.message 
                icon="frown open"
                class="mt_20"
                header="No suppliers added yet."
                message="This section will contain suppliers of your items."/>
        @endif
    @endsection
</x-layout.page-content>
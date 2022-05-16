<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Ledger"
            desc="Lorem Ipsum dolor."/>        
    @endsection

    @section('section-links')
        <div class="ui compact tiny menu">
            <div wire:click.prevent="$set('subPage', 1)" class="link item {{ $subPage == 1 ? 'active' : '' }}">Cash</div>
            <div wire:click.prevent="$set('subPage', 2)" class="link item {{ $subPage == 2 ? 'active' : '' }}">Payment</div>
            <div wire:click.prevent="$set('subPage', 3)" class="link item {{ $subPage == 3 ? 'active' : '' }}">Debit</div>
        </div>
    @endsection

    @section('section-heading-left')
        @if (count($selectedItems) > 0)
            <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedItems', [])" class="left pointing tiny">
                <x-slot name="label">
                    {{ count($selectedItems) }} Selected 
                </x-slot>
                <x-slot name="menu">
                    <div wire:click.prevent="batchDeletingCashType" class="item"><i class="delete icon"></i> Delete</div>
                </x-slot>
            </x-atoms.ui.header-dropdown-menu>
        @else
            <div class="ui top icon basic primary left pointing tiny dropdown button" style="z-index: 2" x-init="$('.ui.top.icon').dropdown()">
                <i class="add icon"></i>
                <span>Add</span>
                <div class="menu">
                <div class="ui search icon input">
                    <i class="search icon"></i>
                    <input type="text" name="search" placeholder="Search...">
                </div>
                <div class="scrolling menu">
                    <div class="divider"></div>
                    <div class="header">
                        <i class="tags icon"></i>
                        Cash Types
                    </div>
                    @foreach ($cashTypes as $ct)
                        <div wire:click.prevent="addCashType('{{ $ct }}')" class="item">
                            {{ $ct }}
                        </div>
                    @endforeach
    
                    <div class="divider"></div>
                    <div class="header">
                        <i class="tags icon"></i>
                        Cash in Bank
                    </div>
                    @foreach ($cashInBank as $cb) 
                        <div wire:click.prevent="addCashType('Cash in Bank - {{ $cb }}')" class="item">
                            {{ $cb }}
                        </div>
                    @endforeach
                    <div class="divider"></div>
                    <div class="header">
                        <i class="tags icon"></i>
                        Others
                    </div>
                    <form wire:submit.prevent="addCashType" class="ui search input">
                        <input wire:model.defer="otherCashType" type="text" name="search" placeholder="Please specify...">
                        <button type="submit" class="ui button fluid" style="margin-left: 0.5em">Ok</button>
                    </form>
                </div>
                </div>
            </div>
        @endif
    @endsection

    @section('section-heading-right')
    right
    @endsection

    @section('section-main')

            <div class="ui card">
                <div class="content">
                    <h2>2000</h2>
                </div>
            </div>

        <x-organisms.ui.table class="selectable unstackable">
            <x-slot name="thead">
                <x-organisms.ui.table.th-checkbox/>
                <x-organisms.ui.table.th label="Cash Type"/>
                <x-organisms.ui.table.th label="Beginning Balance" style="width:14em;"/>
                <x-organisms.ui.table.th label="In" style="width:14em;"/>
                <x-organisms.ui.table.th label="Out" style="width:14em;"/>
                <x-organisms.ui.table.th label="Ending Balance" style="width:14em;"/>
                <x-organisms.ui.table.th-more/>
            </x-slot>
            <x-slot name="tbody">
                @foreach ($cashtypes as $ct)
                    <tr>
                        <x-organisms.ui.table.td 
                            checkbox="selectedItems" 
                            checkbox-value="{{ $ct->id }}"/>
                        <x-organisms.ui.table.td text="{{ $ct->type }}" desc="description"/>
                        <x-organisms.ui.table.td>
                            <div style="position: relative" x-data="{open : false}">
                                <span @click="open = ! open"><i class="icon dropdown"></i> <i class="fa-solid fa-peso-sign"></i> {{ number_format($ct->start_bal, 2) ?? 0}}</span>
                                <form wire:submit.prevent="updateBeginningBal({{ $ct->id }})" x-show="open" @click.outside="open = false" x-transition style="position:absolute; top:2em; left:0; background:white; border: 1px solid lightgray; padding:0.5em; width:100%; max-width:150px; border-radius:0.3em; z-index:2">
                                    <div class="ui input fluid" style="margin-bottom: 0.5em;">
                                        <input wire:model.defer="startBal" type="text" placeholder="{{ $ct->start_bal }}">
                                    </div>
                                    <div class="" style="gap:0.5em;">
                                        <button type="submit" class="ui button secondary fluid mini">Ok</button>
                                    </div>
                                </form>
                            </div>
                        </x-organisms.ui.table.td>
                        <x-organisms.ui.table.td text="{{ number_format($ct->in, 2) ?? 0 }}" text-icon="fa-peso-sign"/>
                        <x-organisms.ui.table.td text="{{ number_format($ct->out, 2) ?? 0 }}" text-icon="fa-peso-sign"/>
                        <x-organisms.ui.table.td text="{{ number_format($ct->end_bal, 2) ?? 0 }}" text-icon="fa-peso-sign"/>
                        <x-organisms.ui.table.td-more>
                            <x-atom.more.option 
                                wire-click="deletingCashType({{ $ct->id }})"
                                option-name="Delete" />
                        </x-organisms.ui.table.td>
                    </tr>
                @endforeach
            </x-slot>
        </x-organisms.ui.table>
    @endsection

</x-layout.page-content>

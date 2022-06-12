<x-layout.page-content>

    @section('section-page-title')
        <x-atoms.ui.header 
            title="Ledger"
            desc="Lorem Ipsum dolor."/>        
    @endsection

    @section('section-links')
        <x-organisms.ui.tabs>
            <x-organisms.ui.tabs.tab wire:click.prevent="$set('subPage', 3)" class="{{ $subPage == 3 ? 'tab-active' : '' }}">
                Credit
            </x-organisms.ui.tabs.tab>
            <x-organisms.ui.tabs.tab wire:click.prevent="$set('subPage', 2)" class="{{ $subPage == 2 ? 'tab-active' : '' }}">
                Expenses
            </x-organisms.ui.tabs.tab>
            <x-organisms.ui.tabs.tab wire:click.prevent="$set('subPage', 1)" class="{{ $subPage == 1 ? 'tab-active' : '' }}">
                Cash
            </x-organisms.ui.tabs.tab>
        </x-organisms.ui.tab>
    @endsection

    @section('section-heading-left')
        @switch($subPage)
            @case(1)
                @if (count($selectedItems) > 0)
                    <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedItems', [])">
                        <x-slot name="label">
                            {{ count($selectedItems) }} Selected 
                        </x-slot>
                        <x-slot name="menu">
                            <li wire:click.prevent="batchDeletingCashType" class="item">
                                <a href="">
                                    <i class="delete icon"></i> Delete
                                </a>
                            </li>
                        </x-slot>
                    </x-atoms.ui.header-dropdown-menu>
                @else
                <x-organisms.ui.dropdown class="dropdown-bottom">
                    <x-organisms.ui.dropdown.dropdown-label class="btn">
                        <i class="fa-solid fa-add mr-3"></i>
                        Add
                        <i class="fa-solid fa-caret-down ml-3"></i>
                    </x-organisms.ui.dropdown.dropdown-label>
                    <x-organisms.ui.dropdown.dropdown-content class="mt-2" style="height:30em; overflow-y:auto">
                            <li class="menu-title"><span>Cash types</span></li>
                            @foreach ($cashTypes as $ct)
                                <li wire:click.prevent="addCashType('{{ $ct }}')">
                                    <a>
                                        {{ $ct }}
                                    </a>
                                </li>
                            @endforeach
                            <div class="divider"></div>
                            <li class="menu-title"><span>Cash in bank</span></li>
                            @foreach ($cashInBank as $cb) 
                                <li wire:click.prevent="addCashType('Cash in Bank - {{ $cb }}')">
                                    <a>
                                        {{ $cb }}
                                    </a>
                                </li>
                            @endforeach
                            <div class="divider"></div>
                            <form wire:submit.prevent="addCashType">
                                <label class="label"><span class="label-text">Others</span></label>
                                <input class="input input-bordered input-sm w-full" wire:model.defer="otherCashType" type="text" name="search" placeholder="Please specify...">
                                <button type="submit" class="btn btn-sm w-full mt-3">Ok</button>
                            </form>
                    </x-organisms.ui.dropdown.dropdown-content>
                </x-organisms.ui.dropdown.dropdown-content>
                @endif        
                @break

            @case(2)
                <div>
                    <x-atoms.ui.header-add-btn label="Payment" wire-click="showModal('add')"/>
                </div>
                {{-- <div>
                    <div class="ui button basic tiny">All</div>
                    <div class="ui button basic tiny">Unpaid</div>
                    <div class="ui button basic tiny">Paid</div>
                </div> --}}
                @break

            @case(3)
                {{-- @if (count($selectedItems) > 0)
                    <x-atoms.ui.header-dropdown-menu wire-close="$set('selectedItems', [])" class="left pointing tiny">
                        <x-slot name="label">
                            {{ count($selectedItems) }} Selected 
                        </x-slot>
                        <x-slot name="menu"> 
                            <li wire:click.prevent="deletingPayments">
                                <a>
                                    <i class="fa-solid fa-bin"></i> 
                                    Remove 
                                </a>
                            </li>
                        </x-slot>
                    </x-atoms.ui.header-dropdown-menu>    
                @endif --}}
                @break
            @default
                
        @endswitch


        
    @endsection

    @section('section-heading-right')
        @switch ($subPage)
                @case(1)
                    @break

                @case(2)
                    <div class="btn-group">
                        <div wire:click.prevent="$set('displayPayment', '')" class="btn {{ $displayPayment == '' ? 'btn-active' : '' }}">All</div>
                        <div wire:click.prevent="$set('displayPayment', 'unpaid')" class="btn {{ $displayPayment == 'unpaid' ? 'btn-active' : '' }}">Unpaid</div>
                        <div wire:click.prevent="$set('displayPayment', 'paid')" class="btn {{ $displayPayment == 'paid' ? 'btn-active' : '' }}">Paid</div>
                    </div>
                    @break        

                @case(3)
                    {{-- <div class="btn-group">
                        <div class="btn btn-active">All</div>
                        <div class="btn">Unpaid</div>
                        <div class="btn">Paid</div>
                    </div> --}}
                    @break

                @default
        @endswitch
    @endsection

    @section('section-main')

            @switch ($subPage)
                @case(1)
        
                    <x-organisms.ui.table class="selectable unstackable">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th-checkbox/>
                            <x-organisms.ui.table.th label="Cash Type"/>
                            {{-- <x-organisms.ui.table.th label="Beginning Balance" style="width:14em;"/>
                            <x-organisms.ui.table.th label="In" style="width:14em;"/>
                            <x-organisms.ui.table.th label="Out" style="width:14em;"/>
                            <x-organisms.ui.table.th label="Ending Balance" style="width:14em;"/> --}}
                            <x-organisms.ui.table.th-more/>
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach ($cashtypes as $ct)
                                <tr>
                                    <x-organisms.ui.table.td 
                                        checkbox="selectedItems" 
                                        checkbox-value="{{ $ct->id }}"/>
                                    <x-organisms.ui.table.td text="{{ $ct->type }}" desc="description"/>
                                    {{-- <x-organisms.ui.table.td>
                                        <div class="dropdown dropdown-left">
                                            <label tabindex="0" class="font-bold cursor-pointer">
                                                <i class="fa-solid fa-caret-down mr-1"></i> 
                                                {{ number_format($ct->start_bal, 2) ?? 0}}
                                            </label>
                                            <ul tabindex="0" class="dropdown-content menu p-4 mr-2 shadow-xl bg-base-100 rounded-box w-52">
                                                <form wire:submit.prevent="updateBeginningBal({{ $ct->id }})">
                                                    <x-atoms.ui.input wire-model="startBal" type="number" min="0" placeholder="{{ $ct->start_bal }}" class="input-sm w-full mb-1"/>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary btn-sm w-full mt-5">OK</button>
                                                    </div>
                                                </form>
                                            </ul>
                                        </div>

                                    </x-organisms.ui.table.td>
                                    <x-organisms.ui.table.td text="{{ number_format($ct->in, 2) ?? 0 }}" text-icon="fa-peso-sign"/>
                                    <x-organisms.ui.table.td text="{{ number_format($ct->out, 2) ?? 0 }}" text-icon="fa-peso-sign"/>
                                    <x-organisms.ui.table.td text="{{ number_format($ct->end_bal, 2) ?? 0 }}" text-icon="fa-peso-sign"/> --}}
                                    <x-organisms.ui.table.td-more>
                                        <x-atom.more.option 
                                            wire-click="deletingCashType({{ $ct->id }})"
                                            option-name="Delete" />
                                    </x-organisms.ui.table.td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-organisms.ui.table>
                    @break

                @case(2)

                    @if ($viewPayments) 
                        <div class="flex items-center gap-4 mb-10">
                            <div>
                                <x-atoms.ui.button wire:click.prevent="$set('viewPayments', false)" class="btn-circle btn-primary"><i class="fa-solid fa-angle-left"></i></x-atoms.ui.button>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold">
                                    {{ $payment['desc'] }}
                                </h2>
                                <P class="opcity-50">Payment records</P>
                            </div>
                        </div>
{{-- 
                        <div>
                            <x-atoms.ui.button wire:click.prevent="$set('viewPayments', false)" class="btn-sm btn-ghost btn-circle"><i class="fa-solid fa-arrow-right"></i></x-atoms.ui.button>
                            <h2></h2>
                        </div> --}}
                        <x-organisms.ui.table class="">
                            <x-slot name="thead">
                                {{-- <x-organisms.ui.table.th-checkbox/> --}}
                                <x-organisms.ui.table.th label="Payment Date"/>
                                <x-organisms.ui.table.th label="Amount"/>
                                <x-organisms.ui.table.th label="Payment Type"/>
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($viewpayments as $view)
                                    <tr>
                                        <x-organisms.ui.table.td text="{{ humanReadableDate($view->created_at) }}"/>
                                        <x-organisms.ui.table.td text="{{ number_format($view->pay_amount, 2) }}" text-icon="fa-peso-sign"/>
                                        <x-organisms.ui.table.td text="{{ $view->payment_type }}"/>
                                        <x-organisms.ui.table.td-more>
                                            <x-atom.more.option 
                                                wire-click="showModal('update', {{ $view->id }})"
                                                option-name="Edit"/>
                                            <x-atom.more.option 
                                                wire-click="deletingPayment({{ $view->id }})"
                                                option-name="Delete"/>
                                        </x-organisms.ui.table.td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                    @else

                        <x-organisms.ui.table class="">
                            <x-slot name="thead">
                                {{-- <x-organisms.ui.table.th-checkbox/> --}}
                                <x-organisms.ui.table.th label="Due" style="width: 12em"/>
                                <x-organisms.ui.table.th label="" style="width: 1em"/>
                                <x-organisms.ui.table.th label="Description"/>
                                <x-organisms.ui.table.th label="Payment" style="width:12em;"/>
                                <x-organisms.ui.table.th label="Balance" style="width:12em;"/>
                                <x-organisms.ui.table.th label="" style="width:15em"/>
                                <x-organisms.ui.table.th label="" style="width:15em"/>
                                <x-organisms.ui.table.th-more/>
                            </x-slot>
                            <x-slot name="tbody">
                                @foreach ($payments as $payment)
                                    <tr>
                                        <x-organisms.ui.table.td text="{{ humanReadableDate($payment->due) }}"/>
                                        <x-organisms.ui.table.td text-icon="icon bell"/>
                                        <x-organisms.ui.table.td text="{{ $payment->description }}"/>
                                        <x-organisms.ui.table.td text-icon="fa-peso-sign" text="{{ number_format($payment->payable, 2) }}"/>
                                        <x-organisms.ui.table.td 
                                            text="{{ $payment->payable == $payment->records->sum('pay_amount') ? 'Paid' : number_format(($payment->payable - $payment->records->sum('pay_amount')), 2) }}" 
                                            {{-- text="{{ $payment->records->sum('pay_amount') }}"  --}}
                                            text-icon="{{ $payment->balance == $payment->payable ? '' : 'fa-peso-sign' }}"
                                            desc="transactions: {{ $payment->records->count('id')}}"/>
                                        <x-organisms.ui.table.td>
                                            <x-atoms.ui.button wire:click.prevent="showModal('pay', {{ $payment->id }})" class="btn-sm btn-primary">Pay</x-atoms.ui.button>
                                        </x-organisms.ui.table.td>
                                        <x-organisms.ui.table.td>
                                            <x-atoms.ui.button wire:click.prevent="viewPaymentRecords({{ $payment->id }}, '{{ $payment->description }}')" class="btn-sm btn-ghost btn-circle"><i class="fa-solid fa-arrow-right"></i></x-atoms.ui.button>
                                        </x-organisms.ui.table.td>
                                        <x-organisms.ui.table.td-more>
                                            <x-atom.more.option 
                                                wire-click="showModal('update', {{ $payment->id }})"
                                                option-name="Edit"/>
                                            <x-atom.more.option 
                                                wire-click="deletingPayment({{ $payment->id }})"
                                                option-name="Delete"/>
                                        </x-organisms.ui.table.td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-organisms.ui.table>
                    @endif




                    @break

                @case(3)
                    <x-organisms.ui.table class="selectable">
                        <x-slot name="thead">
                            {{-- <x-organisms.ui.table.th-checkbox/> --}}
                            <x-organisms.ui.table.th label="Date" style="width:10em;"/>
                            <x-organisms.ui.table.th label="Total"/>
                            <x-organisms.ui.table.th label="Balance"/>
                            <x-organisms.ui.table.th label="Due Date"/>
                            <x-organisms.ui.table.th label="Purchased By"/>
                            <x-organisms.ui.table.th label="Payment Type"/>
                            {{-- <x-organisms.ui.table.th-more/> --}}
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($purchases as $purchase)
                                <tr>
                                    {{-- <x-organisms.ui.table.td
                                        checkbox="selectedItems" 
                                        checkbox-value="{{ $purchase->id }}"/> --}}
                                    <x-organisms.ui.table.td 
                                        desc="{{ humanReadableDate($purchase->created_at) }}"/>
                                    <x-organisms.ui.table.td
                                        text="{{ number_format($purchase->total) }}"
                                        text-icon="fa-peso-sign"/>
                                    <x-organisms.ui.table.td
                                        class="{{ $purchase->balance > 0 ? 'error' : ''; }}"
                                        text="{{ empty($purchase->balance) || ($purchase->balance == 0) ? 'Paid' : number_format($purchase->balance); }}"
                                        text-icon="{{ empty($purchase->balance) || ($purchase->balance == 0) ? '' : 'fa-peso-sign';}}"
                                        desc="{{ !empty($purchase->deposit) || ($purchase->deposit > 0) ?  number_format($purchase->deposit) . ' Depo' : ''; }}"
                                        desc-icon="{{ !empty($purchase->deposit) || ($purchase->deposit > 0) ? 'fa-peso-sign' : '' }}"/>
                                    <x-organisms.ui.table.td
                                        text="{{ empty($purchase->duedate) || ($purchase->duedate == null) ? '--' : humanReadableDate($purchase->duedate); }}"/>
                                    <x-organisms.ui.table.td 
                                        text="{{ $purchase->patient->patient_lname . ', ' . $purchase->patient->patient_fname . ' ' . $purchase->patient->patient_mname }}"
                                        avatar="{{ avatar($purchase->patient->patient_avatar) }}"/>
                                    <x-organisms.ui.table.td
                                        text="{{ $purchase->payment_type }}"/>
                                </tr>
                            @empty
                                <x-organisms.ui.table.search-no-results colspan="7"/>
                            @endforelse
                        </x-slot>
                    </x-organisms.ui.table>
                    @break

            @endswitch
           
    @endsection

</x-layout.page-content>

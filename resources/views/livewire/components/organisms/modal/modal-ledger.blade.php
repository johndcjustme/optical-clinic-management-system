
<x-organisms.modal>
    @section('modal_title')
        <div>
            
        </div>
        <div>
            <h5 class="ui header">
                @if ($modal['add'])
                    ADD PAYMENT
                @elseif ($modal['update'])
                    UPDATE PAYMENT
                @endif
            </h5>
        </div>
        <div>
            <x-atoms.ui.button wire:click.prevent="closeModal" class="tiny">Close</x-atoms.ui.button>
            @if ($modal['add'])
                <label class="ui button secondary tiny" for="submitPayment">Save</label>
            @elseif ($modal['pay'])
                <label class="ui button secondary tiny" for="partial-paid">Save</label>
            @endif
        </div>
    @endsection

    @section('modal_body')
        <br><br><br>
        @if ($modal['add'] || $modal['update'])
            <form wire:submit.prevent="addPayment({{ $payment['id'] }})" class="ui form">
                <div class="field">
                    <x-atoms.ui.label>Description<x-atoms.ui.required/> @error('payment.desc') <span class="ui text red">{{ $message }}</span> @enderror</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="payment.desc" type="text" class="mb_7" placeholder="Enter description..."/>
                </div>
                <div class="field">
                    <x-atoms.ui.label>Payable<x-atoms.ui.required/> @error('payment.amount') <span class="ui text red">{{ $message }}</span> @enderror </x-atoms.ui.label>
                    <div class="ui right labeled input fluid">
                        <label for="amount" class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                        <input wire:model.defer="payment.amount" type="number" placeholder="Enter amount..." id="amount">
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <x-atoms.ui.label>Due</x-atoms.ui.label>
                        <x-atoms.ui.input wire-model="payment.due" type="date" class="mb_7" placeholder="Enter description..."/>
                    </div>
                    <div class="field"></div>
                </div>
                <div class="field">
                    <input type="submit" id="submitPayment" value="submit" style="opacity: 0" hidden>
                </div>
            </form>
        @elseif ($modal['pay'])

        <div style="text-align: center">
            <h3 class="ui header">
                {{ $payment['desc'] }}
                <div class="sub header">
                    To be paid: <i class="fa-solid fa-peso-sign"></i><b>{{ number_format($payment['amount'], 2) }}</b> | Balance: <i class="fa-solid fa-peso-sign"></i><b>{{ number_format($payment['amount'], 2) }}</b>
                </div>
            </h3>
        </div>

        <br><br>

        <form wire:submit.prevent="pay" class="ui form">
            <div class="field">
                <x-atoms.ui.label>Mode</x-atoms.ui.label>
                <x-atoms.ui.select wire:model="payment.partial" class="mb_7">
                    <option class="item" value="" hidden selected>Select</option>
                    <option class="item" value="paid">Paid</option>
                    <option class="item" value="partial">Partial</option>
                </x-atoms.ui.select>
            </div>
            <div class="field">
                @if ($payment['partial'] == 'partial')
                    <x-atoms.ui.label>Amount</x-atoms.ui.label>
                    <div class="ui right labeled input fluid">
                        <label for="amount" class="ui label"><i class="fa-solid fa-peso-sign"></i></label>
                        <input wire:model.defer="payment.balance" type="number" class="mb_7" placeholder="Enter amount..." id="amount">
                    </div>
                @endif
            </div>
            <div class="field">
                <x-atoms.ui.label>Pay by<x-atoms.ui.required/></x-atoms.ui.label>
                <x-atoms.ui.select wire:model.defer="payment.type" class="mb_7">
                    <option class="item" value="" hidden selected>Select</option>
                    <option class="item" value="none">None</option>
                    @foreach ($cashtypes as $cash)
                        <option class="item" value="{{ $cash->type }}">{{ $cash->type }}</option>
                    @endforeach
                </x-atoms.ui.select>
            </div>
            <input type="submit" id="partial-paid" value="" style="opacity: 0" hidden>
        </form>
    

            
          

      

        @endif
    @endsection
</x-organisms.modal>
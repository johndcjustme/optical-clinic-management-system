
<x-organisms.modal>
    @section('modal_title')
        <div></div>
        <div>
            <x-atoms.ui.modal-title>
                @if ($modal['add'])
                    ADD PAYMENT
                @elseif ($modal['update'])
                    UPDATE PAYMENT
                @endif
            </x-atoms.ui.modal-title>
        </div>
        <div>
            <x-atoms.ui.btn-close-modal/>
            @if ($modal['add'] || $modal['update'])
                <label class="btn ml-3" for="submitPayment">Save</label>
            @elseif ($modal['pay'])
                <label class="btn ml-3" for="partial-paid">Save</label>
            @endif
        </div>
    @endsection

    @section('modal_body')
        @if ($modal['add'] || $modal['update'])
            <form wire:submit.prevent="addPayment({{ $payment['id'] }})" class="mt-10">
                    <x-atoms.ui.label>Description<x-atoms.ui.required/> @error('payment.desc') <span class="text-red-500">{{ $message }}</span> @enderror</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="payment.desc" type="text" class="mb-3" placeholder="Enter description..."/>

                    <x-atoms.ui.label>Payment<x-atoms.ui.required/> @error('payment.amount') <span class="text-red-500">{{ $message }}</span> @enderror </x-atoms.ui.label>
                    <div class="input-group">
                        <span><i class="fa-solid fa-peso-sign"></i></span>
                        <input wire:model.defer="payment.amount" type="number" min="0" placeholder="Enter payment..." class="input input-bordered w-full">
                    </div>
                
                    <x-atoms.ui.label>Due</x-atoms.ui.label>
                    <x-atoms.ui.input wire-model="payment.due" type="date" class="mb_7" placeholder="Enter description..."/>

                    <input type="submit" id="submitPayment" value="submit" style="opacity:0; height:0; width:0;" hidden>
            </form>
        @elseif ($modal['pay'])

        <div class="mt-10 mb-10">
            <h1 class="text-center font-bold text-2xl">{{ $payment['desc'] }}</h1>
            <p class="text-center">
                To be paid: <i class="fa-solid fa-peso-sign"></i><b>{{ number_format($payment['amount'], 2) }}</b> | Balance: <i class="fa-solid fa-peso-sign"></i><b>{{ number_format($payment['amount'], 2) }}</b>
            </p>
        </div>

        <form wire:submit.prevent="pay" class="ui form">
            <x-atoms.ui.label>Mode of payment</x-atoms.ui.label>
            <x-atoms.ui.select wire:model="payment.partial" class="mb-3">
                <option class="item" value="" hidden selected>Select</option>
                <option class="item" value="paid">Paid</option>
                <option class="item" value="partial">Partial</option>
            </x-atoms.ui.select>
            @if ($payment['partial'] == 'partial')
                <x-atoms.ui.label>Amount</x-atoms.ui.label>
                <div class="input-group mb-3">
                    <span><i class="fa-solid fa-peso-sign"></i></span>
                    <input wire:model.defer="payment.pay_amount" type="number" min="0" class="input input-bordered w-full" placeholder="Enter amount...">
                </div>
            @endif
            <x-atoms.ui.label>Pay by<x-atoms.ui.required/></x-atoms.ui.label>
            <x-atoms.ui.select wire:model.defer="payment.type" class="mb_7">
                <option value="" hidden selected>Select</option>
                <option value="none">None</option>
                @foreach ($cashtypes as $cash)
                    <option class="item" value="{{ $cash->type }}">{{ $cash->type }}</option>
                @endforeach
            </x-atoms.ui.select>
            <input type="submit" id="partial-paid" value="" style="opacity:0; height:0; width:0;" hidden>
        </form>
        @endif
    @endsection
</x-organisms.modal>
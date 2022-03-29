<div class="ui form">
    <div class="field">
        @if ($item['has_image'])
            <p class="ui text grey" style="opacity: 0.7">This item has already a photo. <strong>Choose file</strong> if you want to replace.</p>
        @endif
        <x-atoms.ui.label>Select a photo</x-atoms.ui.label>
        <input class="ui input basic" id="item_image" type="file" wire:model.defer="item.image" style="opacity: 1">
        @error('item.image') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <x-atoms.ui.label>Category @error('item.type') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
        <x-atoms.ui.select wire:model.defer="item.type" class="mb_7">
            <option value="" selected hidden>Select</option>
            <option class="item" value="le">Lense</option>
            <option class="item" value="fr">Frame</option>
            <option class="item" value="ac">Accessory</option>
        </x-atoms.ui.select>
    </div>
    <div class="mb_12 flex flex_center">
        <span class="ui text blue">•••</span>
    </div>
    <div class="two fields">
        <div class="field">
            {{-- <x-atoms.ui.label>Category @error('item.type') <span class="ui text error">{{ $message }}</span> @enderror</x-atoms.ui.label>
            <x-atoms.ui.select wire:model.defer="item.type" class="mb_7">
                <option value="" selected hidden>Select</option>
                <option class="item" value="le">Lense</option>
                <option class="item" value="fr">Frame</option>
                <option class="item" value="ac">Accessory</option>
            </x-atoms.ui.select> --}}
            <x-atoms.ui.label>Item Name @error('item.name') <span class="error">{{ $message }}</span> @enderror</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="item.name" type="text" class="mb_7"/>
            <x-atoms.ui.label>Item Description</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="item.desc" type="text" class="mb_7"/>
            <x-atoms.ui.label>Item Size</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="item.size" type="text" class="mb_7"/>
            <x-atoms.ui.label>Low Stock Level</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="item.buffer" type="text" class="mb_7"/>
        </div>
        <div class="field">
            <x-atoms.ui.label>Supplier</x-atoms.ui.label>
            <x-atoms.ui.select wire:model.defer="item.supplier" class="fluid mb_7" tabindex="0">
                <option value="" selected hidden>Select</option>
                @foreach ($suppliers as $supplier)
                    <option class="item" value="{{ $supplier->id }}">
                        {{ $supplier->supplier_name }}
                    </option>
                @endforeach
            </x-atoms.ui.select>
            <x-atoms.ui.label>Item Quantity</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="item.qty" type="number" class="mb_7"/>
            <x-atoms.ui.label>Item Price</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="item.price" type="number" class="mb_7"/>
            <x-atoms.ui.label>Item Cost</x-atoms.ui.label>
            <x-atoms.ui.input wire-model="item.cost" type="number" class="mb_7"/>
        </div>
    </div>
  
</div>
<div class="full_w mt_20">
    <div class="card w_lg overflow_x" style="margin: auto">
        <div class="flex gap_1">
            <a href="#" wire:click="inventoryChangeTable(1)" class="underlined_item_links py_3 px_5 
                @if($this->myTable() == 1) active @endif nodecoration" href="">
                Lenses
            </a>
            <a href="#" wire:click="inventoryChangeTable(2)" class="underlined_item_links py_3 px_5 
                @if($this->myTable() == 2) active @endif nodecoration" href="">
                Frames
            </a>
            <a href="#" wire:click="inventoryChangeTable(3)" class="underlined_item_links py_3 px_5 
                @if($this->myTable() == 3) active @endif nodecoration" href="">
                Accessories
            </a>
            <a href="#" wire:click="inventoryChangeTable(4)" class="underlined_item_links py_3 px_5 
                @if($this->myTable() == 4) active @endif nodecoration" href="">
                Supplier
            </a>
        </div><br><br>
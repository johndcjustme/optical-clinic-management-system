<div>
    {{-- Be like water. --}}

    <button wire:click="increment">+</button>
    <h1>{{$count}}</h1>
    <button wire:click="decrement">-</button>


    <input type="text" wire:model="search">
    {{ $search }}


</div>

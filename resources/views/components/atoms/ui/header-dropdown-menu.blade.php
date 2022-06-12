
    <div {{ $attributes->merge(['class' => 'dropdown'])}}>
        <label tabindex="0" class="btn">
            <i class="fa-solid fa-caret-down mr-2"></i> 
            <span>
                {{ $label ?? null }}
            </span>
        </label>
        <ul tabindex="0" class="dropdown-content menu mt-1 p-2 shadow-xl bg-base-100 rounded-box w-52">
            {{ $menu }}
        </ul>
    </div>

    @if (!empty($wireClose))
        {{-- <div> --}}
            <x-atoms.ui.button wire:click.prevent="{{ $wireClose }}" class="btn-circle btn-ghost btn-sm ml-3">
                <i class="fa-solid fa-close text-red-600"></i>
            </x-atoms.ui.button>
        {{-- </div> --}}
    @endif

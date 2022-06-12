<div class="dropdown dropdown-end" x-data="{ openEntries: false, filter: false }">
    <label tabindex="0" class="btn btn-circle btn-outline btn-ghost hover:bg-gray-300 hover:border-gray-300 color-base-content border-gray-300">
        <i {{ $attributes->merge(['class' => 'fa-solid fa-caret-down']) }}></i>
    </label>
    <ul tabindex="0" class="dropdown-content menu p-2 shadow-lg bg-base-100 rounded-box mt-3" style="width: 15em">
        {{ $slot }}
    </ul>
</div>    
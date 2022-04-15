
    <div {{ $attributes->merge(['class' => 'ui icon top dropdown button basic'])}} x-init="$('.ui.icon.top.dropdown').dropdown()" style="z-index: 100">
        {{ $label ?? null }}
        <i class="dropdown icon"></i>
        <div class="menu inverted tiny">
            {{ $menu }}
        </div>
    </div>

    @if (!empty($wireClose))
        <div>
            <x-atoms.ui.button wire:click.prevent="{{ $wireClose }}" class="tiny icon tertiary red">
                <i class="delete icon"></i>
            </x-atoms.ui.button>
        </div>
    @endif

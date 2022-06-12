{{-- <div class="mb_5">
        <a href="{{ $link }}">
                <h1 class="ui huge header" style="margin:0; margin-right:0.2em; padding:0;">
                        {{ $title }}
                        {{ $slot }}
                </h1>
        </a>
</div>
 --}}


<h2 class="text-3xl font-bold" onclick="location.window.assign('{{ $link }}')">
        <div class="x-flex x-flex-ycenter">
                @if (!empty($icon))
                        <ion-icon name="{{ $icon }}" style="margin-right: 0.3em"></ion-icon>
                @endif
                <span>
                        {{ $title }}
                </span>
        </div>
</h2>
{{-- <p class="font-bold opacity-50">{{ $desc ?? null }}</p> --}}
<div>
        {{ $slot }}
</div>

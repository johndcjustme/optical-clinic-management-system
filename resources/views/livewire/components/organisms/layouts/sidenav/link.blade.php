<li class="active:bg-base-300">
    <a class="flex justify-center md:justify-start {{ Request::path() == $nav['link'] ? 'text-primary' : '' }}" href="{{ $nav['link'] }}">
        {{-- <div> --}}
            <i class="fa-solid {{ $nav['icon'] }}"></i>
            <span class="md:block hidden">
                {{ $nav['title'] }}
            </span>
        {{-- </div> --}}
    </a>
</li>
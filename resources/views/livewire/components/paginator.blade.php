



<div class="flex justify-end mt-4">   
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex">
            {{-- <span> --}}
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="btn btn-circle btn-ghost btn-disabled opacity-0">
                        <i   class="fa-solid fa-caret-left"></i>
                    </span>
                @else
                    <button wire:click.prevent="previousPage" class="btn btn-circle btn-ghost">
                        <i class="fa-solid fa-caret-left"></i>
                    </button>
                @endif
            {{-- </span>--}}

            {{-- <button class="btn">  --}}
                @foreach ($elements as $element)
                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)

                            <!--  Show active page two pages before and after it.  -->
                            @if ($page == $paginator->currentPage())
                                <div class="current_num btn btn-circle btn-ghost">{{ $page }}</div>
                            @endif

                        @endforeach
                        {{-- of {{$page}} --}}
                    @endif
                @endforeach
            {{-- </button> --}}
 
           {{--    <span> --}}
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click.prevent="nextPage" class="btn btn-circle btn-ghost">
                        <i class="fa-solid fa-caret-right"></i>
                    </button>
                @else
                    <span class="btn btn-circle btn-ghost btn-disabled opacity-0">
                        <i class="fa-solid fa-caret-right"></i>
                    </span>
                @endif
            {{-- </span> --}}
        </nav>
    @endif
</div>

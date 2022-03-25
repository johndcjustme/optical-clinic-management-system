



<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="ui small basic buttons">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="ui button disabled">
                        <i   class="fa-solid fa-caret-left"></i>
                    </span>
                @else
                    <button wire:click.prevent="previousPage" wire:loading.attr="disabled" class="ui button">
                        <i class="fa-solid fa-caret-left"></i>
                    </button>
                @endif
            </span>

            <span>
                @foreach ($elements as $element)
                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)

                            <!--  Show active page two pages before and after it.  -->
                            @if ($page == $paginator->currentPage())
                                   <div class="current_num ui button">{{ $page }}</div>
                            @endif

                        @endforeach
                        {{-- of {{$page}} --}}
                    @endif
                @endforeach
            </span>
 
            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click.prevent="nextPage" wire:loading.attr="disabled"  class="ui button">
                        <i class="fa-solid fa-caret-right"></i>
                    </button>
                @else
                    <span class="ui button disabled">
                        <i class="fa-solid fa-caret-right"></i>
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>
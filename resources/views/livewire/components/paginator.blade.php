<div class="paginator_container">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="ui small basic buttons">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <div class="ui button disabled">
                            <i   class="fa-solid fa-caret-left"></i>
                        </div>
                    @else
                        <div wire:click.prevent="previousPage" class="ui button">
                            <i class="fa-solid fa-caret-left"></i>
                        </div>
                    @endif
    
                            <!-- Pagination Elements -->

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

                {{-- </div> --}}


                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <div wire:click.prevent="nextPage" class="ui button">
                            <i class="fa-solid fa-caret-right"></i>
                        </div>
                    @else
                        <div class="ui button disabled">
                            <i class="fa-solid fa-caret-right"></i>
                        </div>
                    @endif
        </nav>
    @endif
</div>

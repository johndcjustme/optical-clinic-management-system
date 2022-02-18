<div class="paginator_container">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex flex_x_between">
                <div>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <div class="btn disabled">
                            <i   class="fa-solid fa-caret-left"></i>
                        </div>
                    @else
                        <div wire:click.prevent="previousPage" class="btn">
                            <i class="fa-solid fa-caret-left"></i>
                        </div>
                    @endif
                </div>
    
                <div>
                            <!-- Pagination Elements -->

                    @foreach ($elements as $element)
                        <!-- Array Of Links -->
                        @if (is_array($element))
                            @foreach ($element as $page => $url)

                                <!--  Show active page two pages before and after it.  -->
                                @if ($page == $paginator->currentPage())
                                       <div class="current_num">{{ $page }}</div>
                                @endif

                            @endforeach
                            {{-- of {{$page}} --}}
                        @endif
                    @endforeach

                </div>


                <div>
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <div wire:click.prevent="nextPage" class="btn">
                            <i class="fa-solid fa-caret-right"></i>
                        </div>
                    @else
                        <div class="btn disabled">
                            <i class="fa-solid fa-caret-right"></i>
                        </div>
                    @endif
                </div>
        </nav>
    @endif
</div>
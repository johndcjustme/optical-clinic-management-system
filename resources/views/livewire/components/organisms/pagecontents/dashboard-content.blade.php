<x-layout.page-content>

    @section('section-page-title', 'Dashboard')

    @section('section-links')
        Have a great day, John
    @endsection

    @section('section-heading')
        {{-- heading --}}
    @endsection

    @section('section-main')
    
    <div class="overflow_hidden dashboard_section">

            <div class="das_analytics">
                @includeIf('livewire.components.organisms.pagecontents.dashboard.analytics')
            </div>

            <div class="das_patients">
                @includeIf('livewire.components.organisms.pagecontents.dashboard.patient')

            </div>

            <div class="das_top_products full_w overflow_hidden">
                <br>
                <h5>Top Selling Poducts</h5>
                <div class="overflow_x py_5">
                    <div class="flex gap_1 full_w">
                        @for ($i=1; $i<10; $i++)
                            @includeIf('livewire.components.organisms.pagecontents.dashboard.top-product')
                        @endfor
                    </div>
                </div>
                
            </div>

            <div class="div4">
                @includeIf('livewire.components.organisms.pagecontents.dashboard.top-product')

            </div>
            <div class="div5">5</div>
            <div class="div6">6</div>
            <div class="div7">7</div>

        </div>
    @endsection

</x-layout.page-content>
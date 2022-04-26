<x-layout.page-content>

    @section('section-page-title')
        <div class="">
            <div>
                <x-atoms.ui.header title="Dashboard" />
            </div>
            <div>
                <p style="font-size: 1.3rem;">Hi <b>{{ session()->get('curr_user_name') }}</b>, have a nice day.</p>
            </div>
        </div>
    @endsection

    @section('section-links')
    @endsection

    @section('section-heading')
    @endsection

    @section('section-main')

        

        <div style="display:flex; flex-direction:column;">
            {{-- <h3 class="ui dividing header">Patients</h3> --}}

              


                <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui secondary menu">
                            <a wire:click.prevent="$set('stat', 'patients')" class="item animate_left {{ $stat == 'patients' ? 'active' : '' }}">
                            Patients
                            </a>
                            <a wire:click.prevent="$set('stat', 'orders')" class="item animate_left {{ $stat == 'orders' ? 'active' : '' }}">
                            Orders
                            </a>
                            <a wire:click.prevent="$set('stat', 'appointments')" class="item animate_left {{ $stat == 'appointments' ? 'active' : '' }}">
                            Appointments
                            </a>
                        </div>

                        @switch($stat)
                            @case('patients')
                                <div class="ui horizontal equal width segments">
                                    <div class="ui centered aligned segment inverted black">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui inverted statistic">
                                                <div class="label">
                                                    Patients Total
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('all') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Today
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('today') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Yesterday
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('yesterday') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    This Week
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('thisWeek') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break
                        
                            @case('orders')
                                <div class="ui horizontal equal width segments">
                                    <div class="ui centered aligned segment inverted black">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui inverted statistic">
                                                <div class="label">
                                                    Orders Total
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('all') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    To order
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('today') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    pending
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('yesterday') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Recieved
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('thisWeek') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break
                            @case('appointments')
                                <div class="ui horizontal equal width segments">
                                    <div class="ui centered aligned inverted black segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui inverted statistic">
                                                <div class="label">
                                                    New Appoinments
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('all') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    For Approval
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('today') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Today
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('yesterday') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui centered aligned segment">
                                        <div class="x-flex x-flex-center">
                                            <div class="ui small statistic">
                                                <div class="label">
                                                    Tomorrow
                                                </div>
                                                <div class="value">
                                                    {{ $this->totalOfPatients('thisWeek') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break
                            @default
                        @endswitch
                    </div>
                </div>
                

                  
            {{-- <div class="ui grid">
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text blue">• Patient's Total</span>
                            </div>
                            <div class="ui horizontal statistic blue">
                                <div class="value">
                                    {{ $this->totalOfPatients('all') }}
                                </div>
                                <div class="label">Patients</div>
                            </div>
                        </div>
                        <div class="ui bottom attached button blue">
                            <i class="add icon"></i>
                            Add Friend
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text green">
                                    • Today
                                </span>
                            </div>
                            <div class="ui horizontal statistic">
                                <div class="value">
                                    {{ $this->totalOfPatients('today') }}
                                </div>
                                <div class="label">
                                    Patients
                                </div>
                            </div>
                        </div>  
                        <div class="ui bottom attached button green">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text teal">
                                    • Yesterday
                                </span>
                            </div>
                            <div class="ui horizontal statistic">
                                <div class="value">
                                    {{ $this->totalOfPatients('yesterday') }}
                                </div>
                                <div class="label">
                                    Patients
                                </div>
                            </div>
                        </div>
                        <div class="ui bottom attached button teal">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet column">
                    <div class="ui fluid raised link card">
                        <div class="content">
                            <div class="header">
                                <span class="ui text orange">• This Week</span>
                            </div>
                            <div class="ui horizontal statistic">
                                <div class="value">
                                    {{ $this->totalOfPatients('thisWeek') }}
                                </div>
                                <div class="label">
                                    Patients
                                </div>
                            </div>
                        </div>
                        <div class="ui bottom attached button orange">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
            </div> --}}





            <div class="ui grid">
                <div class="ten wide computer ten wide tablet sixteen wide mobile column" style="width:60%;">
                    <div class="ui segment" style="height:330px;">
                        <div class="content">
                            <div class="x-flex x-flex-xbetween">
                                <div>
                                    <h4>
                                        Patients By Year
                                    </h4>
                                    <div>
                                        <span class="ui text big">
                                            {{ $this->yearlyPatients($year) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <div class="ui selection compact dropdown" x-init="$('.ui.selection').dropdown()">
                                        <i class="dropdown icon"></i>
                                        <div class="text">{{ $year }}</div>
                                        <div class="menu">
                                            <div wire:click.prevent="$set('year', 2021)" class="item">2021</span></div>
                                            <div wire:click.prevent="$set('year', 2022)" class="item">2022</span></div>
                                            <div wire:click.prevent="$set('year', 2023)" class="item">2023</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="height:230px">
                                <livewire:livewire-area-chart
                                    key="{{ $areaChartModel->reactiveKey() }}"
                                    :area-chart-model="$areaChartModel"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="six wide computer six wide tablet sixteen wide mobile column" style="width:40%">
                    <div class="ui segment" style="height:330px;">
                        <div class="content">
                            <h3>Inventory</h3>
                            <div style="height:250px">
                                <livewire:livewire-column-chart :column-chart-model="$columnChartModel"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
            <br>
            {{-- <h3 class="ui dividing header">Top Selling Products</h3>\ --}}
           
            <div class="ui grid">
                <div class="sexteen wide column">

                        <div class="ui secondary  menu">
                            <a class="item active">
                            Top Products
                            </a>
                            <a class="item">
                            Low In demand
                            </a>
                        </div>

                    <x-organisms.ui.table class="unstackable compact">
                        <x-slot name="thead">
                            <x-organisms.ui.table.th label="Name" order-by="item_name" />
                            <x-organisms.ui.table.th label="Category" order-by="item_type" />
                            <x-organisms.ui.table.th label="Price" order-by="item_type" />
                            <x-organisms.ui.table.th label="Sold" order-by="item_type" />
                        </x-slot>
                        <x-slot name="tbody">
                            @foreach ($items as $item)
                                <tr>
                                    <x-organisms.ui.table.td
                                        text="{{ $item->item_name }}"
                                        desc="{{ $item->item_desc }}"
                                    />
                                    <x-organisms.ui.table.td
                                        text="{{ $item->category->name ?? '' }}"
                                    />
                                    <x-organisms.ui.table.td
                                        text="{{ number_format($item->item_price) ?? '' }}"
                                        text-icon="fa-peso-sign"
                                    />
                                    <x-organisms.ui.table.td
                                        text="100pcs"
                                        desc="over this year"
                                    />
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-organisms.ui.table>
                    {{ $items->links('livewire.components.paginator') }}

                </div>
            </div>
        </div>
    @endsection

</x-layout.page-content>






@push('js')
    <script>
        var options = {
            chart: {
                type: 'line',
                height: '250px',
                animations: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                labels: {
                    show: false
                },

            },
            series: [{
                name: 'Patients',
                data: [@php echo $monthValues @endphp]
            }],
            xaxis: {
                categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEPT', 'OCT', 'NOV', 'DEC', ],
                tooltip: {
                    enabled: false
                }
            }
        }

        var chartYearlyPatients = new ApexCharts(document.querySelector("#chartYearlyPatients"), options);

        chartYearlyPatients.render();



        var options = {
            chart: {
                type: 'line',
                height: '250px',
                animations: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                labels: {
                    show: false
                },
            },

            series: [{
                name: 'Patients',
                data: [10, 20, 30, 20]
            }],
            xaxis: {
                categories: ['WEEK 1', 'WEEK 2', 'WEEK 3', 'WEEK 4'],
                tooltip: {
                    enabled: false
                }
            }
        }

        var chartMonthlyPatients = new ApexCharts(document.querySelector("#chartMonthlyPatients"), options);

        chartMonthlyPatients.render();





        var options = {
            chart: {
                type: 'donut',
            },
            legend: {
                show: false,
            },
            plotOptions: {
                pie: {
                    customScale: 0.7,
                    donut: {
                        size: 60,
                        labels: {
                            show: true,
                        }
                    }
                }
            },

            series: [100, 55, 25],
            labels: ['Lense', 'Frame', 'Acessories']
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();



        document.getEventListeners('livewire:load', () => {
            @this.on('refreshChart', (chartData) => {
                chart.updateSeries([{
                    data: chartData.seriesData
                }])
            })
        })
    </script>
@endpush

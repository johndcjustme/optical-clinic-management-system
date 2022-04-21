{{-- @php

    for ($i = 1; $i <= date('t', mktime(0, 0, 0, 1, 1, 2022)); $i++) { 
        echo date('Y-m-d', mktime(0, 0, 0, 1, $i, 2022)) . '<br>';
    }
@endphp --}}
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
        <div style="display:flex; flex-direction:column; gap:1em;">

            <div class="ui grid">
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
            </div>





            <div class="ui grid">
                <div class="ten wide computer ten wide tablet sixteen wide mobile column" style="width:60%;">
                    <div class="ui raised link card fluid" style="height:330px;">
                        <div class="content">
                            <div class="x-flex x-flex-xbetween">
                                <div>
                                    <div class="ui header">
                                        Patients By Year
                                    </div>
                                    <div>
                                        <span class="ui text big">
                                            204
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
                    <div class="ui raised link card fluid" style="height:330px;">
                        <div class="content">
                            <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
                        </div>
                    </div>
                </div>
            </div>




{{-- 
            <div class="ui four column grid">
                <div class="column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">All Orders</div>
                            <div class="description">
                                Elliot Fu is a film-maker from New York.
                            </div>
                        </div>
                        <div class="ui bottom attached button">
                            <i class="add icon"></i>
                            Add Friend
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">Ongoing Orders</div>
                            <div class="ui statistic">
                                <div class="value">
                                    100
                                </div>
                            </div>
                        </div>
                        <div class="ui bottom attached button">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">Pending Orders</div>
                            <div class="ui statistic">
                                <div class="value">
                                    65
                                </div>
                            </div>
                        </div>
                        <div class="ui bottom attached button">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">Recieved Orders</div>
                            <div class="ui statistic">
                                <div class="value">
                                    1,000
                                </div>
                            </div>
                        </div>
                        <div class="ui bottom attached button">
                            View
                            <i class="arrow right icon"></i>
                        </div>
                    </div>
                </div>
            </div> --}}



            <div class="" style="display:grid; grid-template-columns: auto 50%; gap:1em;">
                <div class="b_1" style="box-shadow: 0 0 25px -4PX rgba(76, 90, 121, 0.521); padding:2em;">
                    <div class="mb_20">
                        <h3>Out of stocks products</h3>
                    </div>
                    <div class="overflow_y" style="max-height:300px;">
                        <div class="ui very relaxed list">
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/helen.jpg">
                                <div class="content">
                                    <div class="header">Snickerdoodle</div>
                                    An excellent companion
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/helen.jpg">
                                <div class="content">
                                    <div class="header">Snickerdoodle</div>
                                    An excellent companion
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/helen.jpg">
                                <div class="content">
                                    <div class="header">Snickerdoodle</div>
                                    An excellent companion
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Poodle</div>
                                    A poodle, its pretty basic
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="b_1" style="box-shadow: 0 0 25px -4PX rgba(76, 90, 121, 0.521); padding:2em;">
                    <div class="mb_20">
                        <h3>Top selling products</h3>
                    </div>
                    <div class="overflow_y" style="max-height:300px;">
                        <div class="ui very relaxed list">
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/helen.jpg">
                                <div class="content">
                                    <div class="header">Snickerdoodle</div>
                                    An excellent companion
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/helen.jpg">
                                <div class="content">
                                    <div class="header">Snickerdoodle</div>
                                    An excellent companion
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/helen.jpg">
                                <div class="content">
                                    <div class="header">Snickerdoodle</div>
                                    An excellent companion
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Poodle</div>
                                    A poodle, its pretty basic
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                            <div class="item">
                                <div class="right floated content">
                                    <div>56 Sold</div>
                                </div>
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <div class="header">Paulo</div>
                                    He's also a dog
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>







            <div class="" style="display:grid; grid-template-columns: 40% auto; gap:1em;">
                <div class="b_1" style="padding:1em">

                </div>
                <div class="b_1">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut nihil sequi aut alias ipsum placeat, quis
                    id! Reprehenderit quibusdam cupiditate quos aliquam eligendi, odit quas adipisci voluptatibus libero,
                    minus mollitia!
                </div>
            </div>

            <div class="" style="display:grid; grid-template-columns: auto 40%; gap:1em;">
                <div class="b_1" style="padding: 3em">
                </div>
                <div class="b_1">
                    <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
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

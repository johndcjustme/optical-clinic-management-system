<x-layout.page-content>

    @section('section-page-title', 'Dashboard')

    @section('section-links')
        <p style="font-size: 1.3rem;">Hi <b>{{ session()->get('curr_user_name') }}</b>, have a nice day.</p>


        {{-- name:       {{ $currentUser->curr_user() }} --}}
        {{-- id:         {{ $mysession_id }}
        avatar:     {{ $mysession_avatar }}
        role:       {{ $mysession_role }}
        email:      {{ $mysession_email }}
        passcode:   {{ $mysession_passcode }} --}}
    @endsection

    @section('section-heading')
    @endsection

    @section('section-main')

        <div style="display:flex; flex-direction:column; gap:1em;">


            <div class="" style="display:grid; grid-template-columns: 37% 37% auto; gap:1em;">
                <div class="b_1" style="box-shadow: 0 0 25px -4PX rgba(76, 90, 121, 0.521); padding:2em 1em">
                    <div>
                        <div class="">
                            <h3>Patients</h3>
                        </div>
                        <br>
                        <div class="x-flex x-flex-ycenter x-flex-xaround">
                            <div class="br_1 px_15 x-flex x-flex-center x-flex-column" style="width:100%;">
                                <h1><span class="ui text large">512</span></h1>
                                <p>TOTAL</p>
                            </div>
                            <div class="br_1 px_15 x-flex x-flex-center x-flex-column" style="width:100%;">
                                <h1>512</h1>
                                <p>TODAY</p>
                            </div>
                            <div class="px_15 x-flex x-flex-column x-flex-ycenter" style="width:100%;">
                                <h1>512</h1>
                                <p>YESTERDAY</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b_1 x-flex x-flex-center" style="box-shadow: 0 0 25px -4PX rgba(76, 90, 121, 0.521); padding:1em">
                    <div>
                        <div class="">
                            <h3>Orders</h3>
                        </div>
                        <br>
                        <div class="x-flex x-flex-ycenter x-flex-xbetween">
                            <div class="br_1 px_15 x-flex x-flex-center x-flex-column" style="width:100%;">
                                <h1><span class="ui text large">512</span></h1>
                                <p>PENDING</p>
                            </div>
                            <div class="br_1 px_15 x-flex x-flex-center x-flex-column" style="width:100%;">
                                <h1>512</h1>
                                <p>RECEIVED</p>
                            </div>
                            <div class="px_15 x-flex x-flex-column x-flex-ycenter" style="width:100%;">
                                <h1>512</h1>
                                <p>CLAIMED</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="b_1 x-flex x-flex-xbetween x-flex-column" style="box-shadow: 0 0 25px -4PX rgba(76, 90, 121, 0.521); padding:2em">
                    <div>
                        <div>
                            <h5>Item Name</h5>
                        </div>
                        <div class="x-flex x-flex-xbetween" style="font-size: 0.75rem">
                            <div>60%</div>
                            <div>40%</div>
                        </div>
                        <div style="background:gray;">
                            <div style="height:4px; width:60%; background:blue;"></div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <h5>Item Name</h5>
                        </div>
                        <div class="x-flex x-flex-xbetween" style="font-size: 0.75rem">
                            <div>60%</div>
                            <div>40%</div>
                        </div>
                        <div style="background:gray;">
                            <div style="height:4px; width:60%; background:blue;"></div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <h5>Item Name</h5>
                        </div>
                        <div class="x-flex x-flex-xbetween" style="font-size: 0.75rem">
                            <div>60%</div>
                            <div>40%</div>
                        </div>
                        <div style="background:gray;">
                            <div style="height:4px; width:60%; background:blue;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div></div>

            <div class="" style="display:grid; grid-template-columns: auto 40%; gap:1em;">
                <div class="b_1" style="padding:2em; box-shadow: 0 0 25px -4PX rgba(76, 90, 121, 0.521);">
                    <div class="flex flex_x_between gap_1">
                        <div>
                            <h4>Patients by Year</h4>
                        </div>
                        <div class="flex flex_x_end gap_1" style="z-index: 1000">
                            <select class="ui dropdown mini" wire:model="year" name="" id="">
                                <option class="item" value="" selected hidden>Select Year</option>
                                <option class="item" value="22">2022</option>
                                <option class="item" value="28">2021</option>
                                <option class="item" value="40">2020</option>
                                <option class="item" value="15">2019</option>
                            </select>
                            <script>
                                $('.ui.dropdown').dropdown()
                            </script>
                        </div>
                    </div>
                    <br><br>
                    <div>
                        <div id="chartYearlyPatients"></div>
                    </div>
                </div>
                <div class="b_1" style="padding:2em; box-shadow: 0 0 25px -4PX rgba(76, 90, 121, 0.521);">
                    <div class="flex flex_x_between mb_8">
                        <div>
                            <h4>Patients by Month</h4>
                        </div>
                        <div class="flex flex_x_end gap_1">
                            <select name="" id="">
                                <option value="" selected hidden>Select year</option>
                                <option value="">2022</option>
                                <option value="">2021</option>
                                <option value="">2020</option>
                            </select>
                            <select name="" id="">
                                <option value="" selected hidden>Select Month</option>
                                <option value="">January</option>
                                <option value="">February</option>
                                <option value="">March</option>
                                <option value="">April</option>
                                <option value="">May</option>
                                <option value="">June</option>
                                <option value="">July</option>
                                <option value="">August</option>
                                <option value="">September</option>
                                <option value="">November</option>
                                <option value="">December</option>
                            </select>
                        </div>
                    </div>
                    <div style="padding:1em">
                        <div id="chartMonthlyPatients"></div>
                    </div>
                </div>
            </div>





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
                    <div>
                        <span>{{ $recentSubscribers }}</span>
                    </div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut nihil sequi aut alias ipsum placeat, quis
                    id! Reprehenderit quibusdam cupiditate quos aliquam eligendi, odit quas adipisci voluptatibus libero,
                    minus mollitia!
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

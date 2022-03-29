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
  {{ $month['JAN'] }}
      
        <div style="display:flex; flex-direction:column; gap:1em;">

            <div class="" style="display:grid; grid-template-columns: auto 40%; gap:1em;">
                <div class="b_1" style="padding: 2em">
                  <div class="flex flex_x_between gap_1">
                    <div>
                        <h4>Patients by Year</h4>
                    </div>
                    <div class="flex flex_x_end gap_1">
                        <select wire:model="year" name="" id="">
                            <option value="" selected hidden>Select Year</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select>
                    </div>
                </div>
                <br>
                <div>
                    <div id="curve_chart" style="width: 100%; height: 300px;margin:0;"></div>
                </div>
                    {{-- <div class="das_analytics"> --}}
                        {{-- @includeIf('livewire.components.organisms.pagecontents.dashboard.analytics') --}}
                    {{-- </div> --}}
                </div>
                <div class="b_1" style="padding:1em;">
                    <div style="padding:1em;">
                        <div id="piechart"></div>
                    </div>
                </div>
            </div>
    
            <div class="" style="display:grid; grid-template-columns: 40% auto; gap:1em;">
                <div class="b_1" style="padding:1em">
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
                        <div id="montly_patient" style="width: 100%; height: 300px;margin:0;"></div>
                    </div>
                </div>
                <div class="b_1">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut nihil sequi aut alias ipsum placeat, quis id! Reprehenderit quibusdam cupiditate quos aliquam eligendi, odit quas adipisci voluptatibus libero, minus mollitia!
                </div>
            </div>

            <div class="" style="display:grid; grid-template-columns: auto 40%; gap:1em;">
                <div class="b_1" style="padding: 3em">
                  {!! $chart->container() !!}
                </div>
                <div class="b_1">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut nihil sequi aut alias ipsum placeat, quis id! Reprehenderit quibusdam cupiditate quos aliquam eligendi, odit quas adipisci voluptatibus libero, minus mollitia!
                </div>
            </div>





        </div>

    @endsection

</x-layout.page-content>



<script type="text/javascript">
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    // Draw the chart and set the chart values
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Lense', 800],
      ['Frames', 599],
      ['Accessories', 350],
    ]);
    
      // Optional; add a title and set the width and height of the chart
      var options = {
            // 'title':'My Average Day', 
            'width':'100%', 
            // 'height':400,
            // 'theme':'maximized',
            
            chartArea:{
                left:5,
                top: 20,
                width: '100%',
                height: '200',
            }
        };
    
      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
    </script>
    


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>




<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Patients'],
        @php
          echo "['JAN', " . $month['JAN'] . "],";
          echo "['FEB', " . $month['FEB'] . "],";
          echo "['MAR', " . $month['MAR'] . "],";
          echo "['APR', " . $month['APR'] . "],";
          echo "['MAY', " . $month['MAY'] . "],";
          echo "['JUN', " . $month['JUN'] . "],";
          echo "['JUL', " . $month['JUL'] . "],";
        @endphp
        // ['JAN',  45,      20],
        // ['FEB',  50,      20],
        // ['MAR',  10,       20],
        // ['APR',  5,      20],
        // ['MAY',  8,      20],
        // ['JUN',  20,      20],
        // ['JUL',  15,      20],
        ['AUG',  25   ],
        ['SEPT',  45  ],
        ['OCT',  48   ],
        ['NOV',  27   ],
        ['DEC',  10   ],
      ]);

      var options = {
        curveType: 'function',
        legend: { position: 'bottom' },
        theme: 'maximized',
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
  </script>




<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Week', 'Patients'],
      ['WEEK 1',  20],
      ['WEEK 2',  25],
      ['WEEK 3',  15],
      ['WEEK 4',  8],
    ]);

    var options = {
      curveType: 'function',
      legend: { position: 'bottom' },
      theme: 'maximized',
    };

    var chart = new google.visualization.LineChart(document.getElementById('montly_patient'));

    chart.draw(data, options);
  }
</script>


<script>

  @php
    echo 'hello john';
  @endphp
</script>
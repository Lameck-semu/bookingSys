@extends('layouts.headeradmin')
@section('content') 

<!-- start of the cards -->
          <div class="row">
            <!-- first card start -->
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>


                    <div class="float-right">
                      <p class="mb-0 text-right">Total Facilities</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$facility}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Total Facilities owned
                  </p>
                </div>
              </div>
            </div>

            <!-- end of first cards -->
            <!-- second card start -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Bookings</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$booked}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i>Total Facility Bookings
                  </p>
                </div>
              </div>
            </div>

            <!-- end of second cards -->
            <!-- third card start -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Application</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$total_application}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i>Total Facility Applications 
                  </p>
                </div>
              </div>
            </div>            
          </div>
          <!-- end of third cards -->
          <div class="col-lg-13 grid-margin stretch-card" >
    <div class="card">
      <div class="card-body">
        {!!$chart->html() !!}  
      </div>
    </div>
  </div>

  <!-- //application ends -->
        <script type="text/javascript">

          
          $(function() {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  var data = {
    labels: ["2013", "2014", "2014", "2015", "2016", "2017","2018", "2019", "2020", "2021", "2022", "2023"],
    datasets: [{
      label: '# of Votes',
      data: [10, 19, 3, 5, 2, 3, 10, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
         'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
         'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  }

   if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }
};
        </script>

{!! Charts::scripts() !!}
{!! $chart->script() !!}






@endsection
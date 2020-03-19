<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MUST Booking System</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('vendors/icheck/skins/all.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/logo.png')}}">
   @yield('style')
  
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background-color: black ;">

<img src="{{ asset('images/logo3.png')}}" alt="profile image" height="60" width="55">

          <!--<a class="navbar-brand brand-logo" href="./dashboard.php" >

          <img src="{{ asset('images/logo.png') }}" alt="logo"  />
          </a>
        <a class="navbar-brand brand-logo-mini" href="./dashboard.php">
          <img src="{{ asset('images/logo-mini.svg')}}" alt="logo" />
        </a>-->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
       
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
               @if($notification + $notification_public == 0)
              <i class="mdi mdi-bell-off"></i>
              @else
              <i class="mdi mdi-bell-ring"></i>
              <span class="count">{{ $notification + $notification_public }}</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have<span class="badge badge-pill badge-success ">{{ $notification + $notification_public }}</span> new notifications
               </p>
              
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="{{ route('student_list')}}">
                
                <div class="preview-item-content">
                 
                  <h6 class="preview-subject font-weight-medium text-dark">Student(s)<span class="badge badge-pill badge-warning float-right">View</span> <span class="badge badge-pill badge-success ">{{$notification}}</span>  </h6>
                  </div>
                  </a>

                  <a class="dropdown-item preview-item" href="{{ route('public_user_list')}}">
                  <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Public<span class="badge badge-pill badge-warning float-right">View</span> <span class="badge badge-pill badge-success float-right ">{{$notification_public}}</span>  </h6>
                
                </div>
              </a>
              <div class="dropdown-divider"></div> 
            </div>
          </li>
         
           
         
                          
                        <li class="nav-item dropdown">
                               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                            <img class="img-xs rounded-circle" src="{{ asset('images/faces/face1.jpg')}}" alt="Profile image">
                                    
                                </a>
 
                      
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                          </li>
                        
                         <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
                      
        </ul>
       
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper " >
      <!-- partial:partials/_sidebar.html  //lightgrey    -->

      <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-image: url({{asset('images/cm6.png')}});background-size:300px ;background-repeat: no-repeat; background-attachment: fixed">
        <ul class="nav" style="position: fixed">
         
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
          <div class="text-wrapper" style=" margin-right: 30px">
                  <h4 style="color: #ffffff">Estates MIS</h4>
                  <div>
                    <small class="designation text-muted" style="color: #ffffff">Estates Management</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>     
               
              </div>
            </div>
            </li>
         
           
          <li class="nav-item">
            <a class="nav-link" href="{{ route('estate_dashboard')}}">
              <i style="color: #ffffff" class="menu-icon mdi mdi-television"></i>
              <span class="menu-title" style="color: #ffffff">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('student_list')}}">
              <i  style="color: #ffffff" class="menu-icon mdi mdi-school"></i>
              <span class="menu-title" style="color: #ffffff">Student Application list</span>
            </a>
          </li>

          <!--<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#students" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon  mdi mdi-school"></i>
              <span class="menu-title">Students</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="students">
              <ul class="nav flex-column sub-menu ">
                 <li class="nav-item">
                   <a class="nav-link" href="{{ route('student_list')}}">Student Application list</a>
                 </li>
              </ul>
            </div>
          </li>-->
         
        <li class="nav-item">
            <a class="nav-link" href="{{ route('public_user_list')}}">
              <i style="color: #ffffff" class="menu-icon mdi mdi-account-multiple"></i>
              <span class="menu-title" style="color: #ffffff">Public Application list</span>
            </a>
          </li>


          <!--<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general_public" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon  mdi mdi-account-multiple"></i>
              <span class="menu-title">General public</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="general_public">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('public_user_list')}}">Public Application List</a>
                </li>
              </ul>
            </div>
          </li>-->

         <li class="nav-item" style="background-color: hsla(360, 100%, 100%, 0);">
            <a class="nav-link" data-toggle="collapse" href="#hall" aria-expanded="false" aria-controls="ui-basic">
              <i style="color: #ffffff" class="menu-icon  mdi mdi-library-plus"></i>
              <span class="menu-title" style="color: #ffffff">Student spaces </span>
              <i style="color: #ffffff" class="menu-arrow"></i>
            </a>
            <div class="collapse" id="hall" style="background-color: hsla(360, 100%, 100%, 0);">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" style="color: #ffffff"  href="{{ route('add_hall')}}"><i style="color: #ffffff"  class="menu-icon  mdi  mdi-playlist-plus"></i>Add Hall</a>
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" style="color: #ffffff"  href="{{ route('hall_list')}}"><i style="color: #ffffff" class="menu-icon  mdi mdi-format-list-bulleted"></i>Hall List</a>
                </li>
              </ul>
            </div>
          </li>

      <li class="nav-item" style="background-color: hsla(360, 100%, 100%, 0);">
            <a class="nav-link" data-toggle="collapse" href="#general_public" aria-expanded="false" aria-controls="ui-basic">
              <i style="color: #ffffff" class="menu-icon  mdi mdi-library-plus"></i>
              <span class="menu-title" style="color: #ffffff">General Facilities</span>
              <i class="menu-arrow" style="color: #ffffff"></i>
            </a>
            <div class="collapse" id="general_public" style="background-color: hsla(360, 100%, 100%, 0);">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" style="color: #ffffff" href="{{ route('add_facility')}}"><i style="color: #ffffff" class="menu-icon  mdi  mdi-playlist-plus"></i>Add facility</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="color: #ffffff" href="{{ route('facility_list')}}"><i style="color: #ffffff" class="menu-icon  mdi mdi-format-list-bulleted"></i>Facility List</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="color: #ffffff" href="{{ route('public_summary')}}"><i style="color: #ffffff" class="menu-icon  mdi mdi-library-books"></i>Booking Summary</a>
                </li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>
      <!-- partial -->


<!-- main content -->
       <div class="main-panel">
        <div class="content-wrapper">


 @yield('content')

           </div>

              <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
              Copyright &copy;
              <script>
                 document.write(new Date().getFullYear())
              </script>
              <a href="" target="_blank">MUST Booking System</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed & made with
              <i class="mdi mdi-heart text-danger"></i> by 
              <a href="{{ route('developers')}}" target="_blank">Lameck J Semu</a> for a better MUST.
            </span>
          </div>
        </footer>
        <!-- partial -->
        </div>
      <!-- main-panel ends -->

      <!-- //end of main content -->


       </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
    <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{ asset('vendors/js/vendor.bundle.addons.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js')}}"></script>
  <script src="{{ asset('js/misc.js')}}s"></script>
  <!-- endinject -->
   <!-- Custom js for this page-->
 <!--  <script src="{{ asset('js/chart.js')}}"></script> -->
  <script type="text/javascript">
    $(function() {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  var data = {
    labels: ["2013", "2014", "2014", "2015", "2016", "2017", "2018"],
    datasets: [{
      label: '# of Votes',
      data: [10, 19, 3, 5, 2, 3, 25],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(54, 162, 235, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(54, 162, 235, 0.2)'
      ],
      borderWidth: 1
    }]
  };
  var multiLineData = {
    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    datasets: [{
        label: 'Dataset 1',
        data: [12, 19, 3, 5, 2, 3],
        borderColor: [
          '#587ce4'
        ],
        borderWidth: 2,
        fill: false
      },
      {
        label: 'Dataset 2',
        data: [5, 23, 7, 12, 42, 23],
        borderColor: [
          '#ede190'
        ],
        borderWidth: 2,
        fill: false
      },
      {
        label: 'Dataset 3',
        data: [15, 10, 21, 32, 12, 33],
        borderColor: [
          '#f44252'
        ],
        borderWidth: 2,
        fill: false
      }
    ]
  };
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };
  var doughnutPieData = {
    datasets: [{
      data: [30, 40, 30],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
      'Pink',
      'Blue',
      'Yellow',
    ]
  };
  var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };
  var browserTrafficData = {
    datasets: [{
      data: [20, 20, 10, 30, 20],
      backgroundColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(75, 192, 117, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(75, 192, 117, 1)',
        'rgba(255, 159, 64, 1)'
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
      'Firefox',
      'Safari',
      'Explorer',
      'Chrome',
      'Opera Mini'
    ]
  };
  var areaData = {
    labels: ["2013", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
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
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: 'origin', // 0: fill to 'origin'
      fill: '+2', // 1: fill to dataset 3
      fill: 1, // 2: fill to dataset 1
      fill: false, // 3: no fill
      fill: '-2' // 4: fill to dataset 2
    }]
  };

  var areaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    }
  }

  var multiAreaData = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
        label: 'Facebook',
        data: [8, 11, 13, 15, 12, 13, 16, 15, 13, 19, 11, 14],
        borderColor: ['rgba(255, 99, 132, 0.5)'],
        backgroundColor: ['rgba(255, 99, 132, 0.5)'],
        borderWidth: 1,
        fill: true
      },
      {
        label: 'Twitter',
        data: [7, 17, 12, 16, 14, 18, 16, 12, 15, 11, 13, 9],
        borderColor: ['rgba(54, 162, 235, 0.5)'],
        backgroundColor: ['rgba(54, 162, 235, 0.5)'],
        borderWidth: 1,
        fill: true
      },
      {
        label: 'Linkedin',
        data: [6, 14, 16, 20, 12, 18, 15, 12, 17, 19, 15, 11],
        borderColor: ['rgba(255, 206, 86, 0.5)'],
        backgroundColor: ['rgba(255, 206, 86, 0.5)'],
        borderWidth: 1,
        fill: true
      }
    ]
  };

  var multiAreaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    },
    elements: {
      point: {
        radius: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  var scatterChartData = {
    datasets: [{
        label: 'First Dataset',
        data: [{
            x: -10,
            y: 0
          },
          {
            x: 0,
            y: 3
          },
          {
            x: -25,
            y: 5
          },
          {
            x: 40,
            y: 5
          }
        ],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)'
        ],
        borderWidth: 1
      },
      {
        label: 'Second Dataset',
        data: [{
            x: 10,
            y: 5
          },
          {
            x: 20,
            y: -30
          },
          {
            x: -25,
            y: 15
          },
          {
            x: -10,
            y: 5
          }
        ],
        backgroundColor: [
          'rgba(54, 162, 235, 0.2)',
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 1
      }
    ]
  }

  var scatterChartOptions = {
    scales: {
      xAxes: [{
        type: 'linear',
        position: 'bottom'
      }]
    }
  }
  // Get context with jQuery - using jQuery's .get() method.
  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }

  if ($("#lineChart").length) {
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: data,
      options: options
    });
  }

  if ($("#linechart-multi").length) {
    var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
    var lineChart = new Chart(multiLineCanvas, {
      type: 'line',
      data: multiLineData,
      options: options
    });
  }

  if ($("#areachart-multi").length) {
    var multiAreaCanvas = $("#areachart-multi").get(0).getContext("2d");
    var multiAreaChart = new Chart(multiAreaCanvas, {
      type: 'line',
      data: multiAreaData,
      options: multiAreaOptions
    });
  }

  if ($("#doughnutChart").length) {
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }

  if ($("#pieChart").length) {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }

  if ($("#areaChart").length) {
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaData,
      options: areaOptions
    });
  }

  if ($("#scatterChart").length) {
    var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
    var scatterChart = new Chart(scatterChartCanvas, {
      type: 'scatter',
      data: scatterChartData,
      options: scatterChartOptions
    });
  }

  if ($("#browserTrafficChart").length) {
    var doughnutChartCanvas = $("#browserTrafficChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: browserTrafficData,
      options: doughnutPieOptions
    });
  }
});
  </script>
   @yield('js')
  <!-- End custom js for this page-->
</body>

</html>
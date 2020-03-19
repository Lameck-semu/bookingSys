    
      @extends('layouts.headerestate')
  
@section('content')
<!-- start of the cards -->
          <div class="row">
            <!-- first card start -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Facilities</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">50</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> All available Facilities
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
                      <p class="mb-0 text-right">Booked Facilities</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">34</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Daily
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
                        <h3 class="font-weight-medium text-right mb-0">93</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Annual Application 
                  </p>
                </div>
              </div>
            </div>            
          </div>
          <!-- end of third cards -->
    <!-- //end of cards -->


      <!-- Applications start -->

           <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Applications</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> Number</th>
                          <th> Full Name </th>
                          <th> Facility  </th>
                          <th> Capacity  </th>
                          <th> Reason    </th>
                          <th> Action    </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-medium"> 1 </td>
                          <td> Loyce Nkundula </td>
                          <td> Main Auditorium </td>
                          <td> 50     </td>
                          <td > Mass Service </td>
                          <td>
                            <a href=""><label class="badge badge-success" >Endorse</label> </a>
                            <a href=""><label class="badge badge-warning" >Pending</label> </a>   
                            <a href=""><label class="badge badge-danger" >Reject</label> </a> 
                          </td>
                        </tr>

                        <tr>
                          <td class="font-weight-medium"> 2 </td>
                          <td> Madalitso Nyemba </td>
                          <td> Mini Auditorium </td>
                          <td> 50     </td>
                          <td > UCC Service </td>
                          <td>
                            <a href=""><label class="badge badge-success" >Endorse</label> </a>
                            <a href=""><label class="badge badge-warning" >Pending</label> </a> 
                            <a href=""><label class="badge badge-danger" >Reject</label> </a> 
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- //application ends -->

      @endsection

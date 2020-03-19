
@extends('layouts.headerstudent')
@section('content')
      <div class="">
        <div class="content-wrappr">
       
          <div class="row">
             <div class="col-md-12" style="text-align: center;">
                    <div class="card-body">
                      <h1 class="card-title " style="color: white; font-size: 20px">MUST Booking System</h1>
                      <a href="{{ route('logout') }}" style="color:white"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="mdi mdi-lock"></i> Logout</a>
                                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                      <br />
                      <br />
                      <p class="card-description" id="intro" style="color: white" >Hello {{Auth::user()->name}}</p>
                      <p class="card-description" id="intro" style="color: white" >Please choose what want to apply</p>

                        <p class="card-description" id="venuetab" style="color: white; display: none" >You can start filling in details for Facilities
                        </p>
                        <p class="card-description" id="transporttab" style="color: white; display: none" >You can start filling in details for transport
                        </p>
                      <div class="template-demo">
                        
                        <span onclick="venue()">
                        <button  type="button" class="btn btn-icons btn-rounded btn-outline-success btn-fw">
                          <i class="mdi mdi-email"></i> Facility
                        </button></span>
                        <span onclick="transport()">
                        <button  type="button" class="btn btn-icons btn-outline-warning btn-rounded  btn-fw">
                          <i class="mdi mdi-home"></i> Transport
                        </button></span>
                      </div>
                    </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-12 grid-margin" id="transport" style="display: none; ">
<h2 style="color:white">Previous bookings for </h2>
            <!-- start of table -->
            <div class="table-responsive" style="color:white" id="table">
                      <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> #</th>
                          <th> Booked destination </th>
                          <th> Booked date </th>
                          <th> Status  </th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      <!-- logic for selecting view to display students and transport booked -->
                     
                        <!-- end of selecting the students with what they booked -->

                      
                      </tbody>
                    </table>
                  </div>



            <!-- end of table -->
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="text-align: center; color: black">Transport Booking</h4>
                  <form class="form-sample" action="../functionality/bookFacility.php" method="POST">
                    <p class="card-description">
                      Applicant's personal details
                    </p>
                    <input type="hidden" name="studentId" value="" />
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Previous Hall</label>
                          <div class="col-sm-9">
                           <input type="text"  name="previous_hall" class="form-control"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"> Room Number </label>
                          <div class="col-sm-9">
                            <input type="number"  name="room_number" class="form-control"/>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                   
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"> Do you have any disability</label>
                          <div class="col-sm-9">
                            
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"> End Date</label>
                          <div class="col-sm-9">
                            <input type="date" name="endDate" class="form-control" placeholder="dd/mm/yyyy" />
                          </div>
                        </div>
                      </div>
                      
                       
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Starting Time</label>
                          <div class="col-sm-9">
                            <input type="time" name="startingTime" class="form-control" placeholder="hh:mm:ss" />
                          </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"> Completion Time </label>
                          <div class="col-sm-9">
                            <input type="time" name="endTime" class="form-control" placeholder="hh:mm:ss" />
                          </div>
                        </div>
                      </div>
                       
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Reason of Booking</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="purposeOfBooking" cols="10" rows="8"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="form-group row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <button class="btn btn-primary submit-btn btn-block">Submit</button>
                    </div>
                  <div class="col-md-5"></div>
                  </div>
                  </form>
                </div>
              </div>
            </div>


<!-- Beginning of form for transport -->
          <div class="col-12 grid-margin" id="venue" style="display: none;">

          <h2 style="color:white; text-align: center;">{{2000- $rooms}} space Remaining  </h2>
            <!-- start of table -->
            <div class="table-responsive" style="color:white" id="table">
           

                     <table class="table table-bordered">
                      <thead>
                      <tr>
                          <th> #</th>
                          <th> Application date </th>
                          <th> Status  </th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      <!-- logic for selecting view to display students and transport booked -->
                         
                         @if($applied==Auth::user()->id)
                         <tr>
                           <td>#</td>
                           <td>{{$created_at->ago()}}</td>
                           @if($approval=="pending")
                           <td>Your application is at <label class="badge badge-warning">pending</label></td>
                           @elseif($approval=="yes")
                           <td>Your application is <label class="badge badge-success">approved</label></td>
                           @else
                           <td>Your application is <label class="badge badge-danger">rejected</label> </td>
                           @endif
                         </tr>
                        @endif
                         
                        
                        <!-- end of selecting the students with what they booked -->

                      
                      </tbody>
                    </table>
                  </div>



            <!-- end of table -->
            
            @if($applied!=Auth::user()->id)
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="text-align: center;">Application for the Accomadation</h4>
                  <form class="form-sample" action="{{ route('student')}}" method="POST">
                    @csrf
                    <p class="card-description">
                      <h5>A. Applicant's personal details</h5>
                    </p>
<!--
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First name</label>
                          <div class="col-sm-9">
                           <input type="text"  name="previous_hall" class="form-control"/>
                           <input type="hidden"  name="user_id" value="{{Auth::user()->id}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First name</label>
                          <div class="col-sm-9">
                           <input type="text"  name="previous_hall" class="form-control"/>
                           <input type="hidden"  name="user_id" value="{{Auth::user()->id}}" />
                          </div>
                        </div>
                      </div>
                       
                    </div>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Programme</label>
                          <div class="col-sm-9">
                           <input type="text"  name="previous_hall" class="form-control"/>
                           <input type="hidden"  name="user_id" value="{{Auth::user()->id}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date of birth</label>
                          <div class="col-sm-9">
                           <input type="text"  name="previous_hall" class="form-control"/>
                           <input type="hidden"  name="user_id" value="{{Auth::user()->id}}" />
                          </div>
                        </div>
                      </div>
                       
                    </div>
                   
                   
-->
              <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Previous Hall</label>
                          <div class="col-sm-9">
                            @if(Auth::user()->gender=="male")
                             <select class="form-control" id="exampleFormControlSelect1" name="previous_hall" required>
                                    <option value="">  Select</option>
                                    <option  value="None"> None</option>
                                    <option value="Hall 1">  Hall 1</option>
                                    <option value="Hall 2">  Hall 2</option>
                                    <option value="Hall 3">  Hall 3</option>
                                    <option value="Hall 4">  Hall 4</option>
                                    <option value="Hall 8">  Hall 8</option>
                                  </select>
                                  @else
                                  <select class="form-control" id="exampleFormControlSelect1" name="previous_hall" required>
                                    <option value="">  Select</option>
                                    <option  value="None"> None</option>
                                    <option value="Hall 1">  Hall 5</option>
                                    <option value="Hall 2">  Hall 6</option>
                                    <option value="Hall 3">  Hall 7</option>
                                  </select>

                                  @endif 
                           
                           <input type="hidden"  name="user_id" value="{{Auth::user()->id}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Room number</label>
                          <div class="col-sm-9">
                            <input type="number"  name="room_number" class="form-control" min="0"  max="57"  />
                          </div>
                        </div>
                      </div>
                       
                    </div>



                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class=" col-sm-4 col-form-label"> Do you have any disability</label>
                        
                                <div class="col-sm-8">
                                  <label><input type="radio" id="yes" name="disability" value="yes" onchange="displayQuestion(this.value)"> Yes</label>

                                  <label style="margin-left: 16px;"><input type="radio" id="no" name="disability" value="no" onchange="displayQuestion(this.value)"> No</label>
                                  <!-- <select class="form-control" id="exampleFormControlSelect1" name="disability" required>
                                    <option value="">  Select</option>
                                    <span onselect="disability()"><option  value="yes">  Yes</option></span>
                                    <option value="no">  No</option>
                                  </select> -->
                                 
                              </div>
                        </div>
                        </div>
                    </div>

                      <div class="row" id="yesQuestion" style="display: none;" >
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Disability Specification</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="disability_specification" cols="10" rows="8"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row" id="noQuestion" style="display: none;" >
                      <div class="col-md-12">
                        <div class="form-group row">
                         
                        </div>
                      </div>
                    </div>
                <div>
                  <h5>B. Rules and regulations</h5>
                    <p>Students that are in University residence have to abide by the MUST Rules and Regulations. Please read them.</p>
                  <h5>C. Additional conditions</h5>
                    <p>1. Each application is for one academic year only <br>
                       2. College accommodation refers to campus and off campus hostels <br>
                       3. The University reserves the right to expel from his/her room any student who abuses or misuses a room in any Hall of Residence <i>(students rules and regulations, clause 6.3)</i>
                    </p>
                </div>
                  
                    <div class="form-group row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <button class="btn btn-primary submit-btn btn-block" onclick="prompt('Do you agree with the terms and conditions attached to this application')">Submit</button>
                    </div>
                  <div class="col-md-5"></div>
                  </div>
                  </form>
                </div>
              </div>

              @else
              <p></p>
              @endif
              
            </div>
          </div>
        </div>
          
        </div>
<script type="text/javascript">
  function displayQuestion(answer){
    document.getElementById(answer + 'Question').style.display = "block";
    if (answer == "yes"){
      document.getElementById('noQuestion').style.display = "none";
    } else if (answer == "no"){
     document.getElementById('yesQuestion').style.display = "none"; 
    }
  }
</script>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       @endsection
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>MUST Booking System</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

  <!-- Fonts and icons -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

  <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" />
</head>

<body>
  <div class="image-container set-full-height" style="background-image: url('images/semu.png'); width: 100%; height: 100%; ">
    
                
       <div class="text-center"  >
  
           <a href="{{ route('logout') }} " style="background-color: cornflowerblue;" class="made-with-mk" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
      <div class="brand" ><i class="fa fa-sign-out fa-2x" style="margin-top: -5px; margin-left: 3px"></i> logout</div>
      <div class="made-with"></div>
    </a>
                <!--<a  class="dropdown-item" href="{{ route('logout') }}"  
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      {{ __('Logout') }}
                      
                </a>  -->

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                </form> 
            
        </div>

    <!--   Big container   -->
    <div class="container" style="margin-top: -25px">
       
        <div class="row"  >
        <div class="col-sm-8 col-sm-offset-2">

            <!--      Wizard container   23     -->
            <div class="wizard-container">

                <div class="card wizard-card" data-color="blue" id="wizardProfile"  style="background-image: url('assets/img/bgi.jpg')">
                    <form action="{{ route('student')}}" method="POST" enctype="multipart/form-data">
                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->


                      <div class="wizard-header">

               

                       <!--<b>BOOK</b> WITH US <br>-->
                          <h3>                          
                             
                             <small> Application For Hostel Accommodation Second Semester(
                              <script>
                 document.write(new Date().getFullYear()-1)
              </script>
              /
              <script>
                 document.write(new Date().getFullYear())
              </script>
            Academic Year)
                             </small>
                             <p class="card-description" id="intro" style="color: white" >Hello! {{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                              @if (session('status'))
        <span class="alert alert-danger">{{ session('status') }}</span>
    @endif 
                          </h3>


                      </div>

            <div class="wizard-navigation">
            @if($applied!=Auth::user()->id)

                <ul>
                    <li><a href="#about" data-toggle="tab">Rules</a></li>
                    <li><a href="#account" data-toggle="tab">Details</a></li>
                    <li><a href="#address" data-toggle="tab">Upload</a></li>
                </ul>
@endif
@if($applied==Auth::user()->id)
<ul>
                    <li><a href="#about" data-toggle="tab">Pending</a></li>
                   
                </ul>
@endif

            </div>
                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                            @if($applied==Auth::user()->id)

                            <div class="table-responsive" style="color:white" id="table">
           

           <table class="table table-bordered">
            <thead>
            <tr>
                <!--<th> #</th>-->
                <th> Application date </th>
                <th> Status  </th>
               
              </tr>
            </thead>
            <tbody>
            <!-- logic for selecting view to display students and transport booked -->
               
               <tr>
                 <!--<td>#</td>-->
                 <td>{{$created_at->ago()}}</td>
                 @if($approval=="pending")
                 <td>Your application is at <label class="badge badge-warning">pending</label></td>
                 @elseif($approval=="yes")
                 <td>Your application is <label class="badge badge-success">approved</label> space allocated is {{$hall}} room {{$room_allocated}}   </td>
                 @else
                 <td>Your application is <label class="badge badge-danger">rejected</label> </td>
                 @endif
               </tr>
               
              
              <!-- end of selecting the students with what they booked -->

            
            </tbody>
          </table>
        </div>
        @endif
        @if($applied!=Auth::user()->id)

                              <div class="row">
                                <div class="col-sm-12">
                                 <h5 style="color: cyan"> Rules and regulations</h5>
                    <p style="color: white">Students that are in University residence have to abide by the MUST Rules and Regulations. Please read them.</p><br>
                  <h5 style="color: cyan"> Additional conditions</h5>
                    <p style="color: white">1. Each application is for one academic year only <br>
                       2. College accommodation refers to campus and off campus hostels <br>
                       3. The University reserves the right to expel from his/her room any student who abuses or misuses a room in any Hall of Residence <i>(students rules and regulations, clause 6.3)</i>
                    </p>
                    <p style="color: white"><i>Do you agree to abide by the above rules and conditions?</i></p>

                          <label style="color: cyan"><input type="radio"  name="disability" value="yes" onchange="displayRules(this.value)" id="yes"  required> No</label>

                          <label style="margin-left: 16px; color: cyan"><input type="radio" id="no" name="disability" value="no" onchange="displayRules(this.value)"  required > Yes</label>

          

                    </div>             
                  </div>
                  @endif

                </div>
        <script type="text/javascript">
  function displayRules(answer){
    // document.getElementById(answer + 'Rules').style.display = "block";
    if (answer == "no"){
      document.getElementById('yesRules').style.display = "block";
    } else if (answer == "yes"){
     document.getElementById('yesRules').style.display = "none"; 
    }
  }
</script>
                
  @csrf
                  
       <div class="tab-pane" id="account">         

    <div class="col-sm-12 grid-margin " id="venue" >

                    <h3 style="color:white; text-align: center;">{{$not_booked}} space remaining for {{Auth::user()->gender}}s  </h3>
          
            <!-- start of table -->
            <div class="table-responsive" style="color:white" id="table">
           

                     <table class="table table-bordered">
                      <thead>
                      <tr>
                          <!--<th> #</th>-->
                          <th> Application date </th>
                          <th> Status  </th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      <!-- logic for selecting view to display students and transport booked -->
                         
                         @if($applied==Auth::user()->id)
                         <tr>
                           <!--<td>#</td>-->
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
              <div class="card " >
                <div class="card-body">
                  <div style="margin-left: 10px; margin-right: 10px">
                  <h5 class="card-title" style="text-align: center;">Fill the form below</h5>
                 
                    <p class="card-description">
                      <h5><strong>A. Applicant's personal details:</strong></h5>
                    </p>

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
                                    <option value="Hall A">  Hall A</option>
                                    <option value="Hall B">  Hall B</option>
                                    <option value="Hall D">  Hall D</option>
                                    <option value="Hall E">  Hall E</option>
                                    <option value="Hall G">  Hall G</option>
                                    <option value="Hall H">  Hall H</option>
                                    <option value="Hall I">  Hall I</option>
                                    <option value="Hall J">  Hall J</option>
                                    <option value="Hall K">  Hall K</option>
                                    <option value="Hall L">  Hall L</option>
                                  </select>
                                  @else
                                  <select class="form-control" id="exampleFormControlSelect1" name="previous_hall" required>
                                    <option value="">  Select</option>
                                    <option  value="None"> None</option>
                                    <option value="Hall 1">  Hall 5</option>
                                    <option value="Hall 2">  Hall 6</option>
                                    <option value="Hall 3">  Hall 7</option>
                                    <option value="Hall C">  Hall C</option>
                                    <option value="Hall F">  Hall F</option>
                                    <option value="Hall M">  Hall M</option>
                                    <option value="Hall N">  Hall N</option>
                                  </select>

                                  @endif 
                           
                           <input type="hidden"  name="user_id" value="{{Auth::user()->id}}" />
                           <input type="hidden"  name="user_name" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Previous Room</label>
                          <div class="col-sm-9">
                            <input type="number"  name="room_number" class="form-control" min="0"  max="57"  />
                          </div>
                        </div>
                      </div>
                       
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                       <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Year of study</label>
                          <div class="col-sm-9">
                            
                             <select class="form-control" id="exampleFormControlSelect1" name="year_of_study" required>
                                    <option value="">Select</option>
                                    <option value="1">Year 1</option>
                                    <option value="2">Year 2</option>
                                    <option value="3">Year 3</option>
                                    <option value="4">Year 4</option>
                                    <option value="5">Year 5</option>
                                  </select>
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
              <br>

                    <p class="card-description">
                      <h5><strong>B. Next of kin details:</strong></h5>
                    </p>
                    <div class="row">    
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First name</label>
                          <div class="col-sm-9">
                            <input type="text"  name="kin_first_name" class="form-control" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last name</label>
                          <div class="col-sm-9">
                            <input type="text"  name="kin_last_name" class="form-control" />
                          </div>
                        </div>
                      </div>
                       
                  </div>


                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Relationship</label>
                          <div class="col-sm-9">
                             <select class="form-control" id="exampleFormControlSelect1" name="relationship" required>
                                    <option value="">  Select</option>
                                    <option value="father">  Father</option>
                                    <option value="mother">  Mother</option>
                                    <option value="uncle">  Uncle</option>
                                    <option value="aunt">  Aunt</option>
                                    <option value="brother">  Brother</option>
                                    <option value="sister">  Sister</option>
                                  </select>
                          </div>
                        </div>
                      </div>

                  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone number</label>
                          <div class="col-sm-9">
                            <input type="text"  name="phone_number" class="form-control"  />
                          </div>
                        </div>
                    
                    </div>
                  </div>
                </div>
              </div>
              </div>

              @else
              <p></p>
                    @endif 

                     </div>
                    </div>          
                            
                            <div class="tab-pane" id="address">
                                <div class="row">

                                    
                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                          <div class="picture">
                                              <img src="assets/img/file.jpg" class="picture-src" id="wizardPicturePreview" title=""/>
                                              <input type="file" id="wizard-picture" name="image" required="">
                                          </div>
                                          <p style="color: white">Please upload Your deposit slip in picture format (mandatory)</p>  
                                          <p style="color: cyan"> <strong>!!</strong> Remember to submit your deposit slip to Accounts Office to clear your balance <strong>!!</strong></p>
                                      </div>
                                  </div>
                               
                                </div>
                                @if($not_booked == 0 )

                                <span class="alert alert-danger">Sorry no bed space available</span>
                                @endif
                            </div>
                             
                        </div>
                        @if($applied!=Auth::user()->id)

                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' id="yesRules"  />

                                @if($not_booked != 0 )
                                
                                <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' placeholder="Finish" />
                                @endif

                            </div>
                          

                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @endif
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
    </div> <!--  big container -->
 
    <div class="footer">
        <div class="container"> 
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
              Copyright &copy;
              <script>
                 document.write(new Date().getFullYear())
              </script>
          <a href="" target="_blank">MUST Booking System</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed & made with
              <i class="fa fa-heart heart"></i>
              <a href="" target="_blank"></a> for a better MUST.
            </span>


            <!-- Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a>-->
        </div>
    </div>
  
</div> 

</body>

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

  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('assets/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>

  <!--  Plugin for the Wizard -->
  <script src="{{ asset('assets/js/gsdk-bootstrap-wizard.js')}}"></script>

  <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
  <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>

</html>

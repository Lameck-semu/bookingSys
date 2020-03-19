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

  <!--     Fonts and icons     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

  <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{ asset('assets/css/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" />
</head>

<body>
<div class="image-container set-full-height" style="background-image: url('images/semu.png')">
    <!--   Creative Tim Branding   -->
  <!--  <a href="http://creative-tim.com">
         <div class="logo-container">
            <div class="logo">
                <img src="assets/img/kg.png" width="60" height="60">
            </div>
            <div class="brand">
                Aaaaa
            </div>
        </div> 
    </a>-->
 
  <!-- Made With Get Shit Done Kit  -->
              <!--<a href="{{ route('logout') }} " class="made-with-mk" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <div class="brand"></div>
                   <div class="made-with"></div>
              </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>-->

    <!--   Big container   -->
    <div class="container" style="border-top: -20px;">
        <div class="row" style="margin-top: -80px">
        <div class="col-sm-8 col-sm-offset-2">

            <!--      Wizard container        -->
            <div class="wizard-container" >

                <div class="card wizard-card" data-color="blue" id="wizardProfile"  style="background-image: url('assets/img/bgi.jpg')">
                    <form action="{{ route('select_facility')}}" method="POST">
                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                      <div class="wizard-header">
                          <h3>
<img src="{{ asset('images/logo3.png')}}" alt="profile image" height="150" width="140"> <br>
                             
                             <b>BOOK</b> WITH US <br>
                             <small> MUST Facility Booking System </small>
                             
                          </h3>
                      </div>

            <div class="wizard-navigation">
              <ul>
                              <li><a href="#account" data-toggle="tab">Details Once More</a></li>
                              <!-- <li><a href="#address" data-toggle="tab">Upload</a></li> -->
                          </ul>

            </div>

                        <div class="tab-content">
                      
    
<!-- wizard two -->
 <form class="form-sample" action="{{ route('select_facility')}}" method="POST">
                    @csrf
       <div class="tab-pane" id="account">

    <div class="col-sm-12 grid-margin " id="venue" >

              <div class="card " >
                <div class="card-body">
                  <div style="margin-left: 10px; margin-right: 10px">
                  <h4 class="card-title" style="text-align: center;">Booking Of Facilities</h4>
                  
                  <div class="row ">
                        
                     <div class="col-md-11">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label"><h5><strong>A. From </strong><em>( Applicant(s) )</em></h5></label>
                            <div class="col-sm-8">
                            <input type="text"  name="from_who" class="form-control" value="{{$from_who}}" cols="10" rows="4" required />
        
                          </div>
                        </div>
                      </div>
                       
                  </div>
                  <hr />

                    <p class="card-description">
                      <h5><strong>B. Contact Person's details</strong></h5>
                    </p>

                  <div class="row">
                        
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First name</label>
                          <div class="col-sm-9">
                            <input type="text"  name="first_name" class="form-control" value="{{$first_name}}" required />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last name</label>
                          <div class="col-sm-9">
                            <input type="text"  name="last_name" value="{{$last_name}}" class="form-control" required />
                          </div>
                        </div>
                      </div>
                       
                  </div> 

                  <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone number</label>
                          <div class="col-sm-9">
                            <input type="text"  name="phone_number" value="{{$phone_number}}" class="form-control" required />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email"  name="mail" value="{{$email}}" class="form-control" />
                          </div>
                        </div>
                      </div>
                       
                  </div>
              
                  <hr />
                  <p class="card-description">
                      <h5><strong>C. Booking details</strong></h5>
                    </p>
 
                  <div class="row">
                        
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date(from)</label>
                          <div class="col-sm-9">
                            <input type="date" min="{{date('Y-m-d')}}" name="start_date" class="form-control" required />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date(to)</label>
                          <div class="col-sm-9">
                            <input type="date" min="{{date('Y-m-d')}}" name="end_date" class="form-control" required />
                          </div>
                        </div>
                      </div>
                       
                  </div>

                 <!--  <div class="row">
                        
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Number of Days</label>
                          <div class="col-sm-9">
                            <input type="number" name="number_of_days" class="form-control" required min="1"/>
                          </div>
                        </div>
                      </div>
                       
                  </div>  -->

                  <div class="row">
                        
                     <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Time(from)</label>
                          <div class="col-sm-9">
                            <input type="time"  name="time_from" class="form-control" required />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-5">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Time(to) </label>
                          <div class="col-sm-9">
                            <input type="time"  name="time_to" class="form-control" required />
                          </div>
                        </div>
                      </div>
                       
                  </div>
                  <br>
                  <div class="row ">
                        
                     <div class="col-md-11">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Booking purpose</label>
                            <div class="col-sm-9">
                            <textarea class="form-control" name="booking_purpose" cols="10" rows="3" required></textarea>
                          </div>
                        </div>
                      </div>

                       
                  </div>

                  <div class="row">
                      <div class="col-md-11">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Number of Participants</label>
                          <div class="col-sm-9">
                            <input type="number"  name="number_of_participants" class="form-control" min="1" />
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
              
                  
                 
                </div>
                </div>
              </div>

              
              <p></p>
              
              
            </div>
                               
                            </div>
                  
                             
                        </div>
                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' id="yesRules" />
                                <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' placeholder="Finish" />

                            </div>

                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
    </div> <!--  big container -->

    <div class="footer">
      <div class="container">
             <a href="http://www.bootstrapdash.com/" target="_blank">MUST Booking System</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed & made with
              <i class="fa fa-heart heart"></i>
              <a href="http://www.bootstrapdash.com/" target="_blank"></a> for a better MUST.
            </span>

        </div>
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

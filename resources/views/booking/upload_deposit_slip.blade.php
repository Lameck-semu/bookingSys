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
       
       <div class="text-center"  >
  
           <a href="{{ route('logout') }} " style="background-color: cornflowerblue;" class="made-with-mk" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
      <div class="brand" ><i class="fa fa-sign-out fa-2x" style="margin-top: -5px; margin-left: 3px"></i> DONE</div>
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
    <div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <!--      Wizard container        -->
            <div class="wizard-container">

                <div class="card wizard-card" data-color="blue" id="wizardProfile"  style="background-image: url('assets/img/bgi.jpg')">
                    <form action="{{ route('upload_deposit_slip')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->
                      <div class="wizard-header">
                          <h3>
                             <img src="{{ asset('images/logo3.png')}}" alt="profile image" height="150" width="140"> <br>
                             
                             <!--<b>BOOK</b> WITH US <br>-->
                             <small> MUST Booking System </small>
                          </h3>
                      </div>

            <div class="wizard-navigation">
              <ul>
                              <li><a href="#about" data-toggle="tab">Upload Deposit Slip</a></li>
                              <!-- <li><a href="#address" data-toggle="tab">Upload Deposit Slip</a></li> -->
                    
                          </ul>

            </div>
            <input type="hidden" name="email" value="{{$em}}">

                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                              <div class="row">

                                    
                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                          <div class="picture">
                                              <img src="assets/img/file.jpg" class="picture-src" id="wizardPicturePreview" title=""/>
                                              <input type="file" id="wizard-picture" name="image">
                                          </div>
                                          <!--<h6 style="color: white">Can You upload Your deposit slip</h6>-->
                                          <p style="color: white">Please upload Your deposit slip in image format <strong><em>(mandatory)</em></strong></p>

                                      </div>
                                  </div>
                               
                                </div>
                                      <h5 style="color: cyan">Note</h5>
                    <p style="color: white">You must upload your deposit slip within 24 hours after the booking, or your application will be rejected</p>
                    <p style="color: white">Use your email and password you created to login when uploading the deposit slip later</p>

                    <h5 style="color: cyan">Click DONE <em>down right</em> to upload deposit slip <strong>later</strong> if you have selected a fasility</h5>
                 
                            </div>
            
                           



       
                            <div class="tab-pane" id="address">
                              
                                <!-- start of table -->
                    


                            </div>
                             
                        </div>
                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
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

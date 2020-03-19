@extends('layouts.app')

@section('content')


 <div class="container-scroller">
  <div class="row ">
           
           <div class="col-lg-12" style="text-align: center;">
               @if (session('status'))
                  <span class="alert alert-success">
                      <strong>{{ session('status') }}</strong>
                  </span>
              @endif
           </div>
          
         </div>
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row " style="width: 110%">
          <div class="col-md-4 col-sm-5 col-xs-5"></div>
          
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="auto-form-wrapper">
              <img src="{{ asset('images/logo.png')}}" style="margin-left:27%; margin-right: 35%; " height="120" width="100">
              <br/>
              <br/>
              <form  method="POST" action="{{ route('login') }}">
                 @csrf
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your username" style="border: 1px solid; border-radius: 10px;">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                 
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>

                  <div class="input-group">
                     <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password" style="border: 1px solid; border-radius: 10px;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block mdi mdi-arrow-right-bold-circle-outline">Login</button>
                </div>
              </form>

                <div>
              <p>

                <a href="{{ route('register') }}" ><i class="menu-icon  mdi mdi-account"> </i>New Student? click here</a>
<br>
                <a href="{{route('password.request')}}" style="text-align: right">
                   <i class="menu-icon  mdi mdi-lock-outline"> </i>
                   <span class="menu-title">Forgot Password?</span></a>
              </p>
                </div>
            </div>
            <br />
            <p class="footer-text text-center">Copyright &copy;
              <script>
                 document.write(new Date().getFullYear())
              </script>
              <a href="#" target="_blank">MUST Booking System</a>. All rights reserved.</p>
          </div>
          <div class="col-md-4 col-sm-3 col-xs-3"></div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection

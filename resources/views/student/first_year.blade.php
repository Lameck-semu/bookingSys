@extends('layouts.app')

@section('content')


 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <img src="{{ asset('images/logo.png')}}" style="margin-left: 35%; margin-right: 35%; " height="120" width="100">
              <br/>
              <br/>
              <form  method="POST" action="{{ route('newStudent') }}">
                 @csrf
                <div class="form-group">
                  <label class="label">Email</label>
                  <div class="input-group">
                    <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your username" style="border: 1px solid">

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
                     <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password" style="border: 1px solid">

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
                <div>
              <p>

                Login as <a href="{{ route('register') }}" ><i class="menu-icon  mdi mdi-account"> </i>New Student</a> to apply?
<br>
                <a href="{{route('password.request')}}" style="text-align: right">
                   <i class="menu-icon  mdi mdi-lock-outline"> </i>
                   <span class="menu-title">Forgot Password?</span></a>
              </p>
                </div>
              </form>
            </div>
            <br />
            <p class="footer-text text-center">Copyright &copy;
              <script>
                 document.write(new Date().getFullYear())
              </script>
              <a href="#" target="_blank">MUST Booking System</a>. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
@endsection

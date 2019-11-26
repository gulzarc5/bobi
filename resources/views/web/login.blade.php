@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
 <section class="main-container col1-layout">
    <div class="main container Login-section">
      <div class="page-content">
        <div class="account-login">
          <div class="box-authentication">
            <h4>Login</h4>
            <p class="before-login-text">Welcome back! Sign in to your account</p>
            @if (Session::has('message'))
              <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif 
            @if (Session::has('error'))
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            {{ Form::open(array('route' => 'web.buyerLogin', 'method' => 'post')) }}
              <label for="emmail_login">Mobile Number<span class="required">*</span></label>
              <input id="emmail_login" value="{{ old('mobile') }}" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter Mobile Number" >
              @if ($message = Session::get('login_error'))
                <span class="invalid-feedback" role="alert" style="color:red">
                    <strong>{{ $message }}</strong>
                </span><br>
              @endif
              @if($errors->has('mobile'))
                <span class="invalid-feedback" role="alert" style="color:red">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span><br>
              @enderror

              <label for="password_login">Password<span class="required">*</span></label>
              <input id="password_login" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" >
              @if($errors->has('password'))
                  <span class="invalid-feedback" role="alert" style="color:red">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span><br>
              @enderror

              <p class="forgot-pass"><a href="{{ route('web.forgot-password')}}">Lost your password?</a></p>
              <button class="button"><i class="icon-lock icons"></i>&nbsp; <span>Login</span></button>
            {{ Form::close() }}
            <div class="register-benefits" style="display: flex;">
              <h5>Haven't Registred Yet?</h5>&nbsp; <a href="{{ route('web.user_registration_form')}}">Register</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  
  <!-- Main Container End --> 
@endsection
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
            <label for="emmail_login">Email address<span class="required">*</span></label>
            <input id="emmail_login" type="text" class="form-control">
            <label for="password_login">Password<span class="required">*</span></label>
            <input id="password_login" type="password" class="form-control">
            <p class="forgot-pass"><a href="{{ route('web.forgot-password')}}">Lost your password?</a></p>
            <button class="button"><i class="icon-lock icons"></i>&nbsp; <span>Login</span></button>
            <div class="register-benefits" style="display: flex;">
              <h5>Haven't Registred Yet?</h5>&nbsp; <a href="{{ route('web.register')}}">Register</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  
  <!-- Main Container End --> 
@endsection
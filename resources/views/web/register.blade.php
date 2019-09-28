@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
 <section class="main-container col1-layout">
    <div class="main container Login-section">
      <div class="page-content">
        <div class="account-login">
          <div class="box-authentication">
            <h4>Register</h4>
            <p>Create your very own account</p>
            <label for="emmail_register">Email address<span class="required">*</span></label>
            <input id="emmail_register" type="text" class="form-control">
            <label for="emmail_register">Password<span class="required">*</span></label>
            <input id="emmail_register" type="text" class="form-control">
            <label for="emmail_register">Confirm Password<span class="required">*</span></label>
            <input id="emmail_register" type="text" class="form-control">
            <button class="button"><i class="icon-user icons"></i>&nbsp; <span>Register</span></button>
            <div class="register-benefits" style="display: flex;">
              <h5>Alredy Registred?</h5>&nbsp; <a href="{{ route('web.login')}}">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  
  <!-- Main Container End --> 
@endsection
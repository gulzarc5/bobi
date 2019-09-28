@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
 <section class="main-container col1-layout">
    <div class="main container Login-section">
      <div class="page-content">
        <div class="account-login">
          <div class="box-authentication">
            <h4>Forgot Password</h4>
            <p>Forgot your password? No worries</p>
            <label for="emmail_register">Email address<span class="required">*</span></label>
            <input id="emmail_register" type="text" class="form-control">
            <button class="button"><i class="icon-user icons"></i>&nbsp; <span>Submit</span></button>
          </div>
        </div>
      </div>
    </div>
  </section>  
  <!-- Main Container End --> 
@endsection
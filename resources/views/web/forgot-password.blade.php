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
            @if (Session::has('message'))
              <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif 
            @if (Session::has('error'))
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            {{ Form::open(array('route' => 'web.sendOtp', 'method' => 'post')) }}
              <label for="emmail_register">Enter Registered Mobile Number<span class="required">*</span></label>
              <input id="emmail_register" name="mobile" type="number" class="form-control" value="{{old('mobile')}}">
              @if($errors->has('mobile'))
                <span class="invalid-feedback" role="alert" style="color:red">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span><br>
              @enderror
              <button class="button"><i class="icon-user icons"></i>&nbsp; <span>Send OTP</span></button>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </section>  
  <!-- Main Container End --> 
@endsection
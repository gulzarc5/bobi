@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
 <section class="main-container col1-layout">
    <div class="main container Login-section">
      <div class="page-content">
        <div class="account-login">

          {{ Form::open(['method' => 'post','route'=>'web.user_registration']) }}
          <div class="box-authentication">
            <h4>Register</h4>
            <p>Create your very own account</p>
            @if (Session::has('message'))
              <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif @if (Session::has('error'))
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <label for="name_register">Name <span class="required">*</span></label>
            <input id="name_register" name="name" value="{{ old('name') }}" type="text" class="form-control">
            @if($errors->has('name'))
              <span class="invalid-feedback" role="alert" style="color:red">
                <strong>{{ $errors->first('name') }}</strong>
              </span> <br>
            @enderror

            <label for="emmail_register">Email<span class="required"></span></label>
            <input id="emmail_register" type="email" value="{{ old('email') }}" name="email" type="text" class="form-control">
            @if($errors->has('email'))
              <span class="invalid-feedback" role="alert" style="color:red">
                <strong>{{ $errors->first('email') }}</strong>
              </span> <br>
            @enderror

            <label for="mobile_register">Mobile<span class="required">*</span></label>
            <input id="mobile_register" type="number" name="mobile" value="{{ old('mobile') }}" type="text" class="form-control">
            @if($errors->has('mobile'))
              <span class="invalid-feedback" role="alert" style="color:red">
                <strong>{{ $errors->first('mobile') }}</strong>
              </span> <br>
            @enderror

            <label for="password">Password<span class="required">*</span></label>
            <input id="password" type="text" name="password" class="form-control">
            @if($errors->has('password'))
              <span class="invalid-feedback" role="alert" style="color:red">
                <strong>{{ $errors->first('password') }}</strong>
              </span> <br>
            @enderror    
            <label for="emmail_register">Confirm Password<span class="required">*</span></label>
            <input id="emmail_register" type="text" name="confirm_password" class="form-control">
            @if($errors->has('confirm_password'))
              <span class="invalid-feedback" role="alert" style="color:red">
                <strong>{{ $errors->first('confirm_password') }}</strong>
              </span> <br>
            @enderror    

            <button class="button"><i class="icon-user icons"></i>&nbsp; <span>Register</span></button>

            <div class="register-benefits" style="display: flex;">
              <h5>Alredy Registred?</h5>&nbsp; <a href="{{ route('web.userLoginForm')}}">Login</a>
            </div>
          </div>
          {{ Form::close() }}

        </div>
      </div>
    </div>
  </section>  
  <!-- Main Container End --> 
@endsection
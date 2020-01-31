@extends('web.templet.master')


@section('content')
  <!-- Page Container -->
 <section class="main-container col1-layout">
    <div class="main container Login-section">
      <div class="page-content">
        <div class="account-login">
          <div class="box-authentication">
            <h4>Change Password</h4>
            @if (Session::has('message'))
              <div class="alert alert-success">{{ Session::get('message') }}</div>
            @else
              <div class="alert alert-success">
                Your One Time Password Has Been Sent To Your Mobile Number Please Enter OTP To Verify.
                <a href="{{route('web.resend_otp',['mobile'=>encrypt($mobile)])}}" class="btn btn-sm btn-primary" style="height: 30px;padding-left: 9px;padding-right: 9px;padding-top: 1px;">Resend Otp</a>
              </div>
            @endif 
            @if (Session::has('error'))
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif  

            {{ Form::open(array('route' => 'web.pass_change_forgot', 'method' => 'post')) }}
              @if (isset($mobile) && !empty($mobile))
                <input type="hidden" name="mobile" value="{{$mobile}}">
              @endif
              <label for="otp">Enter OTP<span class="required">*</span></label>
              <input id="otp" name="otp" value="{{old('otp')}}" type="text" class="form-control">
              @if($errors->has('otp'))
                <span class="invalid-feedback" role="alert" style="color:red">
                    <strong>{{ $errors->first('otp') }}</strong>
                </span><br>
              @enderror

              <label for="new_pass">Enter New Password<span class="required">*</span></label>
              <input id="new_pass" name="new_pass" value="{{old('new_pass')}}" type="text" class="form-control">
              @if($errors->has('new_pass'))
                <span class="invalid-feedback" role="alert" style="color:red">
                    <strong>{{ $errors->first('new_pass') }}</strong>
                </span><br>
              @enderror

              <label for="confirm_pass">ReEnter Password<span class="required">*</span></label>
              <input id="confirm_pass" name="confirm_pass" value="{{old('confirm_pass')}}" type="text" class="form-control">
              @if($errors->has('confirm_pass'))
                <span class="invalid-feedback" role="alert" style="color:red">
                    <strong>{{ $errors->first('confirm_pass') }}</strong>
                </span><br>
              @enderror
              <button class="button"><i class="icon-user icons"></i>&nbsp; <span>Submit</span></button>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </section>  
  <!-- Main Container End --> 
@endsection